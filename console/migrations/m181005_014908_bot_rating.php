<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014908_bot_rating extends Migration
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
            '{{%bot_rating}}',
            [
                'id'=> $this->primaryKey(11),
                'bot_id'=> $this->integer(11)->notNull(),
                'user_id'=> $this->integer(11)->notNull(),
                'rating'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('FK_bot_rating_bot','{{%bot_rating}}',['bot_id'],false);
        $this->createIndex('FK_bot_rating_user','{{%bot_rating}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_bot_rating_bot', '{{%bot_rating}}');
        $this->dropIndex('FK_bot_rating_user', '{{%bot_rating}}');
        $this->dropTable('{{%bot_rating}}');
    }
}
