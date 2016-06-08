<?php

use yii\db\Migration;

/**
 * Handles the creation for table `chronometry_items`.
 */
class m160608_130908_create_chronometry_items_table extends Migration
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

        $this->createTable('chronometry_items', [
            'id' => $this->primaryKey(),
            'activity_id' => $this->integer()->notNull(),
            'activity_date' => $this->date()->notNull(),
            'hour' => $this->integer(2)->notNull(),
            'minutes' => $this->integer(2)->notNull(),
            'note' => $this->string(300)->defaultValue(NULL),
        ], $tableOptions);

        // creates index for column `activity_id`
        $this->createIndex(
            'idx-chronometry_items-activity_id',
            'chronometry_items',
            'activity_id'
        );

        // add foreign key for table `user`
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
        // drops foreign key for table `chronometry_items`
        $this->dropForeignKey(
            'fk-chronometry_items-activity_id',
            'chronometry_items'
        );

        // drops index for column `activity_id`
        $this->dropIndex(
            'idx-chronometry_items-activity_id',
            'chronometry_items'
        );

        $this->dropTable('chronometry_items');
    }
}
