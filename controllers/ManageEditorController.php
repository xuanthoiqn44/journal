<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 25/12/2018
 * Time: 21:53
 */

namespace app\controllers;


use app\models\AdminLoginForm;
use app\models\AllPostCompletedSearch;
use app\models\AllPostSearch;
use app\models\AllStatisticSalaryPostSearch;
use app\models\Editor;
use app\models\EditorLoginForm;
use app\models\EditorSearchAdmin;
use app\models\FeedbackSearchAdmin;
use app\models\GetFile;
use app\models\Post;
use app\models\RegisterForm;
use app\models\RequestEditorSearchAdmin;
use app\models\SendMail;
use app\models\UploadFile;
use app\models\User;
use app\models\UserProfile;
use app\models\UserSearchAdmin;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class ManageEditorController extends Controller
{
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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                    ],

                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            //return Yii::$app->user->identity->getRole() === 3 && (Editor::findOne(['Id_User'=>Yii::$app->user->identity->getId()]))->Status_Active === 1;
                            return Yii::$app->user->identity->getIsEditor();
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],

                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['manage-editor/login']);
                },
            ],
        ];

        /*return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['admin/login']);
                },
            ],
        ];*/
    }

    public function actionError()
    {
        //$this->layout = 'admin';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof \yii\web\NotFoundHttpException) {
            // all non existing controllers+actions will end up here
            return $this->render('pnf'); // page not found
        } else {
            return $this->render('admin/error', ['exception' => $exception]);
        }
    }
    public function actionFile($file = null,$type = null)
    {
        if (Yii::$app->user->identity->getIsEditor()) {
            $getfile = new GetFile();
            if (!$getfile->GetFile($file,$type)) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }else
        {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    public function actionManagePost($id =null)
    {
        $this->layout = 'editor';
        if ($id!= null)
        {
            $upload_post = new UploadFile();
            if ($upload_post->load(Yii::$app->request->post()))
            {
                $upload_post->upload_file_editor_completed = UploadedFile::getInstance($upload_post, 'upload_file_editor_completed');
                if( $upload_post->validate()&&$upload_post->UploadPost_Editor_Completed($id))
                {
                    $sendmail = new SendMail();
                    $sendmail->SendMail((Post::findOne(['id'=>$id]))->Id_Author,'sendmail-completed-post-html','sendmail-completed-post-text','Your order completed.');
                    Yii::$app->session->setFlash('success', 'Bài viết đã được upload thành công.');
                    return $this->redirect(['manage-editor/manage-post']);
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Lỗi trong quá trình upload bài viết vui lòng thử lại.');
                    return $this->redirect(['manage-editor/manage-post']);
                }
            }
            else {
                $order_post = Post::find()->with(['editors.user'])->where(['Id_Editor' => Yii::$app->user->identity->getID_EDITOR(), 'id' => $id])->limit(1)->one();
                if ($order_post != null) {
                    return $this->render('post', ['order_post' => $order_post]);
                } else {
                    Yii::$app->session->setFlash('error', 'Bài viết không tồn tại.');
                    return $this->redirect(['manage-editor/manage-post']);
                }
            }
        }
        else{
            $query = Post::find()->where(['Id_Editor'=>Yii::$app->user->identity->getID_EDITOR()]);
            $pagination_writers = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' =>$query->count(),
            ]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => $pagination_writers,
            ]);
            $dataProvider->sort = ['defaultOrder' => ['Status' => SORT_DESC]];
            return $this->render('manage-post', ['dataProvider' => $dataProvider]);
        }

    }
    public function actionAccept($token)
    {
        if ($token != null)
        {
            $post = Post::find()->where(['Order_Code'=>$token,'Id_Editor'=>Yii::$app->user->identity->getID_EDITOR(),'Status'=>'Waiting editor'])
                ->with(['editors'])
                ->limit(1)
                ->one();
            if ($post != null)
            {
                $post->Status = 'Process';
                $post->editors->Order_Process +=1;
                $post->Date_Edit =  date('Y-m-d H:i:s');
                if ($post->save() && $post->editors->save())
                {
                    $sendmail = new SendMail();
                    $sendmail->SendMail($post->Id_Author,'sendmail-request-editor-completed-html','sendmail-request-editor-completed-text','Đã có editor nhận bài viết của bạn');
                    Yii::$app->session->setFlash('success', 'Bài viết đã được nhận thành công bạn có thể làm ngay bây giờ.');
                    return $this->redirect(['manage-editor/request-post']);
                }
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Bài viết đã được người khác nhận hoặc không tồn tại.');
                return $this->redirect(['manage-editor/request-post']);
            }
        }
    }
    public function actionRequestPost()
    {
        $this->layout = 'editor';
        $query = Post::find()->where(['Status'=>'Waiting editor','Id_Editor'=>Yii::$app->user->identity->getID_EDITOR()]);
        $pagination_writers = new Pagination([
            'defaultPageSize' => 4,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination_writers,
        ]);
        return $this->render('request-post', ['dataProvider' => $dataProvider]);
    }
    public function actionProfile()
    {
        $this->layout = 'editor';
        $model = new UserProfile();
        $model->getUserEditor(Yii::$app->user->identity->getId());
        $model_upload = new UploadFile();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveData())
        {
            Yii::$app->session->setFlash('success', 'Update profile success.');
            return $this->refresh();
        }
        return $this->render('info-editor',['model'=>$model,'model_upload'=>$model_upload]);
    }
    public function actionIndex()
    {
        $this->layout = 'editor';
        return $this->redirect(['manage-editor/profile']);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['manage-editor/']);
    }
    public function actionLogin()
    {
        $this->layout = 'login';
        $model = new EditorLoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
        else if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->getRole() == 3) {
                $this->layout = 'editor';
                return $this->redirect(['manage-editor/']);
            } else {
                $model->password = '';
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
        else {
            $model->password = '';
            /*return $this->render('login', [
                'model' => $model,
            ]);*/
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function renderPartial($view, $params = [])
    {
        //return parent::renderPartial($view, $params); // TODO: Change the autogenerated stub

        $ctrol = Yii::$app->controller->action;
        //return $this->getView()->render($view, $params, $this,['active'=>$ctrol->id]);
        return $this->getView()->render($view,['active'=>$ctrol->id],$this);
    }

}