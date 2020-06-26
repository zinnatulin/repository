<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\db\Connection;
use yii\db\Command;

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

    public function actionEntry(){
        $model = new EntryForm();
        $transliteration = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'cz',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shh',
            'ъ' => 'ʺ',
            'ы' => 'y`',
            'ь' => '',
            'э' => 'e`',
            'ю' => 'yu',
            'я' => 'ya',
            '№' => '#', 'Ӏ' => '‡',
            '’' => '`', 'ˮ' => '¨',
        );

        if($model->load(Yii::$app->request->post())) {
            
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            foreach ($model->imageFiles as $file) {
                    $temp_name = mb_strtolower($file->name);//приведение к нижнему регистру
                    $temp_name = strtr($temp_name, $transliteration);//выполнение транслитерации
                    $file->name = $temp_name;
                }

            if($model->upload($model->imageFiles)){
                return;
            }
            
            $files = array();//получаем список загруженных файлов
            $db = new Connection(['dsn' => 'sqlite:f:/php_interpreter/sqlite/test.db']);

            $files[] = $db->createCommand('SELECT * FROM files')->queryAll();
            
            return $this->render('entry-confirm', ['model' => $model, 'files' => $files]);

        }else {
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionUpload(){
        $model = new UploadForm();

        if(Yii::$app->request->isPost){
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if($model->upload()){

                return;
            }
        }

        return $this->render('upload', ['model']);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
