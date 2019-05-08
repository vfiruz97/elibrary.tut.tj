<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m171123_110808_create_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comments', [
            'id'                => $this->primaryKey(),
            'book_id'           => $this->integer()->notNull()->comment('Kнигa'),
            'username'          => $this->string(255)->notNull()->comment('Имя пользователя'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'comment'           => $this->text()->notNull()->comment('Комментарий'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comments');
    }
}
