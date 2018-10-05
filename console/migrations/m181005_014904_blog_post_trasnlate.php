<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014904_blog_post_trasnlate extends Migration
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
            '{{%blog_post_trasnlate}}',
            [
                'post_id'=> $this->integer(11)->notNull(),
                'language_id'=> $this->integer(11)->notNull(),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'meta_title'=> $this->string(255)->notNull(),
                'meta_keywords'=> $this->text()->null()->defaultValue(null),
                'meta_description'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('FK_blog_post_trasnlate_blog_post','{{%blog_post_trasnlate}}',['post_id'],false);
        $this->createIndex('FK_blog_post_trasnlate_language','{{%blog_post_trasnlate}}',['language_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_blog_post_trasnlate_blog_post', '{{%blog_post_trasnlate}}');
        $this->dropIndex('FK_blog_post_trasnlate_language', '{{%blog_post_trasnlate}}');
        $this->dropTable('{{%blog_post_trasnlate}}');
    }
}
