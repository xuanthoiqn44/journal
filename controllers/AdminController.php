<?php
/**
 * Created by PhpStorm.
 * User: xuanthoiqn44
 * Date: 25/12/2018
 * Time: 21:53
 */

namespace app\controllers;


use app\models\AddEditor;
use app\models\AdminLoginForm;
use app\models\AllPostCompletedSearch;
use app\models\AllPostSearch;
use app\models\AllStatisticSalaryPostSearch;
use app\models\Editor;
use app\models\EditorSearchAdmin;
use app\models\Feedback;
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
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;


class AdminController extends Controller
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
                            //return Yii::$app->user->identity->getRole() === 1;
                            return Yii::$app->user->identity->getIsAdmin();
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],

                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['admin/login']);
                },
            ],
        ];


    }

    public function actionError()
    {
        $this->layout = 'admin';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof \yii\web\NotFoundHttpException) {
            // all non existing controllers+actions will end up here
            return $this->render('pnf'); // page not found
        } else {
            return $this->render('admin/error', ['exception' => $exception]);
        }
    }
    public function actionHandle($type=null,$action=null)
    {
        switch ($type)
        {
            case 'user':

                if ($action == 'delete') {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['manage-user']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = User::findOne((int)$id);
                                if ($model) {
                                    $model->delete();
                                    $count++;
                                } else {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Deleted " . $count . " user");
                            return $this->redirect(['manage-user']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose user delete.");
                            return $this->redirect(['manage-user']);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', "Please choose user delete.");
                        return $this->redirect(['manage-user']);
                    }
                }
                elseif ($action == 'active')
                {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['manage-user']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = User::findOne((int)$id);
                                if ($model)
                                {
                                    $model->Status = 1;
                                    $model->save();
                                    $count++;
                                }
                                else
                                {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Active " . $count . " user");
                            return $this->redirect(['manage-user']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose user active.");
                            return $this->redirect(['manage-user']);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', "Please choose user active.");
                        return $this->redirect(['manage-user']);
                    }
                }
                elseif ($action == 'block')
                {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['manage-user']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = User::findOne((int)$id);
                                if ($model)
                                {
                                    $model->Status = 0;
                                    $model->save();
                                    $count++;
                                }
                                else
                                {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Block " . $count . " user");
                            return $this->redirect(['manage-user']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose user block.");
                            return $this->redirect(['manage-user']);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', "Please choose user block.");
                        return $this->redirect(['manage-user']);
                    }
                }
            case 'editor':

                if ($action == 'delete') {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['manage-user']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = Editor::findOne((int)$id);
                                if ($model)
                                {
                                    $model->delete();
                                    $count++;
                                }
                                else
                                {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Deleted " . $count . " Editor");
                            return $this->redirect(['editor']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose editor delete.");
                            return $this->redirect(['editor']);
                        }
                    }else
                    {
                        Yii::$app->session->setFlash('error', "Please choose editor delete.");
                        return $this->redirect(['editor']);
                    }
                }
                if ($action == 'active') {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['editor']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = Editor::findOne((int)$id);
                                if ($model)
                                {
                                    $model->Status_Active = 2;
                                    $model->save();
                                    $count++;
                                }
                                else
                                {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Deleted " . $count . " Editor");
                            return $this->redirect(['editor']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose editor active.");
                            return $this->redirect(['editor']);
                        }
                    }else
                    {
                        Yii::$app->session->setFlash('error', "Please choose editor active.");
                        return $this->redirect(['editor']);
                    }
                }
                if ($action == 'block') {
                    if (isset($_POST['listkey'])) {
                        $keys = $_POST['listkey'];
                        if (!is_array($keys)) {

                            Yii::$app->session->setFlash('error', "Error");
                            return $this->redirect(['editor']);
                        }
                        $count = 0;
                        if ($keys != null) {
                            foreach ($keys as $id) {
                                $model = Editor::findOne((int)$id);
                                if ($model)
                                {
                                    $model->Status_Active = 1;
                                    $model->save();
                                    $count++;
                                }
                                else
                                {
                                    return;
                                }

                            }
                            Yii::$app->session->setFlash('success', "Block " . $count . " Editor");
                            return $this->redirect(['editor']);
                        } else {
                            Yii::$app->session->setFlash('error', "Please choose editor block.");
                            return $this->redirect(['editor']);
                        }
                    }else
                    {
                        Yii::$app->session->setFlash('error', "Please choose editor block.");
                        return $this->redirect(['editor']);
                    }
                }
            default:
            return $this->redirect(['error']);
        }

    }
    public function actionIndex()
    {
        try {
            $this->layout = 'admin';
            $data['user_total'] = User::find()->count();
            $data['post_total'] = Post::find()->count();
            $data['editor_total'] = Editor::find()->count();
            $data['feedback_total'] = Feedback::find()->count();
            return $this->render('index', $data);
        }catch(\Exception $e) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => $e];
        }
    }
    public function actionDetailSalaryPost($id)
    {
        $this->layout = 'admin';
        if ($id!= null)
        {
            $order_post = Post::find()
                ->where(['id'=>$id,'Status'=>'Completed','Status_Salary_Editor'=>'Yes'])
                ->with(['editors.user','editors.skillWriter','feedback'])
                ->limit(1)
                ->one();
            return $order_post?$this->render('salary-post',['order_post'=>$order_post]):$this->render('error');
        }
    }
    public function actionSalaryEditor($id)
    {
        $this->layout = 'admin';
        if ($id!= null)
        {
            $order_post = Post::find()
                ->where(['id'=>$id,'Status'=>'Completed','Status_Salary_Editor'=>'No'])
                ->with(['editors.user','editors.skillWriter','feedback'])
                ->limit(1)
                ->one();
            if (Yii::$app->request->post())
            {
                $editor = Editor::findOne(['id'=>$order_post->Id_Editor]);
                if ($editor)
                {
                    $order_post->Status_Salary_Editor = 'Yes';
                    $order_post->Date_Salary_Editor = date('Y-m-d H:i:s');
                    //$Completed_order = $editor->Completed_order + 1;
                    //$editor->Completed_order = $Completed_order;
                    $rating = $order_post->feedback?$order_post->feedback->Rate:0;
                    $Score = $editor->Score + $rating;
                    $editor->Score = $Score;
                    $editor->Rating = $Score / $editor->Completed_order;
                    $order_post->Money_Editor = $order_post->feedback?($order_post->Price * (70 - (5*(5 - $order_post->feedback->Rate))))/100:($order_post->Price * 60)/100;
                    $editor->Salary += $order_post->feedback?($order_post->Price * (70 - (5*(5 - $order_post->feedback->Rate))))/100:($order_post->Price * 60)/100;
                    if($order_post->save() && $editor->save())
                    {
                        Yii::$app->session->setFlash('success', 'Success to salary.');
                        return $this->redirect(['admin/completed-post']);
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', 'Loi trong qua trinh xu ly.');
                        return $this->redirect(['admin/completed-post']);
                    }
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Loi trong qua trinh xu ly.');
                    return $this->redirect(['admin/completed-post']);
                }
            }

            return $order_post?$this->render('salary-post',['order_post'=>$order_post]):$this->render('error');
        }
    }
    public function actionStatisticSalaryPost()
    {
        $this->layout = 'admin';
        $searchModel = new AllStatisticSalaryPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('statistic-salary-post', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
    public function actionCompletedPost()
    {
        $this->layout = 'admin';
        $searchModel = new AllPostCompletedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('completed-post', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
    public function actionFeedback()
    {
        $this->layout = 'admin';
        $searchModel = new FeedbackSearchAdmin();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('feedback', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
    public function actionAdminProfile()
    {
        $this->layout = 'admin';
        $model = new UserProfile();
        $model->getUser(Yii::$app->user->identity->getId());
        $model_upload = new UploadFile();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveData())
        {
            Yii::$app->session->setFlash('success', 'Update profile success.');
            return $this->refresh();
        }
        return $this->render('info-admin',['model'=>$model,'model_upload'=>$model_upload]);
    }
    public function actionAddUser()
    {
        //if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getIsAdmin()) {
            $this->layout = 'admin';
            $model = new RegisterForm();
            if ($model->load(Yii::$app->request->post()) && $model->Register()&& $model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Add user success.');
                return $this->refresh();
            }
            return $this->render('add-user',['model'=>$model]);
        /*}else
        {
            return $this->render('error');
        }*/
    }
    public function actionFile($file = null,$type = null)
    {
        if (Yii::$app->user->identity->getIsAdmin()) {
            //Yii::$app->request->getQueryParams(['file','type']);
            $getfile = new GetFile();
            if (!$getfile->GetFile($file,$type)) {
                return $this->render('error');
            }
        }else
        {
            return $this->render('error');
        }
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['admin/']);
    }
    public function actionEditor($id=null)
    {
            $this->layout = 'admin';
            $searchModel = new RequestEditorSearchAdmin();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



            if ($id != null)
            {
                $model = new UploadFile();
                //$model->id_editor = $id;
                if (Yii::$app->request->post('UploadFile'))
                {
                    $model->upload_file_editor = UploadedFile::getInstance($model, 'upload_file_editor');
                    if($model->validate() && $model->UploadFile_Editor($id))
                    {
                        Yii::$app->session->setFlash('success', 'Update file success.');
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', 'Allow upload file (doc,docx).');
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                }
                if (Yii::$app->request->post())
                {
                    $editor = Editor::findOne(['id'=>$id]);
                    $editor->Status_Active = 2;
                    if ($editor->save())
                    {
                        $sendmail = new SendMail();
                        Yii::$app->session->setFlash('success', "action completed.");
                        $sendmail->SendMail($id,'success-request-editor-html','success-request-editor-text','Request to Editor success');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', "error.");
                    }
                }
                $info_editor = Editor::find()
                    ->where(['id'=>$id])
                    ->with('user')
                    ->limit(1)
                    ->one();
                return $info_editor?$this->render('info-editor',['info_editor'=>$info_editor,'model'=>$model]):$this->render('error');
            }else
            {

                return $this->render('request-editor', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
                //return $this->render('request-editor');
                //return $this->render('request-editor',['dataProvider'=>$dataProvider]);

            }

    }
    public function actionAllPost($id = null)
    {
                $this->layout = 'admin';
                $searchModel = new AllPostSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if ($id != null)
                {
                    $searchModel = new EditorSearchAdmin();

                    //$order_post = Post::findOne(['id'=>$id]);
                    $order_post = Post::find()
                        ->where(['id'=>$id])
                        ->with(['editors.user','editors.skillWriter'])
                        ->limit(1)
                        ->one();
                    $dataProvider = $searchModel->search();
                    $select = Yii::$app->request->post('radioButtonSelection');
                    //kiem tra check editor
                    if ($select!=null)
                    {
                        //insert id editor for post
                        $post = Post::findOne(['id'=>$id]);
                        $post->Id_Editor = $select;
                        $post->Status = "Waiting editor";
                        $post->Status_Sort = '1';
                        if($post->save()){
                            $sendmail = new SendMail();
                            $sendmail->SendMail($select,'sendmail-editor-html','sendmail-editor-text','Bạn có bài viết cần chỉnh sửa');
                            Yii::$app->session->setFlash('success', "action completed.");
                            //return $order_post?$this->render('post',['order_post'=>$order_post,'dataProvider'=>$dataProvider]):$this->render('error');
                            return $this->redirect(['admin/all-post']);
                        }
                    }
                    return $order_post?$this->render('post',['order_post'=>$order_post,'dataProvider'=>$dataProvider]):$this->render('error');
                }
                else {

                    return $this->render('all-post', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
                    //return $this->render('all-post', ['allorder' => $allorder, 'neworder' => $neworder, 'pagination_tb_active' => $pagination_tb_active,]);
                }

    }

    public function actionAddEditor($id = null)
    {
        $this->layout = 'admin';
        if ($id!= null && User::findIdentity($id))
        {
            $model_add_editor = new AddEditor();

            if ($model_add_editor->load(Yii::$app->request->post()))
            {
                $model_add_editor->upload_file_editor = UploadedFile::getInstance($model_add_editor, 'upload_file_editor');
                if ($model_add_editor->validate() && $model_add_editor->UploadFile_Editor($id))
                {
                    Yii::$app->session->setFlash('success', 'Add Editor success.');
                    return $this->refresh();
                }
                else{
                    return $this->render('add-editor',['model_add_editor'=>$model_add_editor]);
                }

            }
            return $this->render('add-editor',['model_add_editor'=>$model_add_editor]);
        }
        else {

            return $this->render('error');
        }
    }
    public function actionManageUser($id = null)
    {

                $this->layout = 'admin';
                if ($id!= null)
                {
                    $model = new UserProfile();
                    $model_add_editor = new AddEditor();
                    $model->getUser($id);
                    $user = User::find()->with(['editors'])->where(['id'=>$id])->limit(1)->one();
                    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveData())
                    {
                        Yii::$app->session->setFlash('success', 'Update profile success.');
                        return $this->refresh();
                    }
                    return $this->render('info-user',['model'=>$model,'model_add_editor'=>$model_add_editor,'user'=>$user]);
                }
                else {
                    $searchModel = new UserSearchAdmin();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return $this->render('manage-user', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
                }
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        $model = new AdminLoginForm();
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
            if (Yii::$app->user->identity->getIsAdmin()) {
                $this->layout = 'user';
                return $this->redirect(['admin/index']);
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