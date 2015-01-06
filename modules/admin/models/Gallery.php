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
 * @property integer $category_id
 * @property string $alias
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $text
 * @property string $orderby
 *
 * @property Category $category
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
            [['category_id'], 'required'],
            [['status', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'title'           => 'Название',
            'photo'           => 'Путь к фото',
            'status'          => 'Статус',
            'sub_category_id' => 'Подкатегория',
            'created_at'      => 'Дата добавления',
            'updated_at'      => 'Дата обновления',
            'category_id'     => 'Категория',
            'text'            => 'Фотографии',
            'orderby'         => 'Порядок',
        ];
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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
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
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     * @param mixed $orderby
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
    }

    /**
     * @param int $categoryId
     */
    public static function getAllBy($categoryId = 0)
    {
        return static::find()->orderBy([
            'orderby' => 'ASC'
        ])->where([
            'category_id' => $categoryId
        ])->all();
    }
}
