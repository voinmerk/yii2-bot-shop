<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014858_blog_category extends Migration
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
            '{{%blog_category}}',
            [
                'id'=> $this->primaryKey(11),
                'parent_id'=> $this->integer(11)->notNull()->defaultValue(0),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'image'=> $this->string(255)->null()->defaultValue(null),
                'meta_title'=> $this->string(255)->notNull(),
                'meta_keywords'=> $this->text()->notNull(),
                'meta_description'=> $this->text()->notNull(),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('FK_blog_category_user_created','{{%blog_category}}',['created_by'],false);
        $this->createIndex('FK_blog_category_user_updated','{{%blog_category}}',['updated_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_blog_category_user_created', '{{%blog_category}}');
        $this->dropIndex('FK_blog_category_user_updated', '{{%blog_category}}');
        $this->dropTable('{{%blog_category}}');
    }
}
