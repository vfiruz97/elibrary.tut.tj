<?php

use yii\db\Migration;

/**
 * Class m180106_192414_create_table_generate_books
 */
class m180106_192414_create_table_generate_books extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('generate_books', [
            'id'                => $this->primaryKey(),
            'name_book'         => $this->string()->notNull()->comment('Имя книга'),
            'path'              => $this->string()->notNull()->comment('Адрес книга'),            
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
        $this->dropTable('generate_books');
    }
}
