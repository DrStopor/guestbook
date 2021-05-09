<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m210509_072549_user
 */
class m210509_072549_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user',[
            'id' => Schema::TYPE_PK.' AUTO_INCREMENT ',
            'name' => $this->string(128),
            'register_date' => $this->dateTime(),
            'last_online' => $this->dateTime(),
            'generated_avatar' => $this->string(1000),
            'is_anonymous' => $this->tinyInteger(1)->defaultValue(1),
            'user_agent' => $this->string(),
            'ip_address' => $this->string(15)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
