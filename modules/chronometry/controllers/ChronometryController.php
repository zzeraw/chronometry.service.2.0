<?php

namespace app\modules\chronometry\controllers;

use Yii;
use app\helpers\CustomHelper;
use app\modules\chronometry\models\Activity;
use app\modules\chronometry\models\ChronometryItem;
use app\modules\chronometry\models\form\ChronometryDayForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChronometryController implements the CRUD actions for ChronometryItem model.
 */
class ChronometryController extends BaseController
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

    /**
     * @param string $date Дата в формате 'ГГГГ-ММ-ДД'
     * @return string
     */
    public function actionAddDay($date = '')
    {
        // получаем модель формы для ввода даты и для таблицы хронометража
        $chronometry_day_form = new ChronometryDayForm(['scenario' => 'add-day']);
        // Настраиваем дату
        $chronometry_day_form->setDateToForm($date);

        // получаем список деятельностей для JS-проверок
        $activities = Activity::find()->all();
        $json_activities = Activity::encodeCodesToJson($activities);

        // Получить и проверить данные из формы POST
         if ($chronometry_day_form->load(Yii::$app->request->post()) && $chronometry_day_form->validate()) {

             // создать из POST массив моделей ChronometryItem
             $chronometry_items = ChronometryItem::createModelsArray($chronometry_day_form);

             // проверить модели ChronometryItem
             $validation = ChronometryItem::validateModelsArray($chronometry_items);

             if ($validation['result']) {
                 // Одним запросом вставить все модели в таблицу
                 $result = ChronometryItem::insertModelArray($chronometry_items);

                 if ($result == true) {
                     // Выводим сообщение об успехе
                     $this->setSuccess('Данные за день успешно внесены');

                     // Перенаправляем на view-day
                     return $this->redirect(['view-day', 'date' => CustomHelper::convertHumanDateToSqlDate($date)]);
                 } else {
//                     var_dump($result);
                 }
             } else {
//                 var_dump($validation);
             }
         } else {
//             var_dump($chronometry_day_form->getErrors());
         }

        return $this->render('add-day', [
            'chronometry_day_form' => $chronometry_day_form,
            'activities' => $activities,
            'json_activities' => $json_activities,
        ]);
    }


    public function actionViewMonth($month)
    {

    }

    public function actionViewDay($date)
    {
        // получаем список деятельностей для отображения кодов
        $activities = Activity::find()->all();

        // Получить массив моделей ChronometryItem для указанной даты
        $chronometry_item_models_array = ChronometryItem::findAllByDate($date);

        // Преобразовать полученный массив в нужный формат
        $chronometry_items_array = ChronometryItem::createDayArray($chronometry_item_models_array);

        // Отобразить массив во view
        return $this->render('view-day', [
            'date' => CustomHelper::convertSqlDateToHumanDate($date),
            'chronometry_items_array' => $chronometry_items_array,
            'activities' => $activities,
        ]);
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
