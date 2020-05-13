<?php

use pawelkania\widgets\barrating\BarRating;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use alfa6661\widgets\Raty;

/* @var $this \yii\web\View */
/* @var $commentModel \yii2mod\comments\models\CommentModel */
/* @var $encryptedEntity string */
/* @var $formId string comment form id */
?>
<div class="comment-form-container">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => $formId,
            'class' => 'comment-box',
        ],
        'action' => Url::to(['/comment/default/create', 'entity' => $encryptedEntity]),
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>

    <?= $form->field($commentModel, 'rating')->widget(Raty::class, [
        'pluginOptions' => [
            'starType' => 'i',
            'cancel' => true,
        ],
    ]); ?>
    <?php // echo $form->field($commentModel, 'content', ['template' => '{input}{error}'])->textarea(['placeholder' => Yii::t('yii2mod.comments', 'Add a comment...'), 'rows' => 4, 'data' => ['comment' => 'content']]); ?>

    <?php if (\Yii::$app->user->isGuest) : ?>
        <div class="row">
            <div class="col-sm-6">
                <?php
                echo $form
                    ->field($commentModel, 'email', ['template' => '{input}{error}'])
                    ->textInput([
                        'placeholder' => Yii::t('yii2mod.comments', 'E-mail'),
                        'data' => ['comment' => 'email'],
                    ]);
                ?>
            </div>
            <div class="col-sm-6">
                <?php
                echo $form
                    ->field($commentModel, 'username', ['template' => '{input}{error}'])
                    ->textInput([
                        'placeholder' => Yii::t('yii2mod.comments', 'Username'),
                        'data' => ['comment' => 'username'],
                    ]);
                ?>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $form->field($commentModel, 'parentId', ['template' => '{input}'])->hiddenInput(['data' => ['comment' => 'parent-id']]); ?>
    <div class="comment-box-partial">
        <div class="button-container show">
            <?php echo Html::a(Yii::t('yii2mod.comments', 'Click here to cancel reply.'), '#', ['id' => 'cancel-reply', 'class' => 'pull-right', 'data' => ['action' => 'cancel-reply']]); ?>
            <?php echo Html::submitButton(Yii::t('yii2mod.comments', 'Comment'), ['class' => 'btn btn-primary comment-submit']); ?>
        </div>
    </div>
    <?php $form->end(); ?>
    <div class="clearfix"></div>
</div>
