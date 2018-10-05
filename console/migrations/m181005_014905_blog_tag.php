<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014905_blog_tag extends Migration
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
            '{{%blog_tag}}',
            [
                'id'=> $this->primaryKey(11),
                'content'=> $this->text()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_tag}}');
    }
}
