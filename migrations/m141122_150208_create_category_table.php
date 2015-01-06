<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m141122_150208_create_category_table
 */
class m141122_150208_create_category_table extends Migration
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
        $this->createTable('{{%category}}', [
            'id'         => Schema::TYPE_PK,
            'title'      => Schema::TYPE_STRING . ' NOT NULL',
            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'parent_id'  => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'alias'      => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_category_title', '{{%category}}', 'title');
        $this->createIndex('idx_category_status', '{{%category}}', 'status');
        $this->createIndex('idx_category_alias', '{{%category}}', 'alias');
        $this->createIndex('idx_category_parent_id', '{{%category}}', 'parent_id');

        $this->addForeignKey('fk_category_category', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     *
     */
    public function down()
    {
        $this->truncateTable('{{%gallery}}');

        $this->dropForeignKey('fk_category_category', '{{%category}}');

        $this->dropTable('{{%category}}');
    }
}
