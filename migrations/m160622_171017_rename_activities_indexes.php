<?php

use yii\db\Migration;

class m160622_171017_rename_activities_indexes extends Migration
{
    public function up()
    {
        $this->dropIndex('idx-activity-code', 'activities');
        $this->dropIndex('idx-activity-active', 'activities');

        $this->createIndex('idx-activities-code', 'activities', 'code');
        $this->createIndex('idx-activities-active', 'activities', 'active');
    }
    public function down()
    {
        $this->dropIndex('idx-activities-code', 'activities');
        $this->dropIndex('idx-activities-active', 'activities');

        $this->createIndex('idx-activity-code', 'activities', 'code');
        $this->createIndex('idx-activity-active', 'activities', 'active');
    }
}
