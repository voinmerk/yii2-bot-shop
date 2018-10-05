<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014911_category extends Migration
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
            '{{%category}}',
            [
                'id'=> $this->primaryKey(11),
                'slug'=> $this->string(255)->notNull(),
                'image'=> $this->string(255)->null()->defaultValue(null),
                'sort_order'=> $this->integer(11)->notNull(),
                'status'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'created_by'=> $this->integer(11)->null()->defaultValue(null),
                'updated_by'=> $this->integer(11)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('slug','{{%category}}',['slug'],true);
        $this->createIndex('FK_category_user_created','{{%category}}',['created_by'],false);
        $this->createIndex('FK_category_user_updated','{{%category}}',['updated_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('slug', '{{%category}}');
        $this->dropIndex('FK_category_user_created', '{{%category}}');
        $this->dropIndex('FK_category_user_updated', '{{%category}}');
        $this->dropTable('{{%category}}');
    }
}
