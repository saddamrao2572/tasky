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
	
	<main class="inner-page-sec-padding-bottom">
			<div class="container">
			 <div class="col-lg-12">
                            <div class="header-search-block">
							<form id="search-form" method="get">
                                <input type="text" name="query" placeholder="Search by title or author">
                              
                                <button id="search">Search</button>
								</form>
                            </div>
                        </div>
			
				<?php 
				// echo '<pre/>';
				// print_r($dataProvider);
				// exit;
				?>
				<?php Pjax::begin([
			'id' => 'searchResult',
			'enablePushState' => false, // to disable push state
			'enableReplaceState' => false, // to disable replace state,
			'clientOptions' => ['method' => 'POST']
		]); ?>	
		
			
				<?= 
						ListView::widget([
							'dataProvider' => $dataProvider,
							'itemView' => '_searchResult',
							'viewParams'=>['modal'=>$modal],
							'layout' => "<div class='shop-product-wrap grid with-pagination row space-db--30 shop-border'>{items}</div><div class='pagination'>{pager}</div>",
							'pager' => [
								'options' => ['class' => 'customePAge text-center'],
								'nextPageLabel' => 'Next',
								'prevPageLabel' => 'Prev',
								'maxButtonCount' => 6,
								'nextPageCssClass' =>'',
								'prevPageCssClass' =>'',
							],
							'emptyText'=>'No Book yet'
						]); 
					?>
					
					
					
				<?php Pjax::end(); ?>

			
			</div>
		</main>
		
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
											<img  id="cover" src="" alt="">
										</div>
										
									</div>
									<!-- Product Details Slider Nav -->
									
								</div>
								<div class="col-lg-7 mt--30 mt-lg--30">
									<div class="product-details-info pl-lg--30 ">
										<p class="tag-block">Author: <a href="#" id="author"></a>, <a href="#"></a></p>
										<h3 class="product-title"  id="title"></h3>

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
		<?php
$booksearch = Url::to(['site/booksearch']);


$js = <<< JS
		$('.detail').on('click',function(){
			var isbn = $(this).data("isbn");
			var author_name = $(this).data("author_name");
			var thumbnail = $(this).data("thumbnail");
			var btn = $(this);
			
			var data = { 'isbn': isbn };
			
			console.log(btn);
			$.ajax({
				method: "POST",
				url: "$booksearch",
				data: data
			})
			.done(function( msg ) {
				
				
				var data = JSON.parse(msg);
				console.log(data);
				if(data.success == '1') {
				    
					$("#cover").attr("src",thumbnail);
					$("#author").text(author_name);
					$("#title").text(data.title);
					$('#quickModal').modal('show');
					
				}
				return false;
			});
		});


JS;
$this->registerJs($js);