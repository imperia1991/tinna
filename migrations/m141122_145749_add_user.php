<?php

use yii\db\Migration;

/**
 * Class m141122_145749_add_user
 */
class m141122_145749_add_user extends Migration
{
    /**
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function up()
    {
        $this->insert('user',
            [
                'username'      => 'admin',
                'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
                'email'         => 'a@a.com',
            ]
        );
    }

    /**
     *
     */
    public function down()
    {
        $this->delete('user', 'email="a@a.com"');
    }
}
