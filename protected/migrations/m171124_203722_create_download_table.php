<?php

use yii\db\Migration;

/**
 * Handles the creation of table `download`.
 */
class m171124_203722_create_download_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('download', [
            'id'                => $this->primaryKey(),
            'user'              => $this->string(100)->notNull()->comment('Пользователь'),
            'faculty_ru'        => $this->string(80)->comment('Факультет'),
            'speciality_ru'     => $this->string(80)->comment('Специальности'),
            'faculty_tj'        => $this->string(80)->comment('Факультет'),
            'speciality_tj'     => $this->string(80)->comment('Специальности'),
            'book'              => $this->string(100)->notNull()->comment('Kнига'),
            'category_ru'       => $this->string(80)->notNull()->comment('Категория'),
            'subcategory_ru'    => $this->string(80)->comment('Подкатегория'),
            'category_tj'       => $this->string(80)->notNull()->comment('Категория'),
            'subcategory_tj'    => $this->string(80)->comment('Подкатегория'),
            'author'            => $this->string(80)->notNull()->comment('Автор'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'created_at_time'   => $this->dateTime()->notNull()->comment('Дата'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('download');
    }
}
