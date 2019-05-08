<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mark`.
 */
class m171123_141505_create_mark_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mark', [
            'id' => $this->primaryKey(),
            'book_id'           => $this->string(255)->comment('Книга'),
            'username'          => $this->string(255)->notNull()->comment('Имя пользователя'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'marks'             => $this->integer()->notNull()->comment('Сумма поставленных лайков'),
            'iden'              => $this->integer()->notNull()->comment('Кооличество поставленных лайков'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mark');
    }
}
