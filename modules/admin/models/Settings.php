<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $contact_text
 * @property string $pricing_text
 * @property string $about_text
 * @property integer $created_at
 * @property integer $updated_at
 */
class Settings extends \app\commons\AbstractActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_text', 'pricing_text', 'about_text'], 'required'],
            [['contact_text', 'pricing_text', 'about_text'], 'string'],
            [['created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'contact_text' => 'Текст на странице Contacts',
            'pricing_text' => 'Текст на странице Pricing',
            'about_text'   => 'Текст на странице About me',
            'created_at'   => 'Дата добавления',
            'updated_at'   => 'Дата обновления',
        ];
    }

    /**
     * @return mixed
     */
    public function getContactText()
    {
        return $this->contact_text;
    }

    /**
     * @param mixed $contact_text
     */
    public function setContactText($contact_text)
    {
        $this->contact_text = $contact_text;
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
     * @return string
     */
    public function getPricingText()
    {
        return $this->pricing_text;
    }

    /**
     * @param string $pricing_text
     */
    public function setPricingText($pricing_text)
    {
        $this->pricing_text = $pricing_text;
    }

    /**
     * @return string
     */
    public function getAboutText()
    {
        return $this->about_text;
    }

    /**
     * @param string $about_text
     */
    public function setAboutText($about_text)
    {
        $this->about_text = $about_text;
    }
}
