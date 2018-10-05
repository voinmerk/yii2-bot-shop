<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014901_blog_post extends Migration
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
            '{{%blog_post}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'image'=> $this->string(255)->null()->defaultValue(null),
                'slug'=> $this->string(255)->notNull(),
                'meta_title'=> $this->string(255)->notNull(),
                'meta_keywords'=> $this->text()->notNull(),
                'meta_description'=> $this->text()->notNull(),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('slug','{{%blog_post}}',['slug'],true);
        $this->createIndex('FK_blog_post_user_created','{{%blog_post}}',['created_by'],false);
        $this->createIndex('FK_blog_post_user_updated','{{%blog_post}}',['updated_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('slug', '{{%blog_post}}');
        $this->dropIndex('FK_blog_post_user_created', '{{%blog_post}}');
        $this->dropIndex('FK_blog_post_user_updated', '{{%blog_post}}');
        $this->dropTable('{{%blog_post}}');
    }
}
