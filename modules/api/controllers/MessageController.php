<?php

namespace app\modules\api\controllers;

use app\models\Message;
use app\modules\api\resource\MessageResource;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\rest\Controller;

class MessageController extends ActiveController
{
    public $modelClass = MessageResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];
        $behaviors['authenticator'] = ['class' => HttpBearerAuth::class];
        $behaviors['authenticator'] = $auth;
        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->renderContent('Hello');
    }

    public function actionGetByPage($page = 0, $limitMessage = 3)
    {
        $model= Message::find()->select(['theme', 'user_name', 'text', 'created_time'])->offset($page*$limitMessage)->limit($limitMessage)->all();

        return $model;
    }

    public function actionSaveMessage($theme, $author = null, $text)
    {
        $message = new Message();
        $message->theme = $theme;
        $message->user_name = $author;
        $message->text = $text;
        if ($message->save()) {
            return ['message' => 'success'];
        }
        return ['error' => 'не удалось сохранить'];
    }

    public function actionPagesCount() {
        $query = Message::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        return $pages->getPageCount();
    }

    public function actionAll()
    {
        return Message::find()->select(['id', 'theme', 'user_name', 'text', 'created_time'])->all();
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->all()
                                      ]);
    }
}