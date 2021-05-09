<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m210509_074950_access_token
 */
class m210509_074950_access_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('access_token', [
            'id' => Schema::TYPE_PK.' AUTO_INCREMENT ',
            'token' => $this->string(512)->unique()
        ]);

        /**
         * стартовый токен
         */
        $this->insert('access_token', [
            'token' => 's5HW4YD8FYWN8w9UWOn6Po50U3Y7d1ca7WdwxseXaU46WeAXKvGhwyyzHdsZmS2Cs9ahNvkq8HwI5aEYDjCiKxhAdPkBdDXJh3Q3wL1A5rQEdhF3aOBO9InP1VwOrb7c8BcgJUdUBRhkjAH6TS5Bwd6UjXkirxT93kQG0JSVIDiewDZVzbWiigkaQMYmuojlG7WTjUzBLvvVatI2rUD98ucqJyidETBK7Tzcw4cv7X15Y96Sc1iDHPP5avmaJIdRvFAsK9LaNbHkkQqM15rPjYNVjh4qnICHlrujtWXfBXFjvejeJaVYcR9bd4MuUKNXI2otwVDnxRfoJl8DmR75ingf4rvLkagXfp1dmzNmwQ1mvzT3Og5pEas9Ql5uGijoP6aib9glpe3yMcC8CjgEGRpN5JqhPKrQyho2K4ZRY0WiZpcNNwGIBVEVDZQYukKJhrMcdJjM8wVUedcE5xjzYRQO7N7OiPL60zhN20SDnZpnPShxYkgWyVuAg5zHUF3n'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('access_token');
    }
}
