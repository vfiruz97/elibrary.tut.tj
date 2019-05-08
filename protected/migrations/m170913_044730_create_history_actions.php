<?php

use yii\db\Migration;

class m170913_044730_create_history_actions extends Migration
{
    public function safeUp()
    {
        $this->createTable('ref_history_actions', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(255)->notNull()->comment('Наименование'),
            'alias'         => $this->string(255)->notNull()->comment('Псевдоним'),
        ]);
        $this->addCommentOnTable('ref_history_actions', 'Действия в истории');

        $this->batchInsert('ref_history_actions', ['name', 'alias'], [
            ['Создание', 'create'],
            ['Изменение', 'update'],
            ['Удаление', 'delete'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('ref_history_actions');
    }
}
