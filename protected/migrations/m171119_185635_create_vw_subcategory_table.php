<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vw_subcategory`.
 */
class m171119_185635_create_vw_subcategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE OR REPLACE ALGORITHM = TEMPTABLE VIEW vw_subcategory AS
            SELECT
                subcategory.id,
                subcategory.category_id,
                category.name_ru AS category_ru,
                category.name_tj AS category_tj,  
                subcategory.status,
                subcategory.name_ru,              
                subcategory.name_tj,
                subcategory.created_at
            FROM subcategory
            LEFT JOIN category ON (category.id = subcategory.category_id)");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP VIEW IF EXISTS vw_subcategory');
    }
}
