<?php

namespace app\modules\chronometry\models\form;

use app\modules\chronometry\models\ChronometryItem;
use Yii;
use yii\base\Model;

class ChronometryDayForm extends Model
{
    public $date;
    public $activity_id;
    public $note;

    protected $activities;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['date', 'required'],
            ['date', 'validateDateIsUnset', 'on' => 'add-day'],

            ['activity_id', 'validateEachActivityIsIsset'],
            ['activity_id', 'validateEachActivityIsInteger'],
            ['activity_id', 'validateCountActivityArray'],

            ['note', 'validateEachNoteString', 'params' => ['max' => 300]],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Дата',
            'activity_id' => 'Деятельность',
            'note' => 'Примечание',
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateDateIsUnset($attribute, $params)
    {
        $datetime_object = new \DateTime($this->$attribute);
        $date = $datetime_object->format('Y-m-d');

        $count = ChronometryItem::find()
            ->where(['activity_date' => $date])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, 'Для этой даты уже существуют записи.');
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateEachActivityIsIsset($attribute, $params)
    {
        foreach ($this->$attribute as $hour => $minutes_array) {
            foreach ($minutes_array as $minutes => $activity_id) {
                if (empty($activity_id)) {
                    $this->addError($attribute . '[' . $hour . '][' . $minutes . ']', 'Поле активности должно быть заполнено.');
                }
            }
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateEachActivityIsInteger($attribute, $params)
    {
        foreach ($this->$attribute as $hour => $minutes_array) {
            foreach ($minutes_array as $minutes => $activity_id) {
                if (!is_numeric($activity_id)) {
                    $this->addError($attribute . '[' . $hour . '][' . $minutes . ']', 'Поле активности должно быть числом.');
                }
            }
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateCountActivityArray($attribute, $params)
    {
        $count = 0;
        foreach ($this->$attribute as $hour => $minutes_array) {
            foreach ($minutes_array as $minutes => $activity_id) {
                $count++;
            }
        }

        if ($count != 288) {
            $this->addError($attribute, 'Массив активностей не содержит 288 элементов.');
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateEachNoteString($attribute, $params)
    {
        foreach ($this->$attribute as $hour => $minutes_array) {
            foreach ($minutes_array as $minutes => $note) {
                if ( !empty(mb_strlen($note)) && (mb_strlen($note) > $params['max']) ) {
                    $this->addError($attribute . '[' . $hour . '][' . $minutes . ']', 'Поле примечаний должно быть не более ' . $params['max'] . ' символов.');
                }
            }
        }
    }

    /**
     * @param $date Дата в формате 'ГГГГ-ММ-ДД'
     */
    public function setDateToForm($date)
    {
        if ($date != '') {
            $datetime_object = new \DateTime($date);
            $new_date = $datetime_object->format('d.m.Y');

            $this->date = $new_date;
        }
    }
}