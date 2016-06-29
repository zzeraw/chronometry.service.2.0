<?php
/**
 * Created by PhpStorm.
 * User: paveldanilov
 * Date: 23.06.16
 * Time: 11:53
 */

namespace app\modules\chronometry\components\widgets;

use yii\base\Widget;

class MinutesTableWidget extends Widget
{
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