<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m171113_093147_create_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('book', [
            'id'                => $this->primaryKey(),
            'category_id'       => $this->integer()->notNull()->comment('Категория'),
            'subcategory_id'    => $this->integer()->defaultValue(0)->comment('Подкатегория'),
            'author'            => $this->string(100)->notNull()->comment('Автор'),
            'description'       => $this->text()->notNull()->comment('Кароткое описание'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'name_book'         => $this->string(100)->notNull()->unique()->comment('Имя книга'),
            'lang_book'         => "ENUM('tj', 'ru') NOT NULL",
            'path'              => $this->string(150)->notNull()->comment('Адрес книга'),
            'path_photo'        => $this->string(150)->notNull()->comment('Адрес фото'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book');
    }
}
