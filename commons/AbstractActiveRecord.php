<?php


namespace app\commons;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class TinnaActiveRecord
 * @package app\commons
 */
class AbstractActiveRecord extends ActiveRecord
{
    const STATUS_SHOW     = 1;
    const STATUS_NOT_SHOW = 0;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Возвращает буквенное значение
     * @return mixed
     */
    public function getStatusValues()
    {
        $statuses = [
            static::STATUS_SHOW     => Html::tag('span', 'Показывается', [
                'style' => 'color: green'
            ]),
            static::STATUS_NOT_SHOW => Html::tag('span', 'Не показывается', [
                'style' => 'color: #FF0000'
            ]),
        ];

        return $statuses[$this->getStatus()];
    }

    /**
     * Возвращете список объектов со статусом STATUS_SHOW подготовленный для использования в dropDownList
     * @return mixed
     */
    public static function getAllToDropDownList()
    {
        $models = static::find()->where(['status' => static::STATUS_SHOW])->asArray()->all();

        return ArrayHelper::map($models, 'id', 'title');
    }
} 