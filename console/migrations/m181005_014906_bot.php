<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014906_bot extends Migration
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
            '{{%bot}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'content'=> $this->text()->notNull(),
                'meta_title'=> $this->string(255)->notNull(),
                'meta_keywords'=> $this->text()->null()->defaultValue(null),
                'meta_description'=> $this->text()->null()->defaultValue(null),
                'username'=> $this->string(255)->notNull(),
                'token'=> $this->string(255)->notNull(),
                'start_param'=> $this->string(255)->null()->defaultValue(null),
                'image'=> $this->string(255)->notNull(),
                'views'=> $this->integer(11)->notNull()->defaultValue(0),
                'status'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'default_category_id'=> $this->integer(11)->null()->defaultValue(null),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('name','{{%bot}}',['username'],true);
        $this->createIndex('token','{{%bot}}',['token'],true);
        $this->createIndex('FK_bot_user_created','{{%bot}}',['created_by'],false);
        $this->createIndex('FK_bot_user_updated','{{%bot}}',['updated_by'],false);
        $this->createIndex('FK_bot_category','{{%bot}}',['default_category_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('name', '{{%bot}}');
        $this->dropIndex('token', '{{%bot}}');
        $this->dropIndex('FK_bot_user_created', '{{%bot}}');
        $this->dropIndex('FK_bot_user_updated', '{{%bot}}');
        $this->dropIndex('FK_bot_category', '{{%bot}}');
        $this->dropTable('{{%bot}}');
    }
}
