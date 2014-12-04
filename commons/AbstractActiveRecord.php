<?php


namespace app\commons;


use app\modules\admin\models\Category;
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
    /**
     *
     */
    const STATUS_SHOW     = 1;
    /**
     *
     */
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
     *
     * @param bool $html
     *
     * @return mixed
     */
    public function getStatusValues($html = true)
    {
        if ($html && $this->getStatus() !== null) {
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

        return [
            static::STATUS_SHOW     => 'Показывается',
            static::STATUS_NOT_SHOW => 'Не показывается',
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->hasAttribute('alias')) {
                $this->setAlias(LocoTranslitFilter::cyrillicToLatin($this->getTitle()));
            }

            return true;
        }

        return false;
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

    /**
     * Возвращете список дочерних категорий для использования в dropDownList
     * @return mixed
     */
    public static function getCategoriesToDropDownList()
    {
        $where = [
            'category.status = ' . static::STATUS_SHOW,
            'category.parent_id IS NOT NULL'
        ];

        $query = Category::find()->leftJoin([
            'c' => 'category',
        ], 'c.parent_id = category.id')
            ->where(
                join(' AND ', $where)
            );

        $models = $query->all();

        return ArrayHelper::map($models, 'id', 'title', function ($element) {
            $item = $element->getParent()->one();

            return is_object($item) ? $item->getTitle() : '';
        });
    }
}