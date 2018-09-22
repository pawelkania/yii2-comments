<?php

namespace yii2mod\comments\models;

use Yii;
use yii\db\ActiveQuery;
use yii2mod\moderation\ModerationQuery;

class CommentQuery extends ModerationQuery
{
    /**
     * @return ActiveQuery
     */
    public function withRating(): self
    {
        return $this->andWhere(['not', ['rating' => null]]);
    }
}
