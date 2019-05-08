<?php

use yii\db\Migration;

/**
 * Class m171110_103821_create_vw_users
 */
class m171110_103821_create_vw_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE OR REPLACE ALGORITHM = TEMPTABLE VIEW vw_users AS
            SELECT
                users.id,
                users.faculty_id,
                faculty.short_name AS faculty,
                users.speciality_id,
                speciality.short_name AS speciality,
                users.username,
                users.status,
                users.gender,
                CONCAT_WS(' ', users.name, users.surname) AS name,
                users.date_of_birth,
                users.email,
                users.created_at
            FROM users
            INNER JOIN faculty ON (faculty.id = users.faculty_id)
            LEFT JOIN speciality ON (speciality.id = users.speciality_id)");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP VIEW IF EXISTS vw_users');
    }

   
}
