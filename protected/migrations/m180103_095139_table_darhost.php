<?php

use yii\db\Migration;

/**
 * Class m180103_095139_table_darhost
 */
class m180103_095139_table_darhost extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('darhost', [
            'id'                => $this->primaryKey(),
            'name_book'         => $this->string(255)->comment('Название книги'),
            'author_book'       => $this->string(255)->comment('Автор книги'),
            'year_of_print'     => $this->string(255)->comment('Дата изделие'),
            'username'          => $this->string(255)->comment('Имя пользователя'),            
            'email'             => $this->string(255)->comment('Е-майл'),            
            'phone'             => $this->string(255)->comment('Номер телефон'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('darhost');
    }
}
