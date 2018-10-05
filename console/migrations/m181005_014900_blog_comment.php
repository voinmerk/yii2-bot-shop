<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014900_blog_comment extends Migration
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
            '{{%blog_comment}}',
            [
                'id'=> $this->primaryKey(11),
                'content'=> $this->text()->notNull(),
                'post_id'=> $this->integer(11)->notNull(),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('FK_blog_comment_user_created','{{%blog_comment}}',['created_by'],false);
        $this->createIndex('FK_blog_comment_user_updated','{{%blog_comment}}',['updated_by'],false);
        $this->createIndex('FK_blog_comment_blog_post','{{%blog_comment}}',['post_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_blog_comment_user_created', '{{%blog_comment}}');
        $this->dropIndex('FK_blog_comment_user_updated', '{{%blog_comment}}');
        $this->dropIndex('FK_blog_comment_blog_post', '{{%blog_comment}}');
        $this->dropTable('{{%blog_comment}}');
    }
}
