<?php

namespace app\controllers;

use app\models\Message;
use yii\data\Pagination;
use yii\web\Controller;

class BoardController extends Controller
{
    public function actionIndex()
    {
        $query = Message::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $message = new Message();
        //$sendMessage = new SendMessage();
        return $this->render('index', compact('posts', 'pages', 'message'));
    }

    public function actionCreate()
    {
        $message = new Message();
        if ($message->load(\Yii::$app->request->post()) && $message->save()) {
            \Yii::$app->session->setFlash('success', 'ok');
            //return $this->refresh();
            return $this->actionIndex();
        }
    }
}