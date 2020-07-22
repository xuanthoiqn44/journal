<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/13/2018
 * Time: 9:37 PM
 */

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SampleController extends Controller
{
    /*public  function beforeAction($action)
    {
        $_uri = false;
        if (Yii::$app->urlManager->showScriptName == false){
            if (strpos(Yii::$app->request->url, '/index.php') !== false){
                $_uri = str_replace("/index.php", "", Yii::$app->request->requestUri);
            }
            if (Yii::$app->controller->action->id == 'index'){
                if (!$_uri) {
                    if (strpos(Yii::$app->request->url, "/index") !== false){
                        $_uri = str_replace("/index", "", Yii::$app->request->url);
                    }
                } else {
                    if (strpos($_uri, "/index") !== false){
                        $_uri = str_replace("/index", "", $_uri);
                    }
                }
            }
        }
        if ($_uri !== false){
            $this->redirect($_uri);
        }
        return parent::beforeAction($action);
    }*/
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
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof \yii\web\NotFoundHttpException) {
            // all non existing controllers+actions will end up here
            return $this->render('pnf'); // page not found
        } else {
            return $this->render('error', ['exception' => $exception]);
        }
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
}