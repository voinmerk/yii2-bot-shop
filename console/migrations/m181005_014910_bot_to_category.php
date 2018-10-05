<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014910_bot_to_category extends Migration
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
            '{{%bot_to_category}}',
            [
                'bot_id'=> $this->integer(11)->notNull(),
                'category_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%bot_to_category}}');
    }
}
