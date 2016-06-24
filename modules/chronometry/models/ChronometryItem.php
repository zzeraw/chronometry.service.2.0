<?php

namespace app\modules\chronometry\models;

use Yii;
use app\modules\chronometry\models\form\ChronometryDayForm;
/**
 * This is the model class for table "chronometry_items".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property string $activity_date
 * @property integer $hour
 * @property integer $minutes
 * @property string $note
 * @property integer $created_at
 *
 * @property Activities $activity
 */
class ChronometryItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chronometry_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'activity_date', 'hour', 'minutes', 'created_at'], 'required'],
            [['activity_id', 'hour', 'minutes', 'created_at'], 'integer'],
            [['activity_date'], 'safe'],
            [['note'], 'string', 'max' => 300],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::className(), 'targetAttribute' => ['activity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'activity_date' => 'Activity Date',
            'hour' => 'Hour',
            'minutes' => 'Minutes',
            'note' => 'Note',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'activity_id']);
    }

    /**
     * @param $chronometry_day_form ChronometryDayForm
     */
    public static function createModelsArray($chronometry_day_form)
    {
        $result = [];

        for ($hour = 0; $hour <= 23; $hour++) {

            for ($minutes = 5; $minutes <= 60; $minutes = $minutes + 5) {

                $model = new ChronometryItem;

                $model->activity_id = $chronometry_day_form->activity_id[$hour][$minutes];
                $model->activity_date = $chronometry_day_form->date;
                $model->hour = $hour;
                $model->minutes = $minutes;
                $model->note = $chronometry_day_form->note[$hour][$minutes];
                $model->created_at = time();

                $result[] = $model;
            }

        }

        return $result;
    }

    /**
     * @param $array
     */
    public static function validateModelsArray($array)
    {
        $result = [];
        $result_true = 0;
        $result_false = 0;

        foreach ($array as $model) {
            if ($model->validate()) {
                $result[] = [
                    'status' => true,
                    'message' => 'OK',
                ];
                $result_true++;
            } else {
                $result[] = [
                    'status' => false,
                    'message' => $model->getErrors(),
                ];
                $result_false++;
            }
        }

        if (count($array) == $result_true) {
            $result['result'] = true;
        } else {
            $result['result'] = false;
        }

        return $result;
    }

    /**
     * @param $array
     * @return int
     * @throws \yii\db\Exception
     */
    public static function insertModelArray($array)
    {
        $rows = [];

        foreach ($array as $model) {
            $rows[] = [
                'activity_id' => $model->activity_id,
                'activity_date' => $model->activity_date,
                'hour' => $model->hour,
                'minutes' => $model->minutes,
                'note' => $model->note,
                'created_at' => $model->created_at,
            ];
        }

        $attributes = [
            'activity_id',
            'activity_date',
            'hour',
            'minutes',
            'note',
            'created_at',
        ];

        $result = Yii::$app->db
            ->createCommand()
            ->batchInsert(self::tableName(), $attributes, $rows)
            ->execute();

        return $result;
    }
}
