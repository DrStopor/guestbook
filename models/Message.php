<?php

namespace app\models;

use yii\db\ActiveRecord;

class Message extends ActiveRecord
{
    public function rules()
    {
        return [
            [['text', 'user_name'], 'required'],
            [['theme', 'text', 'user_name'], 'trim'],
            ['theme', 'string', 'max' => 128],
            ['text', 'string', 'min' => 3],
            ['user_name', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'theme' => 'Тема',
            'text' => 'Текст',
            'user_name' => 'Имя'
        ];
    }
}