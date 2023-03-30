<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\JSON;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Gym */

$this->title = 'book Listings';
$this->params['breadcrumbs'][] = $this->title;


?>
	
						<!-- Modal -->
				<div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog"
				aria-labelledby="quickModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<div class="product-details-modal">
							<div class="row">
								<div class="col-lg-5">
									<!-- Product Details Slider Big Image-->
									<div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
										"slidesToShow": 1,
										"arrows": false,
										"fade": true,
										"draggable": false,
										"swipe": false,
										"asNavFor": ".product-slider-nav"
										}'>
										<div class="single-slide">
											<img  id="cover" src="<?=$thumbnail?>" alt="">
										</div>
										
									</div>
									<!-- Product Details Slider Nav -->
									
								</div>
								<div class="col-lg-7 mt--30 mt-lg--30">
									<div class="product-details-info pl-lg--30 ">
										<p class="tag-block">Author: <a href="#" id="author"><?=$author?></a>, <a href="#"></a></p>
										<h3 class="product-title"  id="title"><?=$title?></h3>

									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="widget-social-share">
								<span class="widget-label">Share:</span>
								<div class="modal-social-share">
									<a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
									<a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
									<a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
									<a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>