<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $title
 * @property string $photo
 * @property integer $status
 * @property integer $sub_category_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property SubCategory $subCategory
 */
class Gallery extends \app\commons\AbstractActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'photo', 'sub_category_id', 'created_at', 'updated_at'], 'required'],
            [['status', 'sub_category_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'status' => 'Status',
            'sub_category_id' => 'Sub Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_category_id']);
    }
}
