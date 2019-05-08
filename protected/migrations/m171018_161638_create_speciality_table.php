<?php

use yii\db\Migration;

/**
 * Handles the creation of table `speciality`.
 */
class m171018_161638_create_speciality_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('speciality', [
            'id'            => $this->primaryKey(),
            'faculty_id'    => $this->integer()->notNull()->comment('Факультет'),
            'short_name'    => $this->string(255)->comment('Короткое наименование'),
            'full_name'     => $this->string(255)->notNull()->comment('Полное наименование'),
            'created_at'    => $this->integer()->notNull()->comment('Дата регистрации'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('Статус'),
            'updated_at'    => $this->integer()->notNull()->comment('Дата последнего изменения'),
            'FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE RESTRICT ON UPDATE RESTRICT',
        ]);
        $this->addCommentOnTable('faculty', 'Специальности');

        $this->batchInsert('speciality', [
            'faculty_id',
            'short_name',
            'full_name',
            'created_at',
            'updated_at',
        ], [
            ['1', '1-540101', 'Метрология, стандартизация и сертификация', time(), time()],
            ['1', '1-360901', 'Машины и аппараты производство пищевых продуктов', time(), time()],
			['1', '1-490101', 'Технология хранения и преработки сирых пищевых продуктов', time(), time()],
			['1', '1-49010108', 'Технология функционального и детского питания', time(), time()],
			['1', '1-490102', 'Технология хранения и преработки животного сырья', time(), time()],
			['1', '1-910101', 'Производство продукции и организации общественного питания', time(), time()],
			['2', '1-500101', 'Технология пряжи, тканей, трикотажа и нетканных материалов', time(), time()],
			['2', '1-500102', 'Конструирование и технология швейных изделий', time(), time()],
			['2', '1-190101', 'Дизайн (по направлениям)', time(), time()],
			['2', '1-1901010501', 'Дизайн швейных изделий', time(), time()],
			['2', '1-1901010504', 'Дизайн текстильных изделий', time(), time()],
			['2', '1-50010101', 'Прядение естественных нитей', time(), time()],
			['2', '1-50010104', 'Технология тканей', time(), time()],
			['2', '1-50010105', 'Технология трикотажа', time(), time()],
			['2', '1-50010107', 'Проектирования оформления тектильных тканей', time(), time()],
			['2', '1-50010201', 'Технология швейных изделий', time(), time()],
			['2', '1-500101', 'Метрология, стандартизация и сертификация (легкая промышленность)', time(), time()],
			['2', '1-54010104', 'Технология пряжи, тканей, трикотажа и нетканных материалов', time(), time()],
			['3', '1-40010101', 'Компьютерные системы и интернет-технологий', time(), time()],
			['3', '1-40010103', 'Банковские компьютерные системы', time(), time()],
			['4', '1-40010202', 'Технология и информационные системы (в экономике)', time(), time()],
			['4', '1-40010104', 'Системы обеспечения безопасности данных', time(), time()],
			['4', '1-40010107', 'Математическое и программное обеспечение автоматизированных производств', time(), time()],
			['4', '1-40010108', 'Программная инженерия', time(), time()],
			['4', '1-25011024', 'Информационное обеспечение бизнеса', time(), time()],
			['5', '1-450103', 'Телекоммуникационные сети', time(), time()],
			['5', '1-08010107(02)', 'Специализация "Компьютерный дизайн, интернет и мультимедиа технологии"', time(), time()],
			['5', '1-08010107(01)', 'Специализация "Телекоммуникационные системы и сети, системы мобильной, спутниковой связи и радиотехники"', time(), time()],
			['5', '1-08010110(01)', 'Специализация "Проектирование стиля человека и окружающей среды"', time(), time()],
			['5', '1-08010111(02)', 'Специализация "Технология изделий и легкой промышленности"', time(), time()],
			['6', '1-25010104', 'Экономика научно-технического прогресса', time(), time()],
			['6', '1-25010201', 'Экономический анализ', time(), time()],
			['6', '1-25010410', 'Финансы и кредит', time(), time()],
			['6', '1-250107', 'Экономика и управление на предприятии (промышленные преприятии)', time(), time()],
			['6', '1-25010707', 'Управление проектами', time(), time()],
			['6', '1-740501', 'управление и дипломатия использования водных ресурсов', time(), time()],
			['7', '1-26020202', 'Международный менеджент', time(), time()],
			['7', '1-26020205', 'Инвестиционный менеджент', time(), time()],
			['7', '1-26020202', 'Международный менеджент', time(), time()],
			['8', '1-250103', 'Мировая экономика', time(), time()],
			['8', '1-25010304', 'Управление иностранными инвестициями', time(), time()],
			['8', '1-26020305', 'Международный маркетинг', time(), time()],
			['9', 'другой', 'другой', time(), time()],
			
			
			
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('speciality');
    }
}