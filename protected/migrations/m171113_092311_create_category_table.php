<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171113_092311_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name_ru'     	=> $this->string(255)->notNull()->comment('Название категории'),
			'name_tj'      	=> $this->string(255)->notNull()->comment('Номи категорияхо'),
			'status'        => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'created_at'    => $this->integer()->notNull()->comment('Дата регистрации'),
            'updated_at'    => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
        
         $this->addCommentOnTable('category', 'Категории');

        $this->batchInsert('category', [
            'name_ru',
			'name_tj',
            'created_at',
            'updated_at',
        ], [
            [' Литература о промышленность', 'Адабиёти соҳаи саноат', time(), time()],
			[' Технические науки', 'Адабиёти илмҳои техникӣ', time(), time()],
			[' Менеджмент', 'Адабиёти соҳаи менеҷмент', time(), time()],
			[' Экономика',  'Адабиёти иқтисодӣ', time(), time()],
			[' Точные науки',  'Адабиёти илмҳои дақиқ', time(), time()],
			[' Гуманитарные науки', 'Адабиёти илмҳои гуманитарӣ', time(), time()],
			[' Художественная литература', 'Адабиёти бадеӣ', time(), time()],
			[' Политическая литература', 'Адабиёти сиёсӣ', time(), time()],
			[' Монографии', 'Монографияҳо', time(), time()],		
			[' Литература Лидера нации', 'Асарҳои Пешвои миллат', time(), time()],
			[' Законы', 'Қонунҳо', time(), time()],
			[' Методические пособии', 'Дастурҳои методӣ', time(), time()],
			[' Рабочие программы (силлабусы)', 'Барномаҳои корӣ (силлабусҳо)', time(), time()],
			[' Журналы', 'Маҷаллаҳо', time(), time()],
			[' Газеты', 'Рўзномаҳо', time(), time()],
			[' Для абитуриентов', 'Барои довталабон', time(), time()],
						
		]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
