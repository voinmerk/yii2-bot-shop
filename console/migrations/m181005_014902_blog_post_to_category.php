<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014902_blog_post_to_category extends Migration
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
            '{{%blog_post_to_category}}',
            [
                'post_id'=> $this->integer(11)->notNull(),
                'category_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_post_to_category}}');
    }
}
