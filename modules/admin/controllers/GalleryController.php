<?php

namespace app\modules\admin\controllers;

use app\commons\AdminController;
use app\modules\admin\models\Category;
use app\modules\admin\models\Gallery;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends AdminController
{
    /**
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->redirect(Url::to('/admin/category'));
    }

    /**
     * Displays a single Gallery model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $this->redirect(Url::to('/admin/category'));
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->redirect(Url::to('/admin/category'));
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Category id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $categoryModel = Category::findOne($id);
        $categoryModel->setScenario(Category::SCENARIO_GALLERY);

        if (Yii::$app->getRequest()->getIsPost()) {
            $post = Yii::$app->request->post('Category');

            if (isset($post['photos']) && !empty($post['photos'])) {
                Yii::$app->db->beginTransaction();

                try {
                    Gallery::deleteAll([
                        'category_id' => $id
                    ]);

                    $errors = [];
                    foreach ($post['photos'] as $orderBy => $photo) {
                        $galleryModel = new Gallery();
                        $galleryModel->setCategoryId($id);
                        $galleryModel->setPhoto($photo);
                        $galleryModel->setOrderby($orderBy);

                        if (!$galleryModel->save()) {
                            Yii::$app->db->transaction->rollBack();
                            $errors[] = 'Не удалось добавить фото: ' . $photo;
                        }
                    }

                    if (!empty($errors)) {
                        Yii::$app->getSession()->setFlash('error', $errors);

                        Yii::$app->db->transaction->rollBack();
                    } else {
                        Yii::$app->db->transaction->commit();

                        Yii::$app->getSession()->setFlash('success', 'Галерея сохранена');
                    }

                    return $this->redirect(Url::to('/admin/category'));
                } catch (Exception $e) {
                    Yii::$app->db->transaction->rollBack();

                    Yii::$app->getSession()->setFlash('error', 'Не удалось сохранить галерею: ' . $e->getMessage());
                }
            } else {
                $categoryModel->addError('photos', 'Добавьте хотя бы одно фото');
            }
        }

        return $this->render('update', [
            'categoryModel' => $categoryModel,
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionDelete()
    {
        if (Yii::$app->getRequest()->getIsAjax() && Yii::$app->getRequest()->getIsPost()) {
            $photo = trim(Yii::$app->getRequest()->post('photo'), '/');

            $path = Yii::$app->params['images']['webPath'] . DIRECTORY_SEPARATOR . $photo;

            try {
                if (file_exists($photo)) {
                    unlink($path);

                    return $this->respondJSON([
                        'error'   => 0,
                        'success' => 1,
                    ]);
                } else {
                    return $this->respondJSON([
                        'error'   => 1,
                        'success' => 0,
                    ]);
                }
            } catch (\ErrorException $e) {
                return $this->respondJSON([
                    'error'   => 1,
                    'success' => 0,
                ]);
            }
        }
    }

    public function actionUpload()
    {
        $model = new Category();

        $image = UploadedFile::getInstance($model, 'photos');

        $image->saveAs(Yii::$app->params['images']['photo'] . $image->name);

        return $this->respondJSON([
            'filePath' => [Yii::$app->getHomeUrl() . Yii::$app->params['images']['photo'] . $image->name],
        ]);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
