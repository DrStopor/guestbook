<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string|null $theme
 * @property string $text
 * @property int $id_user
 * @property string $created_time
 * @property string|null $last_edit
 * @property string $user_name
 * @property int $created_by [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'] , 'required'],
            [['text'], 'string', 'min' => 3, 'max' => 1000],
            [['id_user'], 'integer'],
            [['created_time', 'last_edit'], 'safe'],
            [['created_at', 'created_by', 'updated_at'], 'integer'],
            [['theme'], 'string', 'max' => 64],
            [['user_name', 'user_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'theme' => Yii::t('app', 'Theme'),
            'text' => Yii::t('app', 'Text'),
            'id_user' => Yii::t('app', 'Id User'),
            'created_time' => Yii::t('app', 'Created Time'),
            'last_edit' => Yii::t('app', 'Last Edit'),
            'user_name' => Yii::t('app', 'User Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MessageQuery(get_called_class());
    }
}
