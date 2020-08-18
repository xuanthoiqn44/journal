<?php

namespace app\controllers;

use app\commands\Mail;
use app\models\LoginForm;
use yii\widgets\ActiveForm;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\RegisterForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\Users;
use app\models\VerifyAccount;
use yii\base\InvalidParamException;
use yii\web\Request;
use yii\web\Response;

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
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model
        ]);
    }
    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->Register();
            if ($user) {
                Yii::$app->queue->push(new Mail([
                    'to' => $user->EmailID,
                    'resetLink' => Yii::$app->urlManager->createAbsoluteUrl(['account/verify-account', 'token' => $user->Auth_key]),
                    'fullName' => $user->FirstName . ' ' . $user->LastName,
                    'view' => 'verifyAccount-html',
                    'text' => 'verifyAccount-text',
                    'subject' => 'Verify account '
                ]));
                Yii::$app->session->setFlash('success', 'Please check your email for active account.');
                //if (Yii::$app->getUser()->login($user))
                return $this->goHome();
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    /*action reset password*/
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->resetPassword();
            if ($user) {
                Yii::$app->queue->push(new Mail([
                    'to' => $user->EmailID,
                    'resetLink' => Yii::$app->urlManager->createAbsoluteUrl(['account/reset-password', 'token' => $user->Password_reset_token]),
                    'fullName' => $user->FirstName . ' ' . $user->LastName, 
                    'view' => 'passwordResetToken-html', 
                    'text' => 'passwordResetToken-text', 
                    'subject' => 'Password reset '
                ]));
                Yii::$app->session->setFlash('success', \Yii::t('app', 'Check your email for further instructions.'));
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', \Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
                return $this->refresh();
            }
        }
        $model->EmailID = '';
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
    public function actionResetPassword($token = '')
    {
        $model = new ResetPasswordForm($token);
        if (!$model->isReset) {
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPasswordForm', [
            'model' => $model]);
      }

      /*Verify Account*/
    public function actionVerifyAccount($token = '')
    {
        if ($model = new VerifyAccount($token)) {
            if ($model->isVerified && $model->AcceptVerify()) {
                Yii::$app->session->setFlash('success', 'Success to verify account.');
                return $this->goHome();
            }
        }
        return $this->goHome();
    }
}
?>