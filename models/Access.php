<?php


namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property mixed|null id
 * @property string $token [varchar(512)]
 */
class Access extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'access_token';
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return true;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }
}