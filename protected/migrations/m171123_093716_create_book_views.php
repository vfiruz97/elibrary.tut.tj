<?php

use yii\db\Migration;

/**
 * Class m171123_093716_create_book_views
 */
class m171123_093716_create_book_views extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('book_views', [
            'id'                => $this->primaryKey(),
            'book_id'           => $this->string(255)->comment('Книга'),
            'view'              => $this->integer()->defaultValue(1)->comment('Просмотр'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book_views');
    }
}
