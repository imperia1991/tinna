<?php

namespace app\modules\admin\models;

use app\commons\AbstractActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sub_category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Gallery[] $galleries
 * @property Category $category
 */
class SubCategory extends AbstractActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'Id',
            'title'       => 'Название',
            'category_id' => 'Категория',
            'status'      => 'Статус',
            'created_at'  => 'Дата добавления',
            'updated_at'  => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['sub_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }


    /**
     * Возвращает подкатегории для требуемой категории подготовленное для использования в DropDownList
     * @param int $category_id
     *
     * @return mixed
     */
    public static function getByCategoryToDropDownList($category_id = 0)
    {
        /**@var SubCategory[] $subCategories */
        $subCategories = static::find()->where([
            'status' => static::STATUS_SHOW,
            'category_id' => $category_id,
        ])->all();

        $result = [];
        foreach ($subCategories as $subCategory) {
            $result[] = [
                'id' => $subCategory->getId(),
                'name' => $subCategory->getTitle(),
            ];
        }

        return $result;
    }

}
