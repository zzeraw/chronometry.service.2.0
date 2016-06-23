<?php

namespace app\modules\chronometry\controllers;

use app\modules\chronometry\models\Activity;
use Yii;
use app\modules\chronometry\models\ChronometryItem;
use app\modules\chronometry\models\form\ChronometryDayForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * ChronometryController implements the CRUD actions for ChronometryItem model.
 */
class ChronometryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAddDay($date = false)
    {
        // получаем модель формы для ввода даты
        // получаем модель формы для таблицы хронометража
        $chronometry_day_form = new ChronometryDayForm();

        // получаем список деятельностей для JS-проверок
        $activities = Activity::find()->all();
        $json_activities = Activity::encodeCodesToJson($activities);

        // TODO: проверить данные из формы POST
        // TODO: создать из POST массив моделей ChronometryItem
        // TODO: проверить модели ChronometryItem
        // TODO: Одним запросом вставить все модели в таблицу

        return $this->render('add-day', [
            'chronometry_day_form' => $chronometry_day_form,
            'json_activities' => $json_activities,
        ]);
    }


    public function actionViewMonth($month)
    {

    }

    public function actionViewDay($date)
    {

    }



    /**
     * Lists all ChronometryItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ChronometryItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChronometryItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChronometryItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChronometryItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ChronometryItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ChronometryItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChronometryItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChronometryItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChronometryItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
