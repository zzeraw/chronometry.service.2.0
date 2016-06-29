<?php
/**
 * Created by PhpStorm.
 * User: paveldanilov
 * Date: 23.06.16
 * Time: 11:53
 */

namespace app\modules\chronometry\components\widgets;

use yii\widgets\ActiveForm;
use app\modules\chronometry\models\form\ChronometryDayForm;

class MinutesAddTableWidget extends MinutesTableWidget
{
    /**
     * @var ChronometryDayForm
     */
    public $chronometry_day_form;

    /**
     * @var ActiveForm
     */
    public $active_form;

    public function run()
    {
        return $this->render('minutesAddTableWidget', [
            'chronometry_day_form' => $this->chronometry_day_form,
            'table_css_class' => $this->table_css_class,
            'table_css_id' => $this->table_css_id,
            'td_css_class' => $this->td_css_class,
            'active_form' => $this->active_form,
        ]);
    }
}