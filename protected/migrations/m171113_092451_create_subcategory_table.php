<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subcategory`.
 */
class m171113_092451_create_subcategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subcategory', [
            'id' => $this->primaryKey(),
            'category_id'   => $this->integer()->notNull()->comment('Категории'),
            'name_ru'    	=> $this->string(255)->notNull()->comment('Название подкатегории на русском'),
			'name_tj'       => $this->string(255)->notNull()->comment('Номи зеркатегорияхо'),
			'status'        => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'created_at'    => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'    => $this->integer()->notNull()->comment('Дата последнего изменения'),
            'FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE RESTRICT ON UPDATE RESTRICT',
        ]);
        $this->addCommentOnTable('subcategory', 'Подкатегория');

        $this->batchInsert('subcategory', [
            'category_id',
            'name_ru',
			'name_tj',
            'created_at',
            'updated_at',
        ], [
			['1', 'легкая промышленность', 'саноати сабук', time(), time()],
			['1', 'пищевая промышленность', 'саноати хурокворӣ', time(), time()],
			['1', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
			['3', 'международный менеджмент', 'менеҷменти байналмиллалӣ', time(), time()],
			['3', 'инвестиционный менеджмент', 'менеҷменти инвеститсионӣ', time(), time()],
			['3', 'маркетинг', 'маркетинг', time(), time()],
			['3', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
			['4', 'мировая экономика', 'иқтисоди ҷаҳон', time(), time()],
			['4', 'национальная экономика', 'иқтисоди миллӣ', time(), time()],
			['4', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
            ['5', 'математика', 'математика',  time(), time()],
			['5', 'физика', 'физика', time(), time()],
			['5', 'геометрия', 'геометрия', time(), time()],
			['5', 'биология', 'биология', time(), time()],
			['5', 'химия', 'химия', time(), time()],
			['5', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
			['6', 'социология', 'сотсиология', time(), time()],
			['6', 'культурология', 'фарҳангшиносӣ', time(), time()],
			['6', 'язык', 'забон', time(), time()],
			['6', 'литература', 'адабиёт', time(), time()],
			['6', 'история', 'таърих', time(), time()],
			['6', 'право', 'ҳуқуқ', time(), time()],
			['6', 'религия', 'дин', time(), time()],
			['6', 'естественные науки', 'табиатшиносӣ', time(), time()],
			['6', 'концепция', 'консепсия', time(), time()],
			['6', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
			['13', 'для магистров', 'барои магистрҳо', time(), time()],
			['13', 'для студентов', 'барои донишҷӯён', time(), time()],
			['13', 'другие публикации ...', 'дигар адабиётҳо…', time(), time()],
			

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subcategory');
    }
}
