<?php

use yii\db\Schema;
use yii\db\Migration;

class m141124_165111_add_column_to_gallery extends Migration
{
    public function up()
    {
        $this->addColumn('{{%gallery}}', 'orderby', Schema::TYPE_INTEGER . ' DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%gallery}}', 'orderby');
    }
}
