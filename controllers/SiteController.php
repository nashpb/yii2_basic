<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\console\Application;
use app\commands\HelloController;
use vova07\console\ConsoleRunner;
use \kriss\thread\controllers\WebThreadController;
use app\models\Posts;

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
        return $this->render('index');
    }

    public function actionLie()
    {
        Yii::$app->thread->addThread(['/site/try']);
       return $this->render('index');
    }

    public function actionTry()
    {
//         if (! defined('STDOUT')) {
//     define('STDOUT', fopen('/tmp/stdout', 'w'));
// }
        // $consoleController = new HelloController('hello',Yii::$app);
        // $consoleController->runAction('index');
        // echo "Done";
   // Yii::$app->consoleRunner->run('hello/index');
   // echo "Done";

        // for($i=0;$i<1000;$i++)
        //     {
        //         echo("LOL");
        //         sleep(5);
        //         $models= new Posts();
        //         $models->title="Hi";
        //         $models->body="Test";
        //         $models->save();
        //     }
        $txt="LOL";
        $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        
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
//         $this->goBack();
//         exec("wmic /node:$_SERVER[REMOTE_ADDR] COMPUTERSYSTEM Get UserName", $user);
// // echo($user[1]);
//         $array_exp=explode('\\',$user[1] );
//         //var_dump($array_exp);    
//         $conn=Yii::$app->db;
//         // $domainchk='select domain_name from domains where domain_name="'.$array_e;xp[0].'";';
//         // $res=$conn->createCommand($domainchk);
//         // $res->execute();
//         //$res['cms']=Login::
//         //var_dump($res);

//         $domainchk =(int) (new \yii\db\Query())
//     ->from('domains')
//     ->where(['domain_name'=>$array_exp[0]])
//     ->count();

//     if($domainchk>0)
//     {
//         $dom_id = (new \yii\db\Query())
//         ->select(['id'])
//         ->from('domains')
//         ->where(['domain_name'=>$array_exp[0]])
//         ->one();
//         //var_dump($dom_id);
//         $array_exp[1]="";
//         $userchk = (int)(new \yii\db\Query())
//         ->from('users')
//         ->where(['username'=>$array_exp[1],'dom_id'=>$dom_id])
//         ->count();
//         if($userchk<1)
//         {
//           //  return $this->render('403');
//             throw new ForbiddenHttpException(Yii::t('yii', 'Authorization Failed. Wrong User. Try accessing from the work server.')); 
//         }
//         // var_dump($userchk);
//         return $this->goBack();
        
//     }
//     else
//     {
//         throw new ForbiddenHttpException(Yii::t('yii', 'Authorization Failed. Wrong User. Try accessing from the work server.')); 
//     }

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
