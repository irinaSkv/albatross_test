<?php
use yii\helpers\Url;
use yii\helpers\Html;

$url = Url::to($shortUrl->short_code, true);
?>
<div class="url-shortener__block">
    <div class="row">
            <div class="col-md-6">
                <b>Ваша ссылка:</b> <?= $shortUrl->url; ?>
            </div>
            <div class="col-md-6">
                <b>Укороченная ссылка:</b> 
                <?= Html::input('text', 'short_link', $url, [
                    'autofocus' => 'true',
                    'readonly' => true,
                    'class' => 'short_link__input',
                ]) ?>
            </div>
        </div>
    </div>
</div>