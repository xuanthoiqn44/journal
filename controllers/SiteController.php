<?php

namespace app\controllers;
use app\commands\Verify_Order;
use app\models\Feedback;
use app\models\Prices;

use app\models\SaveTmpPost;
use app\models\SendMail;
use app\models\ServicePrice;
use app\models\TmpPost;
use app\models\UploadFile;
use app\models\User;
use app\models\WritersSearch;
use Faker\Provider\File;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\web\Request;
use app\models\Editor;
use app\models\OrderPost;
use app\models\RegisterForm;
use yii\widgets\ActiveForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Post;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Inflector;


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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        } else if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
            $model->password = '';
            /*return $this->render('login', [
                'model' => $model,
            ]);*/
            return $this->renderAjax('_login', [
                'model' => $model,
            ]);
        }
        else{
            $this->layout = "main";
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    //Yii::$app->response->format = Response::FORMAT_JSON;
                    //return ActiveForm::validate($model);
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                }
            }
            $model->password = '';
            /*return $this->render('login', [
                'model' => $model,
            ]);*/
            return $this->render('login', [
                'model' => $model,
            ]);
        }

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
     *
     * public function actionContact()
     * {
     * $model = new ContactForm();
     * if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
     * Yii::$app->session->setFlash('contactFormSubmitted');
     *
     * return $this->refresh();
     * }
     * return $this->render('contact', [
     * 'model' => $model,
     * ]);
     * }*/

    /**
     * Displays about page.
     *
     * @return string
     *
     * public function actionAbout()
     * {
     * return $this->render('about');
     * }*/
    /*public function actionRegister()
    {
        return $this->render('register');
    }*/
    public function actionWritingService()
    {
        return $this->render('writing-services');
    }

    public function actionNganluong_c5dc58553235e68a3bcff636be2d2b24()
    {
        return $this->render('nganluong_c5dc58553235e68a3bcff636be2d2b24.html');
    }


    public function actionOrder($service_id = null, $paper_id = null, $subject_id = null, $urgency_type_id = null, $writer_id = null, $currency = null)
    {
        $session = Yii::$app->session;
        $session->remove('total_prices');
        Yii::$app->request->getQueryParam('service_id');
        Yii::$app->request->getQueryParam('paper_id');
        Yii::$app->request->getQueryParam('urgency_type_id');
        Yii::$app->request->getQueryParam('subject_id');
        Yii::$app->request->getQueryParam('writer_id');
        Yii::$app->request->getQueryParam('currency');
        $model = new OrderPost();
        $model_register = new RegisterForm();
        $model->type_of_service = '1';
        $model->type_of_paper = '7';
        $model->subject_area = '13';
        $model->Type_of_currency = '30';
        $model->urgency = '17';
        $model->number_of_page = '1';
        $model->customer_service = '23';
        $model->writer_level = '26';
        $model->method = 'ngan_luong';
        $bank_code = '';
        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                $model->upload_file = UploadedFile::getInstance($model, 'upload_file');
                if ($model->validate()) {
                    $read_file = new UploadFile();
                    $model->number_of_page = $read_file->PageCount_DOCX($model->upload_file);
                    $model->Process_Price_Oder();
                    $session['total_prices'] = $model->total_prices;
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    if (is_numeric($model->total_prices)) {
                        return $response = [
                            'data' => [$model->total_prices, $model->number_of_page[0]],
                            'success' => 'true'
                        ];
                    } else {
                        return $response = [
                            'data' => 'error',
                            'error' => 'true'
                        ];
                    }
                } else {
                    //$this->addError($model->getErrors());
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        }else if ($model_register->load(Yii::$app->request->post())){
            if ($user = $model_register->Register() && $model_register->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Please check your email for active account.');
                //if (Yii::$app->getUser()->login($user))
                //{
                 //   return $this->goHome();
                //}
                return $this->refresh();
            }
            else{
                //Yii::$app->response->format = Response::FORMAT_JSON;
                //return ActiveForm::validate($model);
                return $this->render('order', [
                    'model' => $model,'model_register'=>$model_register]);
            }
        }
        else if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', 'Vui lòng đăng nhập trước khi sử dụng dịch vụ.');
                return $this->render('order', [
                    'model' => $model,'model_register'=>$model_register]);
            } else {
                $bank_code = @$_POST['bankcode'];
                $model->upload_file = \yii\web\UploadedFile::getInstance($model, 'upload_file');

                if ($model->validate()) {
                    if ($session['total_prices'] == "") {
                        $read_file = new UploadFile();
                        $model->number_of_page = $read_file->PageCount_DOCX($model->upload_file);
                        $model->Process_Price_Oder();
                        $session['total_prices'] = $model->total_prices;
                    }
                    $user = User::findIdentity(yii::$app->user->identity->getId());
                    if ($model->method == "ngan_hang_noi_dia") {
                        if ($bank_code != "") {
                            # code...
                            $model->order_code = microtime();
                            $model->payment_method = "ATM ONLINE";
                            $result = Yii::$app->NLGateway->purchase([
                                'payment_method' => 'ATM_ONLINE',
                                'bank_code' => $bank_code,
                                'buyer_mobile' => Yii::$app->user->identity->getPhoneNumber(),
                                'order_description' => $model->topic,
                                'buyer_fullname' => $user->getUsername(),
                                'time_limit'=>10,
                                'buyer_email' => $user->getEmail(),
                                'total_amount' => $model->total_prices,
                                //'total_amount' =>5000,
                                'order_code' => $model->order_code,
                                'cur_code' => $model->id_type_of_currency,
                                'cancel_url' => Yii::$app->urlManager->createAbsoluteUrl('order'),
                                'return_url' => Yii::$app->urlManager->createAbsoluteUrl('completed')
                            ]);
                            if ($result->isOk) {
                                $model->token_order = $result->token;
                                $model->SaveTmpPost();
                                $get_order_tmp = TmpPost::findOne(['Token_Order'=>$model->token_order]);
                                $insert_order = new OrderPost();
                                $insert_order->SavePost($get_order_tmp->Topic,$get_order_tmp->Id_Author,$get_order_tmp->Type_of_services,$get_order_tmp->Type_of_paper,$get_order_tmp->Subject_area,$get_order_tmp->Type_of_currency,$get_order_tmp->PageNumbers,$get_order_tmp->File_Name,$get_order_tmp->Date_Create,$get_order_tmp->Deadline,$get_order_tmp->Id_Editor,$get_order_tmp->Price,$get_order_tmp->Status,$get_order_tmp->Token_Order,$get_order_tmp->Order_Code,$get_order_tmp->Payment_Method,$get_order_tmp->Decription,$get_order_tmp->Day,$get_order_tmp->Writer_Level,$get_order_tmp->Customer_Service);
                                //$model->SavePost($model->topic,yii::$app->user->identity->getId(),$model->type_of_service,$model->type_of_paper,$model->subject_area,$model->Type_of_currency,$model->number_of_page,$model->file,date('Y-m-d H:i:s'),'2018-12-20',$model->id_writer,$model->total_prices,'New','asefasefasefasefasefasef','61253dfagsyuhefjk',$model->payment_method);
                                Yii::$app->response->redirect($result->checkout_url);
                                Yii::$app->queue->delay(12*60)->push(new Verify_Order([
                                    //'function'=>'verify_order',
                                    'token'=>$result->token,
                                ]));
                            } else {
                                Yii::$app->session->setFlash('error', $result->description);
                                return $this->render('order', [
                                    'model' => $model
                                ]);
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Vui lòng chọn phương thức thanh toán.');
                            return $this->render('order', [
                                'model' => $model
                            ]);
                        }

                    } else {
                        $model->order_code = microtime();
                        $model->payment_method = "NGAN LUONG";
                        $result = Yii::$app->NLGateway->purchase([
                            'payment_method' => 'NL',
                            'bank_code' => 'NL',
                            'time_limit'=>10,
                            'order_description' => $model->topic,
                            'buyer_fullname' => $user->getUsername(),
                            'buyer_email' => $user->getEmail(),
                            'buyer_mobile' => Yii::$app->user->identity->getPhoneNumber(),
                            'total_amount' => $model->total_prices,
                            //'total_amount' =>5000,
                            'order_code' => $model->order_code,
                            'cur_code' => $model->id_type_of_currency,
                            'cancel_url' => Yii::$app->urlManager->createAbsoluteUrl('order'),
                            'return_url' => Yii::$app->urlManager->createAbsoluteUrl('completed')
                        ]);
                        if ($result->isOk) {
                            $model->token_order = $result->token;
                            $model->SaveTmpPost();
                            $get_order_tmp = TmpPost::findOne(['Token_Order'=>$model->token_order]);
                            $insert_order = new OrderPost();
                            $insert_order->SavePost($get_order_tmp->Topic,$get_order_tmp->Id_Author,$get_order_tmp->Type_of_services,$get_order_tmp->Type_of_paper,$get_order_tmp->Subject_area,$get_order_tmp->Type_of_currency,$get_order_tmp->PageNumbers,$get_order_tmp->File_Name,$get_order_tmp->Date_Create,$get_order_tmp->Deadline,$get_order_tmp->Id_Editor,$get_order_tmp->Price,$get_order_tmp->Status,$get_order_tmp->Token_Order,$get_order_tmp->Order_Code,$get_order_tmp->Payment_Method,$get_order_tmp->Decription,$get_order_tmp->Day,$get_order_tmp->Writer_Level,$get_order_tmp->Customer_Service);
                            //$model->SavePost($model->topic,yii::$app->user->identity->getId(),$model->type_of_service,$model->type_of_paper,$model->subject_area,'a',$model->number_of_page,$model->file,date('Y-m-d H:i:s'),'2018-12-20',$model->id_writer,'1000000','New','asefasefasefasefasefasef','61253dfagsyuhefjk','NL');
                            Yii::$app->response->redirect($result->checkout_url);
                            Yii::$app->queue->delay(12*60)->push(new Verify_Order([
                                //'function'=>'verify_order',
                                'token'=>$result->token,
                            ]));
                        } else {

                            Yii::$app->session->setFlash('error', $result->description);
                            return $this->render('order', [
                                'model' => $model
                            ]);
                        }
                    }
                } else {
                    return $this->render('order', [
                        'model' => $model
                    ]);
                }
            }

        } else if ($writer_id != null) {
            $model->id_writer = $writer_id;
            return $this->render('order', [
                'model' => $model,'model_register'=>$model_register]);
        } else if ($service_id != null && $paper_id != null && $subject_id != null && $urgency_type_id != null && $currency != null) {
            $model->type_of_service = $service_id;
            $model->type_of_paper = $paper_id;
            $model->subject_area = $subject_id;
            $model->urgency = $urgency_type_id;
            $model->Type_of_currency = $currency;
            return $this->render('order', [
                'model' => $model,'model_register'=>$model_register]);
        } else {
            return $this->render('order', [
                'model' => $model,'model_register'=>$model_register]);
        }


    }

    public function actionProofreading()
    {
        return $this->render('proofreading');
    }

    public function actionMathScience()
    {
        return $this->render('math-science');
    }

    public function actionCopywriting()
    {
        return $this->render('copywriting');
    }

    public function actionRewriting()
    {
        return $this->render('rewriting');
    }

    public function actionEditing()
    {
        return $this->render('editing');
    }

    public function actionReviews()
    {
        $query_tb_review = Feedback::find();
        $pagination_review = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query_tb_review->count(),
        ]);
        $feedback = $query_tb_review
            ->with(['post.user'])
            //->where(['Status_feedback' => 1])
            ->offset($pagination_review->offset)
            ->limit($pagination_review->limit)
            ->all();

        return $this->render('reviews', ['reviews' => $feedback, 'pagination_reviews' => $pagination_review]);
    }

    public function actionPrices()
    {
        $model = new Prices();
        $model->type_of_writer = 30;
        $type_of_writer = ArrayHelper::map(ServicePrice::findByServiceId('4'), 'Id', 'Name_Service_Price');
        $get_urgency = ServicePrice::findByServiceId('7');//ArrayHelper::map(ServicePrice::findByServiceId('7'), 'Id', 'Name_Service_Price');
        $currency = ServicePrice::findByServiceId('11');//ArrayHelper::map(ServicePrice::findByServiceId('11'), 'Id', 'Name_Service_Price');
        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $list_price = array();
                    $price = array();
                    foreach ($get_urgency as $price_sv) {
                        if ($model->type_of_writer == '31') {
                            //$price_service = ArrayHelper::map(ServicePrice::findByServiceId('7'), 'Id', 'Price_VN');
                            //array_push($list_price,array($price_sv->Name_Service_Price => $price_sv->Price_USA * $currency[0]->Price_VN));
                            $price += [$price_sv->Name_Service_Price => $price_sv->Price_USA * $currency[0]->Price_VN];
                        } else if ($model->type_of_writer == '30') {
                            //array_push($list_price,array($price_sv->Name_Service_Price => $price_sv->Price_USA* $currency[0]->Price_USA));
                            $price += [$price_sv->Name_Service_Price => $price_sv->Price_USA* $currency[0]->Price_USA];
                        }
                    }
                    array_push($list_price,$price);
                    return $response = [
                        'data' => $list_price,
                        'success' => 'true'
                    ];
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [ActiveForm::validate($model), 'data' => 'error'];
                }
            }
        }
        return $this->render('prices', ['model' => $model, 'type_of_writer' => $type_of_writer,'list_urgency'=>$get_urgency,'currency'=>$currency]);
    }

    public function actionDiscounts()
    {
        return $this->render('discounts');
    }

    public function actionWriters($id = null)
    {
        $searchModel = new WritersSearch();
        if ($id != null) {
            $AboutEditor = Editor::getEditorById($id);
            $query_tb_review = Post::find();
            $pagination_review = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query_tb_review->count(),
            ]);
            $feedback = $query_tb_review
                ->with(['user','feedback'])
                ->where([/*'Status_feedback' => 1, */'Id_Editor' => $id])
                ->offset($pagination_review->offset)
                ->limit($pagination_review->limit)
                ->all();

            return $this->render('AboutWriter', ['reviews' => $feedback, 'pagination_reviews' => $pagination_review, 'AboutEditor' => $AboutEditor]);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('writers', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
    }

    public function renderPartial($view, $params = [])
    {
        //return parent::renderPartial($view, $params); // TODO: Change the autogenerated stub
        //return $this->getView()->render('_slide-show', $params, $this);
        /*if ($view == '_prices-urgency')
        {
            $get_urgency = ServicePrice::findByServiceId('7');
            return $this->getView()->render($view, ['list_urgency' => $get_urgency]);
        }*/
        $query_tb_review = Feedback::find();
        $feedback = $query_tb_review
            ->with(['post.user'])
            //->where(['Status_feedback' => 1])
            ->all();
        return $this->getView()->render($view, ['reviews' => $feedback]);
    }

    public function actionCompleted()
    {
        if ($verifiedData = Yii::$app->NLGateway->verifyRequestPurchaseSuccess()) {
            if ($verifiedData->transaction_status == '00') {
                // processing update database...
                //get order from table tmp order
                $get_order_tmp = TmpPost::findOne(['Token_Order'=>$verifiedData->token]);
                $insert_order = new OrderPost();
                $insert_order->SavePost($get_order_tmp->Topic,$get_order_tmp->Id_Author,$get_order_tmp->Type_of_services,$get_order_tmp->Type_of_paper,$get_order_tmp->Subject_area,'a',$get_order_tmp->PageNumbers,$get_order_tmp->File_Name,$get_order_tmp->Date_Create,$get_order_tmp->Deadline,$get_order_tmp->Id_Editor,$get_order_tmp->Price,$get_order_tmp->Status,$get_order_tmp->Payment_Method,$get_order_tmp->Status_Order);
                $get_order_tmp->delete();
                //$send_email = new SendMail();
                //$model = new OrderPost();
                //$model->sendEmail();
                //$model->sendEmailToEditor();
                //$send_email->SendMail('2','ordercompleted-html','ordercompleted-text','Success');
                //$send_email->SendMail('3','requestorder-html','requestorder-text','Request edit order');
                return $this->render('completed', [
                    //'message' => 'success'
                ]);
            } else {
                return $this->render('order', [
                    //'message' => 'order not found'
                ]);
            }
        }
        else{
            return $this->render('error', [
                //'message' => 'order not found'
            ]);
        }
    }
    public function actionAboutUs()
    {
        return $this->render('about-us');
    }

}