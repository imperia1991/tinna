<?php

use yii\db\Schema;
use yii\db\Migration;

class m141123_103529_create_gallery_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%gallery}}', [
            'id'              => Schema::TYPE_PK,
            'title'           => Schema::TYPE_STRING . ' NOT NULL',
            'photo'           => Schema::TYPE_STRING . ' NOT NULL',
            'status'          => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'sub_category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at'      => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'      => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_gallery_photo', '{{%gallery}}', 'photo');
        $this->createIndex('idx_gallery_sub_category_id', '{{%gallery}}', 'sub_category_id');

        $this->addForeignKey('fk_gallery_sub_category', '{{%gallery}}', 'sub_category_id', '{{%sub_category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->truncateTable('{{%gallery}}');

        $this->dropForeignKey('fk_gallery_sub_category', '{{%gallery}}');

        $this->dropIndex('idx_gallery_photo', '{{%gallery}}');
        $this->dropIndex('idx_gallery_sub_category_id', '{{%gallery}}');

        $this->dropTable('{{%gallery}}');
    }
}
