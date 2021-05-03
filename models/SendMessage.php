<?php

namespace app\models;

use yii\base\Model;

class SendMessage extends Model
{
    public $theme;
    public $text;

    public function rules()
    {
        return [
            ['text', 'required'],
            [['theme', 'text'], 'trim'],
            ['theme', 'string', 'max' => 128],
            ['text', 'string', 'min' => 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'theme' => 'Тема',
            'text' => 'Текст'
        ];
    }
}