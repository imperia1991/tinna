<?php

use yii\db\Schema;
use yii\db\Migration;

class m141204_174538_add_column_tags_to_category extends Migration
{
    public function up()
    {
        $this->addColumn('{{%category}}', 'tags', Schema::TYPE_TEXT . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'tags');
    }
}
