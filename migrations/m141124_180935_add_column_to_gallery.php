<?php

use yii\db\Schema;
use yii\db\Migration;

class m141124_180935_add_column_to_gallery extends Migration
{
    public function up()
    {
        $this->addColumn('{{%gallery}}', 'text', Schema::TYPE_TEXT . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%gallery}}', 'text');
    }
}
