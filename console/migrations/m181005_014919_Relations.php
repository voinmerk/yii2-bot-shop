<?php

use yii\db\Schema;
use yii\db\Migration;

class m181005_014919_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_auth_assignment_item_name',
            '{{%auth_assignment}}','item_name',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_auth_item_rule_name',
            '{{%auth_item}}','rule_name',
            '{{%auth_rule}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_auth_item_child_parent',
            '{{%auth_item_child}}','parent',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_auth_item_child_child',
            '{{%auth_item_child}}','child',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_category_created_by',
            '{{%blog_category}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_category_updated_by',
            '{{%blog_category}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_category_translate_category_id',
            '{{%blog_category_translate}}','category_id',
            '{{%blog_category}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_category_translate_language_id',
            '{{%blog_category_translate}}','language_id',
            '{{%language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_comment_post_id',
            '{{%blog_comment}}','post_id',
            '{{%blog_post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_comment_created_by',
            '{{%blog_comment}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_comment_updated_by',
            '{{%blog_comment}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_post_created_by',
            '{{%blog_post}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_post_updated_by',
            '{{%blog_post}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_post_trasnlate_post_id',
            '{{%blog_post_trasnlate}}','post_id',
            '{{%blog_post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_blog_post_trasnlate_language_id',
            '{{%blog_post_trasnlate}}','language_id',
            '{{%language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_bot_default_category_id',
            '{{%bot}}','default_category_id',
            '{{%category}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_bot_created_by',
            '{{%bot}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_bot_updated_by',
            '{{%bot}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_bot_rating_bot_id',
            '{{%bot_rating}}','bot_id',
            '{{%bot}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_bot_rating_user_id',
            '{{%bot_rating}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_category_created_by',
            '{{%category}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_category_updated_by',
            '{{%category}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_category_translate_category_id',
            '{{%category_translate}}','category_id',
            '{{%category}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_category_translate_language_id',
            '{{%category_translate}}','language_id',
            '{{%language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_comment_bot_id',
            '{{%comment}}','bot_id',
            '{{%bot}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_comment_created_by',
            '{{%comment}}','created_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_comment_updated_by',
            '{{%comment}}','updated_by',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_message_id',
            '{{%message}}','id',
            '{{%source_message}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_auth_assignment_item_name', '{{%auth_assignment}}');
        $this->dropForeignKey('fk_auth_item_rule_name', '{{%auth_item}}');
        $this->dropForeignKey('fk_auth_item_child_parent', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_auth_item_child_child', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_blog_category_created_by', '{{%blog_category}}');
        $this->dropForeignKey('fk_blog_category_updated_by', '{{%blog_category}}');
        $this->dropForeignKey('fk_blog_category_translate_category_id', '{{%blog_category_translate}}');
        $this->dropForeignKey('fk_blog_category_translate_language_id', '{{%blog_category_translate}}');
        $this->dropForeignKey('fk_blog_comment_post_id', '{{%blog_comment}}');
        $this->dropForeignKey('fk_blog_comment_created_by', '{{%blog_comment}}');
        $this->dropForeignKey('fk_blog_comment_updated_by', '{{%blog_comment}}');
        $this->dropForeignKey('fk_blog_post_created_by', '{{%blog_post}}');
        $this->dropForeignKey('fk_blog_post_updated_by', '{{%blog_post}}');
        $this->dropForeignKey('fk_blog_post_trasnlate_post_id', '{{%blog_post_trasnlate}}');
        $this->dropForeignKey('fk_blog_post_trasnlate_language_id', '{{%blog_post_trasnlate}}');
        $this->dropForeignKey('fk_bot_default_category_id', '{{%bot}}');
        $this->dropForeignKey('fk_bot_created_by', '{{%bot}}');
        $this->dropForeignKey('fk_bot_updated_by', '{{%bot}}');
        $this->dropForeignKey('fk_bot_rating_bot_id', '{{%bot_rating}}');
        $this->dropForeignKey('fk_bot_rating_user_id', '{{%bot_rating}}');
        $this->dropForeignKey('fk_category_created_by', '{{%category}}');
        $this->dropForeignKey('fk_category_updated_by', '{{%category}}');
        $this->dropForeignKey('fk_category_translate_category_id', '{{%category_translate}}');
        $this->dropForeignKey('fk_category_translate_language_id', '{{%category_translate}}');
        $this->dropForeignKey('fk_comment_bot_id', '{{%comment}}');
        $this->dropForeignKey('fk_comment_created_by', '{{%comment}}');
        $this->dropForeignKey('fk_comment_updated_by', '{{%comment}}');
        $this->dropForeignKey('fk_message_id', '{{%message}}');
    }
}
