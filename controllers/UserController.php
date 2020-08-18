<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/24/2018
 * Time: 3:03 PM
 */

namespace app\controllers;

use app\models\Editor;
use app\models\GetFile;
use app\models\Post;
use app\models\RatingForm;
use app\models\ReWriteForm;
use app\models\TmpPost;
use app\models\UploadFile;
use app\models\User;
use yii;
use yii\web\Controller;
use app\models\UserProfile;
use app\models\Feedback;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;

class UserController extends Controller
{

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
                            return !Yii::$app->user->isGuest;
                        },
                    ],

                ],

                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
        ];


    }
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
        $this->layout = 'user';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof \yii\web\NotFoundHttpException) {
            // all non existing controllers+actions will end up here
            return $this->render('pnf'); // page not found
        } else {
            return $this->render('error', ['exception' => $exception]);
        }
    }
    public function actionFile($file = null,$type = null)
    {
        if (!Yii::$app->user->isGuest) {
            if ($type == 'post' && Post::findOne(['File_Name'=>$file,'Id_Author'=>Yii::$app->user->identity->getId()]))
            {
                $getfile = new GetFile();
                if (!$getfile->GetFile($file, $type)) {
                    return $this->render('error');
                }
            }
            else if ($type == 'editor_completed' && Post::findOne(['File_Editor_Completed'=>$file,'Id_Author'=>Yii::$app->user->identity->getId()]))
            {
                $getfile = new GetFile();
                if (!$getfile->GetFile($file, $type)) {
                    return $this->render('error');
                }
            }

        }else
        {
            return $this->render('error');
        }
    }
    public function actionUploadFile()
    {
        $model = new UploadFile();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->upload_file = UploadedFile::getInstance($model, 'upload_file');
            $model->upload_file_editor = UploadedFile::getInstance($model, 'upload_file_editor');
            if ($model->upload_file != null)
            {
                if($model->validate() && $model->UploadFile())
                {
                    Yii::$app->session->setFlash('success', 'Update image success.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Allow upload file (png,jpg,jpeg).');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }

        }
        else
        {
            return $this->render('/site/error');
        }
    }

    public function actionProfile()
    {
        $this->layout = "user";
        $is_profile = true;
        $model = new UserProfile();
            $model->getUser(yii::$app->user->identity->getId());
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveData())
            {
                Yii::$app->session->setFlash('success', 'Update profile success.');
                return $this->refresh();
            }
            return $this->render('UserProfile' ,['model'=>$model, 'is_profile' => $is_profile]);
    }
    public function actionCompleted()
    {
        if ($verifiedData = Yii::$app->NLGateway->verifyRequestPurchaseSuccess()) {
            if ($verifiedData->transaction_status == '00') {
                // processing update database...
                //get order from table tmp order
                $get_order_tmp = TmpPost::findOne(['Token_Order'=>$verifiedData->token]);
                $insert_order = new ReWriteForm();
                if($insert_order->SavePost($get_order_tmp))
                {
                    $get_order_tmp->delete();
                    return $this->render('completed', [
                        //'message' => 'success'
                    ]);
                }
                else
                {
                    $message = 'Có lỗi trong quá trình xử lý quý khách vui lòng lưu lại mã hóa đơn:'.$get_order_tmp->Id.' và liên hệ chăm sóc khách hàng để được hỗ trợ!';
                    return $this->render('error', [
                        'message' => $message
                    ]);
                }


            } else {
                return $this->render('order', [
                    //'message' => 'order not found'
                ]);
            }
        }
        else{
            return $this->render('error', [
                //'message' => 'order not found'
                'message' => ''
            ]);
        }
    }
    public function actionRewrite($token = null,$type=null)
    {
        //$this->layout = 'main';
        if ($token != null && $type == 'payment')
        {
            $post = TmpPost::findOne(['Id_Author'=>Yii::$app->getUser()->getId(),'Token_Rewrite'=>$token]);
            if ($post)
            {
                $user = User::findIdentity(yii::$app->user->identity->getId());
                if(isset($_POST['nganluong']))
                {
                    $Order_Code = microtime();
                    $post->Order_Code = $Order_Code;
                    $post->Payment_Method = "NGAN LUONG";
                    $result = Yii::$app->NLGateway->purchase([
                        'payment_method' => 'NL',
                        'bank_code' => 'NL',
                        'time_limit'=>10,
                        'order_description' => $post->Topic,
                        'buyer_fullname' => $user->getUsername(),
                        'buyer_email' => $user->getEmail(),
                        'buyer_mobile' => Yii::$app->user->identity->getPhoneNumber(),
                        'total_amount' => $post->Price,
                        //'total_amount' =>5000,
                        'order_code' => $Order_Code,
                        'cur_code' => 'usd',
                        'cancel_url' => Yii::$app->urlManager->createAbsoluteUrl('my-order'),
                        'return_url' => Yii::$app->urlManager->createAbsoluteUrl(['completed'])
                    ]);
                    if ($result->isOk) {
                        $post->Token_Order = $result->token;
                        if($post->save())
                        {
                            Yii::$app->response->redirect($result->checkout_url);
                        }
                        else{
                            Yii::$app->session->setFlash('error', 'Error');
                            return $this->render('rewrite-payment',['post'=>$post]);
                        }

                        /*Yii::$app->queue->delay(12*60)->push(new Verify_Order([
                            //'function'=>'verify_order',
                            'token'=>$result->token,
                        ]));*/
                    } else {

                        Yii::$app->session->setFlash('error', $result->description);
                        return $this->render('rewrite-payment',['post'=>$post]);
                    }
                }
                elseif (isset($_POST['atm-online']))
                {
                    $bank_code = @$_POST['bankcode'];
                    if ($bank_code != '') {
                        $Order_Code = microtime();
                        $post->Order_Code = $Order_Code;
                        $post->Payment_Method = "ATM ONLINE";
                        $result = Yii::$app->NLGateway->purchase([
                            'payment_method' => 'ATM_ONLINE',
                            'bank_code' => $bank_code,
                            'buyer_mobile' => Yii::$app->user->identity->getPhoneNumber(),
                            'order_description' => $post->Topic,
                            'buyer_fullname' => $user->getUsername(),
                            'time_limit' => 10,
                            'buyer_email' => $user->getEmail(),
                            'total_amount' => $post->Price,
                            //'total_amount' =>5000,
                            'order_code' => $Order_Code,
                            'cur_code' => 'usd',
                            'cancel_url' => Yii::$app->urlManager->createAbsoluteUrl('my-order'),
                            'return_url' => Yii::$app->urlManager->createAbsoluteUrl(['completed'])
                        ]);
                        if ($result->isOk) {
                            $post->Token_Order = $result->token;
                            if ($post->save()) {
                                Yii::$app->response->redirect($result->checkout_url);
                            } else {
                                Yii::$app->session->setFlash('error', 'Error');
                                return $this->render('rewrite-payment', ['post' => $post]);
                            }

                        } else {
                            Yii::$app->session->setFlash('error', $result->description);
                            return $this->render('rewrite-payment', ['post' => $post]);
                        }
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', 'Please select your credit card');
                        return $this->render('rewrite-payment', ['post' => $post]);
                    }
                }
                return $this->render('rewrite-payment',['post'=>$post]);
            }
            else{
                return $this->render('error');
            }
        }
        else{
            return $this->render('/site/error');
        }
    }
    public function actionMyOrder($id = null)
    {
        $this->layout = "user";
        if ($id != null)
        {
            $post = Post::findOne(['Id_Author'=>Yii::$app->getUser()->getId(),'id'=>$id]);
            if ($post)
            {
                $model = new RatingForm();
                $model_rewrite = new \app\models\ReWriteForm();
                if ($model->load(Yii::$app->request->post())){
                    if ($model->rating == null)
                    {
                        Yii::$app->session->setFlash('error', 'Please select rating.');
                        return $this->refresh();
                    }
                    $feedback = new Feedback();
                    $feedback->Id_Order = $post->id;
                    $feedback->Rate = $model->rating;
                    $feedback->Date_Time = date('Y-m-d H:i:s');
                    $editor = Editor::find()->where(['id'=>$post->Id_Editor])->limit(1)->one();
                    $score = $editor->Score + $model->rating;
                    $editor->Score = $score;
                    $editor->Rating = $score / $editor->Completed_order;
                    if ($feedback->save() && $editor->save())
                    {
                        Yii::$app->session->setFlash('success', 'Your rating success.');
                        return $this->refresh();
                    }
                }
                elseif ($model_rewrite->load(Yii::$app->request->post()))
                {
                    $model_rewrite->upload_file_rewrite = UploadedFile::getInstance($model_rewrite, 'upload_file_rewrite');
                    if ($model_rewrite->validate() && $model_rewrite->SaveToTmpPost($post))
                    {
                            //return $this->render('rewrite-payment',['post'=>$post,'model_rewrite'=>$model_rewrite]);
                            return $this->redirect(['rewrite','token'=>$model_rewrite->Token_Rewrite,'type'=>'payment']);
                    }
                }
                return $this->render('order-details',['post'=>$post,'model'=>$model,'model_rewrite'=>$model_rewrite]);
            }
            else{
                return $this->render('error');
            }

        }
        else {
            //table active
            $query_tb = Post::find()
                ->where(['Id_Author' => Yii::$app->getUser()->getId()])
                ->orderBy(['Date_Create' => SORT_DESC]);
            /*$count_active = Post::FindActivePostByUserIDCreate(Yii::$app->getUser()->getId());
            $count_completed = Post::FindCompletedPostByUserIDCreate(Yii::$app->getUser()->getId());*/
            $pagination_tb = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query_tb->count(),
            ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query_tb,
                'pagination' => $pagination_tb,
            ]);
            /*$order = $query_tb_active->where(['Id_Author'=>Yii::$app->getUser()->getId()])
              ->offset($pagination_tb_active->offset)
               ->limit($pagination_tb_active->limit)
                ->orderBy(['Date_Create'=>SORT_DESC])
                ->all();*/


            return $this->render('my-order', [
                'dataProvider' => $dataProvider,
                /*'pagination_tb_active' => $pagination_tb_active,
                'count_active'=>count($count_active),
                'count_completed'=>count($count_completed),*/
            ]);
        }
    }

    public function actionFeedbacks()
    {
        $this->layout = "user";

            $query_tb_feedback = Post::find()
                ->with(['feedback'])
                ->where(['Id_Author'=>Yii::$app->getUser()->getId()])
                ->innerJoinWith('feedback',true);
            $pagination_feedback = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' =>$query_tb_feedback->count(),
            ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query_tb_feedback,
                'pagination' => $pagination_feedback,
            ]);
            return $this->render('feedbacks',['dataProvider'=>$dataProvider]);

    }
    public function renderPartial($view, $params = [])
    {
        //return parent::renderPartial($view, $params); // TODO: Change the autogenerated stub
        $ctrol = Yii::$app->controller->action;
        if ($view == '_MenuUser')
        {
            $model = new UploadFile();
            return $this->getView()->render($view,['active'=>$ctrol->id,'model'=>$model],$this);
        }
        //return $this->getView()->render($view, $params, $this,['active'=>$ctrol->id]);
        return $this->getView()->render($view,['active'=>$ctrol->id],$this);
    }
}