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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        /** @var ActiveQuery $query */
        $query = Articles::find();
        $allArticlesCount = $query->count();
        $pagination = new Pagination([
            'totalCount' => $allArticlesCount,
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $articleId = Yii::$app->request->get('id', 1);
        $article = Articles::find()->where(['id' => $articleId])->one();
        if (!$article) {
            $article = Articles::find()->where(['id' => 1])->one();
        }

        $commentsForm = new CommentsForm();
        if ($commentsForm->load(Yii::$app->request->post()) && $commentsForm->validate()){
            $comments = new Comments();
            $comments->name = Html::encode($commentsForm->name);
            $comments->text = Html::encode($commentsForm->text);
            $comments->article_id = $article->id;
            $comments->save();
        }

        $comments = Comments::find()->where(['article_id' => $article->id])
            ->orderBy(['id' => SORT_DESC])->all();
        $this->view->title = $article->title;
        return $this->render(
            'single_article',
            [
                'article' => $article,
                'comments' => $comments,
                'commentsForm' => $commentsForm
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionEdit()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $articleId = Yii::$app->request->get('id', 1);
        $article = Articles::find()->where(['id' => $articleId])->one();
        if (!$article) {
            $article = Articles::find()->where(['id' => 1])->one();
        }

        $form = new MyForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()){
            $article->title = Html::encode($form->title);
            $article->short_description = Html::encode($form->short_description);
            $article->description = Html::encode($form->description);
            $article->date = Html::encode($form->date);
            $article->author = Html::encode($form->author);
            $form->image = UploadedFile::getInstance($form, 'image');
            $fileName = 'assets/images/articles/' . $form->image->baseName . '.' . $form->image->extension;
            if ($form->image->saveAs($fileName)) {
                $article->image = $fileName;
            }

            $article->save();
        }

        $this->view->title = $article->title;
        return $this->render(
            'article_edit',
            [
                'article' => $article,
                'form' => $form
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCreateArticle()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new MyForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $article = new Articles();
            $article->title = Html::encode($form->title);
            $article->short_description = Html::encode($form->short_description);
            $article->description = Html::encode($form->description);
            $article->date = Html::encode($form->date);
            $article->author = Html::encode($form->author);
            $form->image = UploadedFile::getInstance($form, 'image');
            $fileName = 'assets/images/articles/' . $form->image->baseName . '.' . $form->image->extension;
            if ($form->image->saveAs($fileName)) {
                $article->image = $fileName;
            }

            $article->save();
        }

        $this->view->title = 'Create Article Page';
        return $this->render(
            'article_create',
            [
                'form' => $form
            ]
        );
    }

    public function actionRemove()
    {
        $articleId = Yii::$app->request->get('id', 1);
        $article = Articles::find()->where(['id' => $articleId])->one();
        if ($article) {
            try {
                $title = $article->title;
                $article->delete();
                Yii::$app->session->setFlash('success', "Article '" . $title . "' was removed!");
            } catch (\Throwable $exception) {
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        $url = Url::to(['site/articles']);
        $this->redirect($url,302);
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
