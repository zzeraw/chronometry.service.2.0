<?php

use yii\db\Migration;

/**
 * Handles the creation for table `activities`.
 */
class m160608_124918_create_activities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('activities', [
            'id' => $this->primaryKey(),
            'code' => $this->string(20)->notNull()->unique(),
            'title' => $this->string(300)->notNull(),
            'color' => $this->string(7)->notNull(),
            'text_color' => $this->string(7)->notNull(),
            'active' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('activities');
    }
}
