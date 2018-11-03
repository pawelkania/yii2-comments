<?php

namespace yii2mod\comments\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\Html;
use yii2mod\comments\traits\ModuleTrait;

class Rating extends Widget
{
    use ModuleTrait;

    public $showCommentCount = true;
    public $showStars = true;

    /**
     * @var \yii\db\ActiveRecord|null Widget model
     */
    public $model;

    public $tag = 'div';
    public $options = [];

    /**
     * @var string the view file that will render the comment tree and form for posting comments
     */
    public $view = '@vendor/yii2mod/yii2-comments/widgets/views/rating';

    /**
     * @var string entity id attribute
     */
    public $entityIdAttribute = 'id';

    /**
     * @var string hash(crc32) from class name of the widget model
     */
    protected $entity;

    /**
     * @var int primary key value of the widget model
     */
    protected $entityId;

    /**
     * Initializes the widget params.
     */
    public function init()
    {
        parent::init();

        if (empty($this->model)) {
            throw new InvalidConfigException(Yii::t('yii2mod.comments', 'The "model" property must be set.'));
        }

        if (empty($this->model->{$this->entityIdAttribute})) {
            throw new InvalidConfigException(Yii::t('yii2mod.comments', 'The "entityIdAttribute" value for widget model cannot be empty.'));
        }

        $this->entity = hash('crc32', get_class($this->model));
        $this->entityId = $this->model->{$this->entityIdAttribute};
    }

    /**
     * Executes the widget.
     *
     * @return string the result of widget execution to be outputted
     */
    public function run()
    {
        $commentClass = $this->getModule()->commentModelClass;
        $commentModel = Yii::createObject([
            'class' => $commentClass,
            'entity' => $this->entity,
            'entityId' => $this->entityId,
        ]);

        return Html::tag(
            $this->tag,
            $this->render($this->view, [
                'commentModel' => $commentModel,
                'showCommentCount' => $this->showCommentCount,
                'showStars' => $this->showStars,
            ]),
            $this->options);
    }
}
