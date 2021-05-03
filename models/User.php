<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public int $id;
    public string $name;
    public $registerDate;
    public $lastOnline;
    public string $generatedAvatar;
    public boolean $isAnonymous;

    public function setAvatar()
    {
        return 0;
    }
}