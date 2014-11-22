<?php

use yii\db\Schema;
use yii\db\Migration;

class m141122_145749_add_user extends Migration
{
    public function up()
    {
        $this->insert('user',
            [
                'username'             => 'admin',
                'password_hash'        => Yii::$app->security->generatePasswordHash('123456'),
                'email'                => 'a@a.com',
            ]
        );
    }

    public function down()
    {
        $this->delete('user', 'email="a@a.com"');
    }
}
