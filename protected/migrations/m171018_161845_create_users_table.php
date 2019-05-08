<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171018_161845_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id'                => $this->primaryKey(),
            'faculty_id'        => $this->integer()->notNull()->comment('Факультет'),
            'speciality_id'     => $this->integer()->comment('Специальности'),
            'username'          => $this->string()->notNull()->unique()->comment('Логин'),
            'auth_key'          => $this->string(32),
            'password_hash'     => $this->string(60)->notNull()->comment('Пароль'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'gender'            => "ENUM('male', 'female') NOT NULL",
            'name'              => $this->string(255)->notNull()->comment('Имя пользователя'),
            'surname'           => $this->string(255)->notNull()->comment('Фамилия пользователя'),
            'date_of_birth'     => $this->string(12)->notNull()->comment('Дата рождения'),
            'email'             => $this->string(255)->notNull()->comment('Е-майл пользователя'),
            'created_at'        => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'        => $this->integer()->notNull()->comment('Дата последнего изменения'),
            'FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE RESTRICT ON UPDATE RESTRICT',
        ]);
        $this->addCommentOnTable('users', 'Пользователи');
        
        $this->insert('users', [
            'faculty_id'        => 1,
            'speciality_id'     => 1,
            'username'          => 'admin',
            'auth_key'          => 'r7eLMZPS_6MIJkUGzzu1xTOhNxPlO3Qq',
            'password_hash'     => '$2y$13$xnIJ.0/69XM/aJEcWj2NuuNpOV/cZ1XGCi7qPhnKBBcgCtm.k3bZO',
            'status'            => 1,
            'gender'            => 'male',
            'name'              => 'Admin',
            'surname'           => 'Library',
            'date_of_birth'     => '1970-01-01',
            'email'             => 'power_start@mail.ru',
            'created_at'        => time(),
            'updated_at'        => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
