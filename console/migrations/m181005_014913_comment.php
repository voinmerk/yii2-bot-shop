<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014913_comment extends Migration
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
            '{{%comment}}',
            [
                'id'=> $this->primaryKey(11),
                'content'=> $this->text()->notNull(),
                'bot_id'=> $this->integer(11)->notNull(),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('FK_comment_user_created','{{%comment}}',['created_by'],false);
        $this->createIndex('FK_comment_user_updated','{{%comment}}',['updated_by'],false);
        $this->createIndex('FK_comment_bot','{{%comment}}',['bot_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_comment_user_created', '{{%comment}}');
        $this->dropIndex('FK_comment_user_updated', '{{%comment}}');
        $this->dropIndex('FK_comment_bot', '{{%comment}}');
        $this->dropTable('{{%comment}}');
    }
}
