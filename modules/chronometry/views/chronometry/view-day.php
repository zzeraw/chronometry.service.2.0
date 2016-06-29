<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\modules\chronometry\components\widgets\MinutesViewTableWidget;

$this->title = 'Данные за ' . $date;

$this->params['breadcrumbs'][] = ['label' => 'Хронометраж', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chronometry-item-view-day">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?= MinutesViewTableWidget::widget([
        'chronometry_items_array' => $chronometry_items_array,
        'activities' => $activities,
    ]) ?>

</div>

