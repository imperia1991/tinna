<?php

namespace app\modules\main\models;

use app\commons\TinnaForm;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends TinnaForm
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'captchaAction' => '/main/contact/captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Введите код с картинки',
            'name'       => 'Ваше имя',
            'email'      => 'E-mail (Электронный адрес)',
            'subject'    => 'Тема',
            'body'       => 'Сообщение',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string $email the target email address
     *
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        $send = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();

        return $send;
    }
}
