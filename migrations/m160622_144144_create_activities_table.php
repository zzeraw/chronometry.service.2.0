<?php

use yii\db\Migration;

/**
 * Handles the creation for table `activities_table`.
 */
class m160622_144144_create_activities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('activities', [
            'id' => $this->primaryKey(),
            'code' => $this->string(10)->notNull()->unique(),
            'title' => $this->string(300)->notNull(),
            'color' => $this->string(7)->notNull()->defaultValue('#ffffff'),
            'text_color' => $this->string(7)->notNull()->defaultValue('#000000'),
            'active' => $this->smallInteger()->notNull()->defaultValue(1),

        ], $tableOptions);

        $this->createIndex('idx-activity-code', 'activities', 'code');
        $this->createIndex('idx-activity-active', 'activities', 'active');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-activity-code',
            'activities'
        );

        $this->dropIndex(
            'idx-activity-active',
            'activities'
        );

        $this->dropTable('activities');
    }
}
