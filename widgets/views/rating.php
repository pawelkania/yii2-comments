<?php

use alfa6661\widgets\Raty;

/* @var $this \yii\web\View */
/* @var $commentModel \yii2mod\comments\models\CommentModel */
/* @var $showCommentCount bool */
/* @var $showStars bool */
/* @var $widgetId string */
?>
<div class="rating">
    <?php if ($showStars): ?>
        <span class="rating-stars">
            <?= Raty::widget([
                'id' => $widgetId . "-rating-{$commentModel->entityId}",
                'name' => 'overal-rating',
                'value' => $commentModel->getOveralRating(),
                'pluginOptions' => [
                    'readOnly' => true,
                    'starType' => 'i',
                ],
            ]); ?>
        </span>
    <?php endif; ?>
    <?php if ($showCommentCount): ?>
        <span class="rating-comment-count">
            <?php echo Yii::t('yii2mod.comments', 'Comments ({n})', ['n' => $commentModel->getCommentsCount()]); ?>
        </span>
    <?php endif; ?>
</div>
