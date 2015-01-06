<?php

namespace app\modules\admin\controllers;

use app\commons\AdminController;
use app\modules\admin\models\Settings;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends AdminController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->redirect(Url::to('/admin/settings/update'));
    }

    /**
     * Displays a single Settings model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $this->redirect(Url::to('/admin/settings/update'));
    }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->redirect(Url::to('/admin/settings/update'));
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @internal param int $id
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = Settings::find()->one();
        if (!$model) {
            $model = new Settings();
        }

        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Настройки сохранены');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
