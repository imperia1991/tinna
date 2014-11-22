<?php

use yii\db\Migration;
use yii\db\Schema;

class m141122_150455_create_gallery_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%gallery}}', [
            'id'          => Schema::TYPE_PK,
            'title'       => Schema::TYPE_STRING . ' NOT NULL',
            'photo'       => Schema::TYPE_STRING . ' NOT NULL',
            'status'      => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'  => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_gallery_photo', '{{%gallery}}', 'photo');
        $this->createIndex('idx_gallery_category_id', '{{%gallery}}', 'category_id');

        $this->addForeignKey('fk_gallery_category', '{{%gallery}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->truncateTable('{{%gallery}}');

        $this->dropForeignKey('fk_gallery_category', '{{%gallery}}');

        $this->dropIndex('idx_gallery_photo', '{{%gallery}}');
        $this->dropIndex('idx_gallery_category_id', '{{%gallery}}');

        $this->dropTable('{{%gallery}}');
    }
}
