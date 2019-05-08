<?php

use yii\db\Migration;

/**
 * Handles the creation of table `faculty`.
 */
class m171018_161458_create_faculty_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('faculty', [
            'id'            => $this->primaryKey(),
            'short_name'    => $this->string(255)->comment('Короткое наименование'),
            'full_name'     => $this->string(255)->notNull()->comment('Полное наименование'),
            'created_at'    => $this->integer()->notNull()->comment('Дата регистрации'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'updated_at'    => $this->integer()->notNull()->comment('Дата последнего изменения'),
        ]);
        $this->addCommentOnTable('faculty', 'Факультеты');

        $this->batchInsert('faculty', [
            'short_name',
            'full_name',
            'created_at',
            'updated_at',
        ], [
            ['ИТФ', 'Инженерно-технологический факультет', time(), time()],
            ['ФТиД', 'Факультет технологии и дизайн', time(), time()],
			['СТУФ', 'Совместный таджикско-украинский факултет компьютерных систем и интернет-технологий', time(), time()],
			['ФОИТ', 'Факультет отраслевых информационных технологий', time(), time()],
			['ФТиПО', 'Факультет телекоммуникации и профессиональное образование', time(), time()],
			['ФФиИМ', 'Факультет финансового и инновационного менеджмента', time(), time()],
			['ФМиИМ', 'Факультет международного и инвестиционного менеджмента', time(), time()],
			['ФМЭиМ', 'Факультет мировой экономики и маркетинга', time(), time()],
			['Другой', 'Другой', time(), time()],
			
		]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('faculty');
    }
}
