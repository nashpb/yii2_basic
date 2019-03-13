<?php
namespace app\commands;

//include "HelloController.php";
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Posts;
use app\models\Test;


class AsyncOperation extends \Thread {

	public function __construct($arg) {
		$this->arg = $arg;
	}

	public function run() {
		
		if($this->arg=="Posts")
		{
			$check="app\commands\HelloController";
			$cont= new $check();
			$models=Yii::$app->runAction('hello/hurra');
			$sleep = mt_rand(1, 10);
			//$models = new Posts();
			sleep($sleep);
			printf('%s: %s  -start -sleeps %d' . "\n", date("g:i:sa"), $this->arg, $sleep);
			for($i=0;$i<1000;$i++)
			{
				printf("LOL");
				
				//var_dump($models);
				$models->title="Hi";
				$models->body="Test";
				$cont->setModel($models);
			}
			
			printf('%s: %s  -finish' . "\n", date("g:i:sa"), $this->arg);

		}
		if($this->arg=="test")
		{	
			$sleep = mt_rand(1, 10);
			sleep($sleep);
			printf('%s: %s  -start -sleeps %d' . "\n", date("g:i:sa"), $this->arg, $sleep);
			for($i=0;$i<1000;$i++)
			{
				
				$this->$models->test="Test";
				$this->$models->save();
			}
			
			printf('%s: %s  -finish' . "\n", date("g:i:sa"), $this->arg);
		}

        // if ($this->arg) {
        //     $sleep = mt_rand(1, 10);
        //     printf('%s: %s  -start -sleeps %d' . "\n", date("g:i:sa"), $this->arg, $sleep);
        //     sleep($sleep);
        //     printf('%s: %s  -finish' . "\n", date("g:i:sa"), $this->arg);
        // }
	}
	public function kom()
	{

		$stack = array();
// //Initiate Multiple Thread
// foreach ( range("A", "Z") as $i ) {
		$stack[] = new AsyncOperation($this->arg);
// }

// Start The Threads
		foreach ( $stack as $t ) {
			$t->start();
			printf("Started %s",$this->arg);
		}
// 		for($i=0;$i<10000;$i++)
// {

// 	printf("%d",$i);
// 	sleep(5);
// }
	}

}



// Create a array


?>