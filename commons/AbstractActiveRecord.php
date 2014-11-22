<?php


namespace app\commons;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class TinnaActiveRecord
 * @package app\commons
 */
class AbstractActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
} 