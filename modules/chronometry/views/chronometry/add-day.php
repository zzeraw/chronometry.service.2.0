<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\chronometry\components\widgets\MinutesTableWidget;


/* @var $this yii\web\View */
/* @var $model app\modules\chronometry\models\ChronometryItem */

$this->title = 'Ввод данных за день по минутам';

$this->params['breadcrumbs'][] = ['label' => 'Хронометраж', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chronometry-item-add-day">

    <h1><?= Html::encode($this->title) ?></h1>



    <hr>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
            ->field($chronometry_day_form, 'date')
            ->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Введите дату ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ]); ?>


    <hr>

    <div class="quick-input-form" id="quickInputForm">
        <h3 class="">Быстрый ввод</h3>
        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="quickInputFormActivity" placeholder="Деятельность">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="quickInputFormMinutes" placeholder="Минуты">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="quickInputFormNote" placeholder="Примечание">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <input type="time" class="form-control" id="quickInputFormTime" placeholder="Время">
                </div>
            </div>
            <div class="col-xs-2">
                <input type="hidden" id="quickInputFormPosition" value="0,5">
                <button type="submit" class="btn btn-default btn-submit" id="">ОК</button>
            </div>
        </div>
    </div>

    <?= MinutesTableWidget::widget([
        'chronometry_day_form' => $chronometry_day_form,
        'active_form' => $form,
        'activities' => $activities,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

    <?= Html::hiddenInput('activities', $json_activities, ['id' => 'activitiesArray']); ?>

</div>

