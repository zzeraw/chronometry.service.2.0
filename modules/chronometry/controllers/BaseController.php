<?php
/**
 * Created by PhpStorm.
 * User: paveldanilov
 * Date: 29.06.16
 * Time: 13:45
 */

namespace app\modules\chronometry\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $errors = [];

    public function init()
    {
        parent::init();

        $this->layout = '@app/modules/chronometry/views/layouts/main';
    }


    public function setSuccess($message)
    {
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'ОК',
            'positonY' => 'top',
            'positonX' => 'left'
        ]);
    }

    public function setError($message)
    {
        Yii::$app->getSession()->setFlash('error', [
            'type' => 'danger',
            'duration' => 5000,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'Ошибка!',
            'positonY' => 'top',
            'positonX' => 'left'
        ]);
    }

    public function addError()
    {

    }
}
