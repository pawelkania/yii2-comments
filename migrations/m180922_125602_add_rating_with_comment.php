<?php

use yii\db\Migration;

class m180922_125602_add_rating_with_comment extends Migration
{
    public function safeUp()
    {
        $this->addColumn('comment', 'rating', $this->smallInteger());
    }

    public function safeDown()
    {
        $this->dropColumn('comment', 'rating');
    }
}
