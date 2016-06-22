<?php

namespace app\modules\chronometry\models;

use Yii;

/**
 * This is the model class for table "activities".
 *
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $color
 * @property string $text_color
 * @property integer $active
 *
 * @property ChronometryItems[] $chronometryItems
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active'], 'integer'],
            [['code'], 'string', 'max' => 10],
            [['title'], 'string', 'max' => 300],
            [['color', 'text_color'], 'string', 'max' => 7],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'title' => 'Title',
            'color' => 'Color',
            'text_color' => 'Text Color',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChronometryItems()
    {
        return $this->hasMany(ChronometryItems::className(), ['activity_id' => 'id']);
    }
}
