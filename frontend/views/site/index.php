<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\UrlShortenerAsset;

UrlShortenerAsset::register($this);

/* @var $this yii\web\View */
$this->title = 'Укоротитель ссылок';
?>
<div class="url-shortener__block">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row url-shortener__form">
        <?php $form = ActiveForm::begin([
            'id' => 'urlShortenerForm',
            'action' => ['site/create-short-url'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]); ?>
        <div class="col-md-6">
        <?= $form->field($userUrl, 'url') ?>
        </div>
        <div class="col-md-6">
            <?= Html::submitButton(
                'Укоротить',
                [
                    'class' => 'btn btn-success create-short-url__btn',
                    'name' => 'shortener-button'
                ]) ?>
        </div>
        <?php ActiveForm::end();?>
    </div>
    <div class="row short-url-result"></div>
</div>
<?php $this->registerJs("
    $(document).ready(function() {
        UrlShortenerForm.init();
    });"
); ?>