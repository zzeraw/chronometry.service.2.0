<?php
/**
 * Created by PhpStorm.
 * User: paveldanilov
 * Date: 23.06.16
 * Time: 11:53
 */

namespace app\modules\chronometry\components\widgets;

use yii\base\Widget;
use yii\widgets\ActiveForm;
use app\modules\chronometry\models\form\ChronometryDayForm;


class MinutesTableWidget extends Widget
{
    /**
     * @var ChronometryDayForm
     */
    public $chronometry_day_form;

    /**
     * @var ActiveForm
     */
    public $active_form;

    /**
     * @var string
     */
    public $table_css_class = 'table table-bordered minutes-chronometry-table';

    /**
     * @var string
     */
    public $table_css_id = 'selectable';

    /**
     * @var string
     */
    public $td_css_class = 'minutes';

    /**
     * @var array
     */
    public $activities;

    public function run()
    {
        return $this->render('minutesTableWidget', [
            'chronometry_day_form' => $this->chronometry_day_form,
            'table_css_class' => $this->table_css_class,
            'table_css_id' => $this->table_css_id,
            'td_css_class' => $this->td_css_class,
            'active_form' => $this->active_form,
        ]);
    }

    public function getCodeById($id)
    {
        foreach ($this->activities as $activity) {
            if ($activity->id == $id) {
                return $activity->code;
            }
        }

        return false;
    }

}