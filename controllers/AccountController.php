<?php

namespace app\controllers;

use app\models\SendMail;
use yii\widgets\ActiveForm;
use yii\web\Response;
use Yii;
use app\models\User;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\RegisterForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\VerifyAccount;

class AccountController extends Controller
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

    public function actionUser()
    {
        $query = Users::find();

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('account', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionRegister()
    {
        $model = new RegisterForm();
        if (Yii::$app->request->isAjax) {
            try {
                if ($model->load(Yii::$app->request->post())) {
                    $user = $model->Register();
                    if ($user && $model->sendEmail()) {
                        Yii::$app->session->setFlash('success', 'Please check your email for active account.');
                        //if (Yii::$app->getUser()->login($user))
                        {
                            return $this->goHome();
                        }
                    }
                    else{
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ActiveForm::validate($model);
                    }
                }
                else{
                    return $this->renderAjax('_register', [
                        'model' => $model,
                    ]);
                }
            } catch (InvalidParamException $e) {
                $this->refresh();
                //throw new \yii\web\HttpException(404, 'Error');
            }

        }
        else{
            try {
                if ($model->load(Yii::$app->request->post())) {
                    if ($user = $model->Register() && $model->sendEmail()) {
                        Yii::$app->session->setFlash('success', 'Please check your email for active account.');
                        //if (Yii::$app->getUser()->login($user))
                        {
                            return $this->goHome();
                        }
                    }
                    else{
                        //Yii::$app->response->format = Response::FORMAT_JSON;
                        //return ActiveForm::validate($model);
                        return $this->render('register', [
                            'model' => $model,
                        ]);
                    }
                }
                else{
                    return $this->render('register', [
                        'model' => $model,
                    ]);
                }
            } catch (InvalidParamException $e) {
                $this->refresh();
                //throw new \yii\web\HttpException(404, 'Error');
            }
        }
    }
    /*action reset password*/
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->refresh();
                //$this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }

        }

        return $this->render('PasswordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            //throw new BadRequestHttpException($e->getMessage());
            //throw new BadRequestHttpException('Token is invalid');
            //$this->render('site/error');
            throw new \yii\web\HttpException(404, 'Token is invalid');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model]);
      }

      /*Verify Account*/
    public function actionVerifyAccount($token)
    {
        try {
            $model = new VerifyAccount($token);
        } catch (InvalidParamException $e) {
            //throw new BadRequestHttpException($e->getMessage());
            //throw new BadRequestHttpException('Token is invalid');
            throw new \yii\web\HttpException(404, 'Token is invalid');
        }

        if ( $model->AcceptVerify()) {
            Yii::$app->session->setFlash('success', 'Success to verify account.');
            return $this->goHome();
        }

        return $this->goHome();
    }
}
?>