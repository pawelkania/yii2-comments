<?php

use yii\db\Migration;

class m180920_174617_add_comments_as_guest extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%comment}}', 'email', $this->text());
        $this->addColumn('{{%comment}}', 'username', $this->text());
        $this->alterColumn('{{%comment}}', 'createdBy', $this->integer()->append(', ALTER COLUMN "createdBy" DROP NOT NULL'));
        $this->alterColumn('{{%comment}}', 'updatedBy', $this->integer()->append(', ALTER COLUMN "updatedBy" DROP NOT NULL'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%comment}}', 'email');
        $this->dropColumn('{{%comment}}', 'username');
        $this->alterColumn('{{%comment}}', 'createdBy', $this->integer()->append(', ALTER COLUMN "createdBy" SET NOT NULL'));
        $this->alterColumn('{{%comment}}', 'updatedBy', $this->integer()->append(', ALTER COLUMN "updatedBy" SET NOT NULL'));
    }
}
