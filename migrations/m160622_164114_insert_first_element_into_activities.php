<?php

use yii\db\Migration;

class m160622_164114_insert_first_element_into_activities extends Migration
{
    public function safeUp()
    {
        $this->insert('activities', [
            'id' => 1,
            'code' => '-',
            'title' => 'Не отмечено',
            'color' => '#ffffff',
            'text_color' => '#000000',
            'active' => 1,
        ]);
    }

    public function safeDown()
    {
        $this->delete('activities', ['id' => 1]);
    }
}
