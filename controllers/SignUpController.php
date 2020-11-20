<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\form\SignUpForm;

class SignUpController extends Controller {

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

    public function actionIndex() {
        $model = new SignUpForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signUp();

            if (Yii::$app->getUser()->login($user)) {
                Yii::$app->session->setFlash('signUpFormSubmitted');
                return $this->goHome();
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
