<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014909_bot_to_bot_language extends Migration
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
            '{{%bot_to_bot_language}}',
            [
                'bot_id'=> $this->integer(11)->notNull(),
                'bot_language_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%bot_to_bot_language}}');
    }
}
