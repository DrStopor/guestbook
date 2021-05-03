<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

\app\assets\GbAsset::register($this);
?>
<div class="col-md-12">
    <div class="row">
        <div class="text-center">
            <?= LinkPager::widget(
                [
                    'pagination' => $pages,
                ]
            ) ?>
        </div>
    </div>
    <?php
    foreach ($posts as $post): ?>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 test1">
                <div class="header-message row">
                    <div class="theme">
                        <b>Тема:</b> <?= $post->theme ?>
                    </div>
                    <div class="author">
                        <b>Автор:</b> <?php
                        if ($post->user_name) {
                            echo $post->user_name;
                        } else {
                            echo 'аноним';
                        }
                        ?>
                    </div>
                    <div class="time">
                        <b>Время:</b> <?= Yii::$app->formatter->asDatetime($post->created_time, 'hh:mm dd.MM.Y') ?>
                    </div>
                </div>
                <div class="body-message row">
                    <?= $post->text ?>
                </div>
            </div class="col-md-8">
            <div class="col-md-2"></div>
        </div>
    <?php
    endforeach; ?>
    <div class="row">
        <div class="text-center">
            <?= LinkPager::widget(
                [
                    'pagination' => $pages,
                ]
            ) ?>
        </div>
    </div>
</div>
<div class="col-md-8 col-md-offset-3 text-center">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    Pjax::begin() ?>
    <?php
    if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php
    endif; ?>
    <?php
    if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php
    endif; ?>


    <?php
    $form = ActiveForm::begin(
        [
            'id' => 'board-save-message',
            'options' => [
                'class' => 'form-horizontal'
            ],
            'fieldConfig' => [
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ],
            'action' => ['create']
        ]
    ); ?>

    <?= $form->field($message, 'theme')->textInput(['placeholder' => 'Напишите тему сообщения']) ?>
    <?= $form->field($message, 'user_name')->textInput(['placeholder' => 'Представьтесь']) ?>

    <?= $form->field($message, 'text')->textarea(['rows' => 8]) ?>

    <div class="form-group">
        <div class="col-md-5 col-md-offset-2">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-default btn-block']) ?>
        </div>
        <!--<div class="col-md-5">
            <?
        /*= Html::resetButton() ('Сбросить', ['class' => 'btn btn-default btn-block']) */ ?>
        </div>-->
    </div>

    <?php
    $form = ActiveForm::end(); ?>
    <?php
    Pjax::end() ?>
</div>
