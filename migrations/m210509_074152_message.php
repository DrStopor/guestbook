<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m210509_074152_message
 */
class m210509_074152_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'message',
            [
                'id' => Schema::TYPE_PK . ' AUTO_INCREMENT ',
                'theme' => $this->string(64),
                'user_name' => $this->string(64),
                'text' => $this->text(),
                'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'last_edit' => $this->dateTime(),
                'id_user' => $this->integer(),
                'created_at' => $this->integer(),
                'created_by' => $this->integer(),
                'updated_at' => $this->integer(),
            ]
        );

        $this->batchInsert(
            'message',
            [
                'id',
                'theme',
                'user_name',
                'text',
                'created_time',
                'last_edit',
                'id_user',
                'created_at',
                'created_by',
                'updated_at'
            ],
            [
                [1, 'sadasd', 'asdasd', 'asdasd', '2021-05-09 11:01:40', null, null, 1620547300, null, 1620547300],
                [2, 'Даешь тему', 'аноним', 'текст', '2021-05-09 11:02:29', null, null, 1620547349, null, 1620547349],
                [
                    3,
                    'Без имени',
                    'аноним',
                    'какой-то текст',
                    '2021-05-09 11:02:48',
                    null,
                    null,
                    1620547368,
                    null,
                    1620547368
                ],
                [4, '', 'без темы', 'бла бла бла', '2021-05-09 11:03:25', null, null, 1620547405, null, 1620547405],
                [
                    5,
                    '',
                    'без темы',
                    'без темы и имени',
                    '2021-05-09 11:03:32',
                    null,
                    null,
                    1620547412,
                    null,
                    1620547412
                ],
                [
                    6,
                    'Как затянул гайки',
                    'Василич',
                    'Взял ключ на 32 и сходил в ЖЭК поговорить',
                    '2021-05-09 11:04:16',
                    null,
                    null,
                    1620547456,
                    null,
                    1620547456
                ],
                [
                    7,
                    'Отлично отдохнул',
                    'Навальный',
                    'Был на отдыхе 3 года, 3-х разовое питание, койка, в обще ол ин клюзив. Гостиница так себе, по моей классификации - (минус) 5 звезд',
                    '2021-05-09 11:05:40',
                    null,
                    null,
                    1620547540,
                    null,
                    1620547540
                ],
                [8, '', '', "alert('12312')", '2021-05-09 11:10:37', null, null, 1620547837, null, 1620547837],
                [
                    9,
                    'insert',
                    '',
                    "INSERT INTO `MESSAGE` (TEXT) values ('ТЕКСТ')",
                    '2021-05-09 11:11:58',
                    null,
                    null,
                    1620547918,
                    null,
                    1620547918
                ],
                [10, '', '', 'просто сообщение', '2021-05-09 11:12:25', null, null, 1620547945, null, 1620547945],
                [
                    12,
                    'На всю длину 111111111111111111111111111111111111111111111111111',
                    'На всю длину 222222222222222222222222222222222222222222222222222',
                    'фывфывфывфывфывфывфывф фывфыв',
                    '2021-05-09 11:19:47',
                    null,
                    null,
                    1620548387,
                    null,
                    1620548387
                ],
                [
                    13,
                    'НННННННННННННННННННННННННННННННННННННННННННННННННННННННННННННННН',
                    'ЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦЦ',
                    'ывфывфывфывф',
                    '2021-05-09 11:21:29',
                    null,
                    null,
                    1620548489,
                    null,
                    1620548489
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
