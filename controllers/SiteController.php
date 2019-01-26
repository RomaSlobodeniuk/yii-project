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

class SiteController extends Controller
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
        return $this->render('index', ['my_custom_param' => 'Hello!']);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionArticles()
    {
        /** @var ActiveQuery $query */
        $query = Articles::find();
        $allArticlesCount = $query->count();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 1,
            'pageSizeParam' => false,
            'forcePageParam' => false
        ]);
        $articles = $query->orderBy(['date' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->view->title = 'Articles';
        return $this->render(
            'articles',
            [
                'articles' => $articles,
                'allArticlesCount' => $allArticlesCount,
                'activePage' => Yii::$app->request->get('page', 1),
                'countPages' => $pagination->getPageCount(),
                'pagination' => $pagination
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionArticle()
    {
        $articleId = Yii::$app->request->get('id', 1);
        $article = Articles::find()->where(['id' => $articleId])->one();
        if (!$article) {
            $article = Articles::find()->where(['id' => 1])->one();
        }

        $this->view->title = $article->title;
        return $this->render(
            'single_article',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
