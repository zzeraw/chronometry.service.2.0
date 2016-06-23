<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\chronometry\models\ChronometryItem */

$this->title = 'Create Chronometry Item';
$this->params['breadcrumbs'][] = ['label' => 'Chronometry Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chronometry-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
