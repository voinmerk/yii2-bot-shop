<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014918_user extends Migration
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
            '{{%user}}',
            [
                'id'=> $this->primaryKey(11),
                'username'=> $this->string(255)->notNull(),
                'auth_key'=> $this->string(32)->notNull(),
                'first_name'=> $this->string(255)->notNull(),
                'last_name'=> $this->string(255)->notNull(),
                'avatar'=> $this->string(255)->notNull(),
                'status'=> $this->smallInteger(6)->notNull()->defaultValue(10),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('username','{{%user}}',['username'],true);

    }

    public function safeDown()
    {
        $this->dropIndex('username', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}
