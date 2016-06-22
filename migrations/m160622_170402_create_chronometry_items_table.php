<?php

use yii\db\Migration;

/**
 * Handles the creation for table `chronometry_items_table`.
 */
class m160622_170402_create_chronometry_items_table extends Migration
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
        $this->createTable('chronometry_items', [
            'id' => $this->primaryKey(),
            'activity_id' => $this->integer()->notNull(),
            'activity_date' => $this->date()->notNull(),
            'hour' => $this->smallInteger(2)->notNull(),
            'minutes' => $this->smallInteger(2)->notNull(),
            'note' => $this->string(300)->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-chronometry_items-activity_date', 'chronometry_items', 'activity_date');
        $this->createIndex('idx-chronometry_items-activity_id', 'chronometry_items', 'activity_id');
        $this->addForeignKey(
            'fk-chronometry_items-activity_id',
            'chronometry_items',
            'activity_id',
            'activities',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-chronometry_items-activity_date',
            'chronometry_items'
        );

        $this->dropForeignKey(
            'fk-chronometry_items-activity_id',
            'chronometry_items'
        );

        $this->dropIndex(
            'idx-chronometry_items-activity_id',
            'chronometry_items'
        );

        $this->dropTable('chronometry_items');
    }
}
