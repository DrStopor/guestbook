<?php

namespace app\modules\api\controllers;

use app\models\Message;
use app\modules\api\resource\MessageResource;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

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

    /**
     * Получение сообщений для переденной (нет) странице, с учетом кол-ва сообщений на страницу
     * @param int $page
     * @param int $limitMessage кол-во сообщений на страницу
     * @return Message[]|array
     */
    public function actionGetByPage($page = 0, $limitMessage = 3)
    {
        $model= Message::find()->select(['id', 'theme', 'user_name', 'text', 'created_time'])->offset($page*$limitMessage)->limit($limitMessage)->all();

        return $model;
    }

    /**
     * Сохранение переданного сообщения по полям
     * @param $theme
     * @param null $author
     * @param $text
     * @return string[]
     */
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

    /**
     * Кол-во страниц с сообщениями. Кол-во сообщений захардкожено
     * @return int
     */
    public function actionPagesCount() {
        $query = Message::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        return $pages->getPageCount();
    }

    /**
     * Получение всех записей сообщений
     * @return Message[]|array
     */
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
        return new ActiveDataProvider(
            [
            'query' => $this->modelClass::find()->all()
            ]
        );
    }
}