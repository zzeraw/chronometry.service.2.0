<?php

namespace app\modules\chronometry\models;

use Yii;

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
}
