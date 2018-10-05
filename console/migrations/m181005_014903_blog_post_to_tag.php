<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014903_blog_post_to_tag extends Migration
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
            '{{%blog_post_to_tag}}',
            [
                'post_id'=> $this->integer(11)->notNull(),
                'tag_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_post_to_tag}}');
    }
}
