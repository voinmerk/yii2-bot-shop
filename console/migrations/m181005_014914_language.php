<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014914_language extends Migration
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
            '{{%language}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->notNull(),
                'code'=> $this->string(255)->notNull(),
                'default'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'created_by'=> $this->integer(11)->notNull(),
                'updated_by'=> $this->integer(11)->notNull(),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('code','{{%language}}',['code'],true);

    }

    public function safeDown()
    {
        $this->dropIndex('code', '{{%language}}');
        $this->dropTable('{{%language}}');
    }
}
