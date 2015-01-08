<?php

namespace app\modules\main\controllers;

use app\commons\TinnaController;
use app\modules\admin\models\Settings;
use app\modules\main\models\ContactForm;
use Yii;

/**
 * Контроллер для обратной связи
 * Class ContactController
 * @package app\modules\main\controllers
 */
class ContactController extends TinnaController
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength'       => 4,
                'maxLength'       => 4,
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $modelContact = new ContactForm();

        if (Yii::$app->getRequest()->isPost) {

            $modelContact->load(Yii::$app->request->post());

            if ($modelContact->validate()) {
                if ($modelContact->contact(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('success', 'Ваше сообщение отправлено. Спасибо');

                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Извините. Ваше сообщение не было отправлено. Попробуйте позже');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Вы допустили ошибки при вводе сообщения. Исправьте их пожалуйста');
            }
        }

        return $this->render('index', [
            'modelContact'  => $modelContact,
            'modelSettings' => Settings::find()->one(),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionPricing()
    {
        return $this->render('pricing', [
            'modelSettings' => Settings::find()->one(),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAbout()
    {
        return $this->render('about', [
            'modelSettings' => Settings::find()->one(),
        ]);
    }
}
