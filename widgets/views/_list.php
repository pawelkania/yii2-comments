<?php

use common\models\user\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii2mod\editable\Editable;
use alfa6661\widgets\Raty;

/* @var $this \yii\web\View */
/* @var $model \yii2mod\comments\models\CommentModel */
/* @var $maxLevel null|integer comments max level */
?>
<li class="comment" id="comment-<?php echo $model->id; ?>">
    <div class="comment-content" data-comment-content-id="<?php echo $model->id; ?>">
        <div class="comment-author-avatar">
            <?php echo Html::img($model->getAvatar(), ['alt' => $model->getAuthorName()]); ?>
        </div>
        <div class="comment-details">
            <div class="comment-action-buttons">
                <?php if (Yii::$app->getUser()->can(User::ROLE_ADMIN)) : ?>
                    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('yii2mod.comments', 'Delete'), '#', ['class' => 'delete-comment-btn', 'data' => ['action' => 'delete', 'url' => Url::to(['/comment/default/delete', 'id' => $model->id]), 'comment-id' => $model->id]]); ?>
                <?php endif; ?>
                <?php if ($model->level < $maxLevel || is_null($maxLevel)) : ?>
                    <?php echo Html::a("<span class='glyphicon glyphicon-share-alt'></span> " . Yii::t('yii2mod.comments', 'Reply'), '#', ['class' => 'reply-comment-btn', 'data' => ['action' => 'reply', 'comment-id' => $model->id]]); ?>
                <?php endif; ?>
            </div>
            <div class="comment-author-name d-i-b">
                <span>
                    <?php echo Html::a($model->getAuthorName(), $model->getAnchorUrl(), ['class' => 'comment-date']); ?>
                </span>
            </div>
            <div class="comment-rating d-i-b">
                <?php if ($model->rating): ?>
                    <?= Raty::widget([
                        'name' => "rating-{$model->id}",
                        'value' => $model->rating,
                        'pluginOptions' => [
                            'readOnly' => true,
                            'starType' => 'i',
                        ],
                    ]); ?>
                <?php endif; ?>
            </div>
            <div class="comment-body">
                <?php if (Yii::$app->getModule('comment')->enableInlineEdit && Yii::$app->getUser()->can(User::ROLE_ADMIN)): ?>
                    <?php echo Editable::widget([
                        'model' => $model,
                        'attribute' => 'content',
                        'url' => Url::to(['/comment/default/quick-edit']),
                        'options' => [
                            'id' => 'editable-comment-' . $model->id,
                        ],
                    ]); ?>
                <?php else: ?>
                    <?php // echo $model->getContent(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</li>
<?php if ($model->hasChildren()) : ?>
    <ul class="children">
        <?php foreach ($model->getChildren() as $children) : ?>
            <?php echo $this->render('_list', ['model' => $children, 'maxLevel' => $maxLevel]); ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
