<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_tag_assignments}}`.
 */
class m210311_202338_create_blog_tag_assignments_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%blog_tag_assignments}}', [
            'post_id' => $this->char(36)->notNull(),
            'tag_id' => $this->char(36)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-blog_tag_assignments}}', '{{%blog_tag_assignments}}', ['post_id', 'tag_id']);

        $this->createIndex('{{%idx-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id');
        $this->createIndex('{{%idx-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id');

        $this->addForeignKey('{{%fk-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id', '{{%blog_posts}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id', '{{%blog_tags}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%blog_tag_assignments}}');
    }
}
