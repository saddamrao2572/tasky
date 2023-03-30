<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<link rel="stylesheet" href="/global.css" />
    <link rel="stylesheet" href="/index.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="/css/plugins.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
	<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
</head>




<body>
<?php $this->beginBody() ?>
	<div class="site-wrapper" id="top">
		<div class="site-header header-4 mb--20 d-none d-lg-block">
            <div class="header-top header-top--style-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="header-top-list">
                                <li class="dropdown-trigger currency-dropdown"><a href="#"> MO-DO 08:00-12:00 and 13:00-17:00, FR:8:00-13:00 Uhr </a>
                                   
                                </li>
                                
                            </ul>
                        </div>
						 <div class="col-lg-6">
                            <ul class="header-top-list">
                                <li class="dropdown-trigger currency-dropdown"><a href="#"> MO-DO  Sie erreichen uns unter: +43 (0)4585 / 24567</a>
                                   
                                </li>
                                
                            </ul>
                        </div>
                   
                    </div>
                </div>
            </div>
              <div class="header-middle pt--10 pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <a href="index.html" class="site-brand">
                                <img src="/logo.png" alt="">
                            </a>
                        </div>
                       
                        <div class="col-lg-9">
                            <div class="main-navigation flex-lg-right">
                               <ul class="main-menu menu-right li-last-0">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="#portfolio">PORTFOLIO</a></li>
        <li><a href="#pricing">PRICING</a></li>
        <li><a href="/site/books">Book Search</a></li>
      </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    
       
        <?= $content ?>
  

	</div>
	<!--=================================
  Brands Slider
===================================== -->

	<!--=================================
    Footer Area
===================================== -->
	<footer class="text-center footer">
 	<br/>
   <div class="row">
   
		<div class="col-md-3 col-sm-3">Foobar</div>
          <div class="col-md-3 col-sm-3">Uber uns</div>
          <div class="col-md-3 col-sm-3">Kontakt</div>
          <div class="col-md-3 col-sm-3">Impressum</div>
   </div>
   <br/><br/><br/>
  <p>Bootstrap Theme Made By <a href="#" title="Visit w3schools">saddam</a></p>
  
   
</footer>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="/js/plugins.js"></script>
	
	
	<?php $this->endBody() ?>
</body>


<!-- Mirrored from htmldemo.net/pustok/pustok/shop-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Mar 2023 16:44:20 GMT -->
</html>


<?php $this->endPage() ?>
