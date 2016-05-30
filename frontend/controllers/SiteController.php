<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ShortUrl;
use yii\web\Controller;

/**
 * Контроллер главной страницы
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Экшен главной страницы
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $userUrl = new ShortUrl();
        return $this->render(
            'index',
            [
                'userUrl' => $userUrl
            ]
        );
    }

    /**
     * Экшен получения короткого урла
     *
     * @return mixed
     */
    public function actionCreateShortUrl()
    {
        $data = \Yii::$app->request->post();
        $shortUrl = new ShortUrl();
        $shortUrl->load($data);
        $shortUrl->save();

        return $this->render(
            'short_url',
            [
                'shortUrl' => $shortUrl,
            ]
        );
    }

    /**
     * Экшен редиректа по ссылкам
     */
    public function actionRedirect()
    {
        $code = Yii::$app->request->get('code');
        $shortUrl = ShortUrl::findOne(['short_code' => $code]);

        if(!$shortUrl) {
            throw new \yii\web\NotFoundHttpException(
                'Такой страницы не существует.', 404
            );
        }

        header('Location: ' . $shortUrl->url);
    }
}
