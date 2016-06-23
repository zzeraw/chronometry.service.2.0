<?php

namespace app\modules\chronometry\models\form;

use Yii;
use yii\base\Model;

class ChronometryDayForm extends Model
{
    public $date;
    public $activity_id;
    public $note;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['date', 'required'],
//            ['date', 'isDateUnused', 'on' => 'create'],

            ['activity_id', 'integer'],
//            ['activity_id', 'isActivityIsset'],

            ['note', 'string', 'max' => 300],
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

//    public function isActivityIsset($attribute, $params)
//    {
//        if (!in_array($this->$attribute, ['USA', 'Web'])) {
//            $this->addError($attribute, 'The country must be either "USA" or "Web".');
//        }
//    }
//
//    public function isDateUnused($attribute, $params)
//    {
//
//    }

}