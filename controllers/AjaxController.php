<?php

namespace app\controllers;

use Yii;
use yii\db\ActiveQuery;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Articles;
use app\models\MyForm;
use app\models\Comments;
use app\models\CommentsForm;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\Url;

class AjaxController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $comment = new Comments();
            $comment->name = $data['CommentsForm']['name'];
            $comment->text = $data['CommentsForm']['text'];
            $comment->article_id = $data['CommentsForm']['article_id'];
            $result = $comment->save();
            $html = '';
            if ($result) {
                $html = '<div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">' . $comment->name .'</h5>
                        <p>' . $comment->text .'</p>
                    </div>
                </div>';
            }
            return json_encode([
                'result' => $result,
                'html' => $html
            ]);
        }
    }
}
