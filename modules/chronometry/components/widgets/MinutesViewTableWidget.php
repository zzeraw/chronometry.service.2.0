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


class MinutesViewTableWidget extends MinutesTableWidget
{
    /**
     * @var
     */
    public $chronometry_items_array;

    public function run()
    {
        return $this->render('minutesViewTableWidget', [
            'chronometry_items_array' => $this->chronometry_items_array,
            'table_css_class' => $this->table_css_class,
            'table_css_id' => $this->table_css_id,
            'td_css_class' => $this->td_css_class,
        ]);
    }
}