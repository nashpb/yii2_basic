<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use vova07\console\ConsoleRunner;
//use nashpb\pthread\AsyncOperation;
use app\commands\AsyncOperation;
use app\models\Posts;
use app\models\Test;    

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    
    public function setModel($m)
    {
        $model=$m;
        $model->save();   
    }

    public function actionHurra()
    {
        $call= new Test();
        return $call;
    }
    public function actionIndex()
    {
       // $post= new Posts();
        //$test = new Test();

        $lmao=new AsyncOperation("Posts");
        $lmao->start();
        // for($i=0;$i<1000;$i++)
        //     {
        //         $model = new Posts();
        // //        var_dump($models);
        5//         $model->title="Hi";
        //         $model->body="Test";
        //         $model->save();
        //     }
        // $lol=new AsyncOperation("test",$test);   
        // $lol->start();
        printf('Done');
    }
}
