<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vw_book`.
 */
class m171214_130110_create_vw_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE OR REPLACE ALGORITHM = TEMPTABLE VIEW vw_book AS
            SELECT
                book.id,
                book.category_id,
                category.name_ru AS category_ru,
                category.name_tj AS category_tj,
                book.subcategory_id,
                subcategory.name_ru AS subcategory_ru,
                subcategory.name_tj AS subcategory_tj,
                book.author,
                book.description,
                book.name_book,
                book_views.view AS book_view,
                book.status,
                book.lang_book,
                book.path,
                book.path_photo,
                book.created_at
            FROM book
            LEFT JOIN category ON (category.id = book.category_id)
            LEFT JOIN subcategory ON (subcategory.id = book.subcategory_id)
            LEFT JOIN book_views ON (book_views.book_id = book.name_book)");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP VIEW IF EXISTS vw_book');
    }
}
