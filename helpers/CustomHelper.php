<?php

/**
 * Created by PhpStorm.
 * User: paveldanilov
 * Date: 29.06.16
 * Time: 13:28
 */

namespace app\helpers;

class CustomHelper
{
    /**
     * @param $human_date
     * @return string
     */
    public static function convertHumanDateToSqlDate($human_date)
    {
        $datetime_object = new \DateTime($human_date);
        $sql_date = $datetime_object->format('Y-m-d');

        return $sql_date;
    }

    /**
     * @param $sql_date
     * @return string
     */
    public static function convertSqlDateToHumanDate($sql_date)
    {
        $datetime_object = new \DateTime($sql_date);
        $human_date = $datetime_object->format('d.m.Y');

        return $human_date;
    }
}