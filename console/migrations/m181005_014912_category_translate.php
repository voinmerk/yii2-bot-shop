<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014912_category_translate extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%category_translate}}',
            [
                'category_id'=> $this->integer(11)->notNull(),
                'language_id'=> $this->integer(11)->notNull(),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->null()->defaultValue(null),
                'meta_title'=> $this->string(255)->notNull(),
                'meta_keywords'=> $this->text()->null()->defaultValue(null),
                'meta_description'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('FK_category_translate_category','{{%category_translate}}',['category_id'],false);
        $this->createIndex('FK_category_translate_language','{{%category_translate}}',['language_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_category_translate_category', '{{%category_translate}}');
        $this->dropIndex('FK_category_translate_language', '{{%category_translate}}');
        $this->dropTable('{{%category_translate}}');
    }
}
