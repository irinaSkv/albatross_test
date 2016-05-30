<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->createTable('short_url', [
            'id' => $this->primaryKey(),
            'url' => $this->string(500)->notNull(),
            'short_code' => $this->string(32)->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable('short_url');
    }
}