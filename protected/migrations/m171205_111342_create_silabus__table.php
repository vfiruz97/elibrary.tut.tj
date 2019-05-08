<?php

use yii\db\Migration;

/**
 * Handles the creation of table `silabus_`.
 */
class m171205_111342_create_silabus__table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('silabus', [
            'id'                => $this->primaryKey(),
            'course'            => $this->integer()->notNull()->comment('Курс'),
            'student'           => $this->integer()->defaultValue(1)->comment('Студент или Магистр'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'name_silabus'      => $this->string(100)->notNull()->unique()->comment('Имя силлабуса'),
            'path'              => $this->string(150)->notNull()->comment('Адрес силлабуса'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('silabus');
    }
}
