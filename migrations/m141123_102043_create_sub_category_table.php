<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m141123_102043_create_sub_category_table
 */
class m141123_102043_create_sub_category_table extends Migration
{
    /**
     *
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%sub_category}}', [
            'id'          => Schema::TYPE_PK,
            'title'       => Schema::TYPE_STRING . ' NOT NULL',
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status'      => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_sub_category_title', '{{%sub_category}}', 'title');
        $this->createIndex('idx_sub_category_category_id', '{{%sub_category}}', 'category_id');
        $this->createIndex('idx_sub_category_status', '{{%sub_category}}', 'status');

        $this->addForeignKey('fk_sub_category_category', '{{%sub_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     *
     */
    public function down()
    {
        $this->truncateTable('{{%sub_category}}');

        $this->dropForeignKey('fk_sub_category_category', '{{%sub_category}}');

        $this->dropTable('{{%sub_category}}');
    }
}
