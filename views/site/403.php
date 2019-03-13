<?php
use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
$this->title = 'Authorization failed';
//$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/403.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ], 'css-print-theme');
?>
<h1 class="text"><span>403</span></h1>