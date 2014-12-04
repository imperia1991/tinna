<?php


namespace app\modules\admin\models;

use app\commons\AbstractActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $parent_id
 * @property string $alias
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $tags
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Gallery[] $galleries
 */
class Category extends AbstractActiveRecord
{
    const SCENARIO_CATEGORY = 'category';
    const SCENARIO_GALLERY  = 'gallery';

    public $photos;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'photos'], 'required'],
            [['status', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['tags'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[static::SCENARIO_CATEGORY] = ['title', 'alias', 'parent_id', 'status', 'tags'];
        $scenarios[static::SCENARIO_GALLERY] = ['photos'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => '№',
            'title'      => 'Название',
            'status'     => 'Статус',
            'parent_id'  => 'Общая категория',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата обновления',
            'photos'     => 'Фотографии',
            'tags'       => 'Теги',
        ];
    }

    /**
     * Удаляем все фото категории
     * @return bool
     */
    public function beforeDelete()
    {
        /**@var Gallery $gallery */
        foreach ($this->getGalleries() as $gallery) {
            $path = Yii::$app->params['images']['webPath'] . $gallery->getPhoto();

            if (file_exists($path)) {
                unlink($path);
            }
        }

        return parent::beforeDelete();
    }


    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->setTags(str_replace(' ', '' , trim($this->getTags(), ' \t\n\r\0\x0B,.')));

            return true;
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['category_id' => 'id'])->all();
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
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Возвращете список родительских категорий для использования в dropDownList
     * @return mixed
     */
    public static function getParentsToDropDownList()
    {
        $query = static::find()->where([
            'status'    => static::STATUS_SHOW,
            'parent_id' => null,
        ]);

        $models = $query->asArray()->all();

        return ArrayHelper::map($models, 'id', 'title');
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getParents()
    {
        return static::find()->where([
            'status'    => static::STATUS_SHOW,
            'parent_id' => null,
        ])->all();
    }

    /**
     * Выбирает фотографии галереи
     */
    public function getGalleriesSortable()
    {
        /**@var Gallery[] $galleries */
        $galleries = Gallery::getAllBy($this->getId());

        if (empty($galleries)) {
            return [];
        }

        $items = [];
        foreach ($galleries as $gallery) {
            $html = Html::img($gallery->getPhoto(), [
                'class'  => 'colorbox',
                'width'  => 160,
                'height' => 160,
            ]);

            $html .= Html::hiddenInput('Category[photos][]', $gallery->getPhoto());

            $html .= Html::a('Удалить', 'javascript:void(0);', [
                'class'   => 'remove-photo',
                'data-id' => $gallery->getPhoto()
            ]);

            $items[] = [
                'content' => $html
            ];
        }

        return $items;
    }

    /**
     * Возвращает массив тегов
     * @return array
     */
    public function getTagsArray()
    {
        return explode(',', $this->getTags());
    }
}
