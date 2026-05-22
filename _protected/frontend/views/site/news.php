            <?php foreach ($news as $new):?>
<!-- <section class="fbs">
		<div class="fbs-banner bbs-banner"></div>
		<div class="fbs-container">
			<div class="flex-in">
				<h2>Yangiliklarning batafsil ko'rinishi</h2>
			<p>
					<span><?php  echo( mb_substr ($new->title_lotin, 0, 200)."...");?></a> </span>
			</p>
			
			</div>
		</div>
	</section> -->
<br>
<br>

<section class="bmcs">
		<div class="owl-carousel owl-theme bmcs-carousel">
 <?php foreach ($news1 as $new1):?>

			<div class="item">
				<h5>
				 <?php   $a=\Yii::$app->language; 
		                              
		                if($a=='en-En'){
		                   echo( mb_substr ($new1->name_lotin, 0, 80)."...");
		                }
		                 if($a=='ru-Ru'){
		                    echo( mb_substr ($new1->name_ru, 0, 80)."...");
		                }
		             if($a=='uz-Uz'){
		                   echo( mb_substr ($new1->name_kril, 0, 80)."...");
		                }
		                
		                ?></h5>
				<div class="date">
					<img   src="<?=\yii\helpers\Url::to(["../themes/default/image/clock.png"], true)?>">

					<span>25.05.2019</span>
				</div>
				<a href="<?=\yii\helpers\Url::to(["/site/news/?id=$new1->id"], true)?>">
					<button class="button-hover">
										<?=\Yii::t('main', 'Batafsil'); ?>
										<i class="fa fa-angle-right"></i>
									</button>
				</a>
			</div>
			
<?php endforeach?>
		</div>		
	</section>
	<section class="bcs">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="left-col-in">
						<div class="b-heading-content  media-p">
							<h2>
							<span>

                             <?php   $a=\Yii::$app->language; 
                              
                if($a=='en-En'){
                   echo( mb_substr ($new->name_lotin, 0, 245)."");
                }
                 if($a=='ru-Ru'){
                    echo( mb_substr ($new->name_ru, 0, 245)."");
                }
             if($a=='uz-Uz'){
                   echo( mb_substr ($new->name_kril, 0, 245)."");
                }
                ?>
							 </span>
							</h2>
						</div>
						<div>
							<span><?=$new->start_date?></span>
						</div>
						<div class="image-content" style="display: flex;justify-content: center;">
							<img  src="<?=\yii\helpers\Url::to(["../uploads/$new->image"], true)?>">
						</div>
						<div class="text-content">
							<p>
								 <?php   $a=\Yii::$app->language; 
                              
                if($a=='en-En'){
                   echo ($new->title_lotin);
                }
                 if($a=='ru-Ru'){
                    echo($new->title_ru);
                }
             if($a=='uz-Uz'){
                   echo  ($new->title_kril);
                }
                
                ?>
							</p>
							
						</div>
					</div>
				</div>
					<?php endforeach?>
				<div class="col-lg-4 col-md-4">
					<div class="right-col-in">
						<div class="heading-content">
							<h2 class="heading-h2"> <?=\Yii::t('main', 'So`ngi yangiliklar'); ?></h2>
						</div>
						<ul>
		  <?php foreach ($news1 as $new1):?>
							<li>

								<h6>
					
					 <?php   $a=\Yii::$app->language; 
		                              
		                if($a=='en-En'){
		                   echo( mb_substr ($new1->name_lotin, 0, 80)."...");
		                }
		                 if($a=='ru-Ru'){
		                    echo( mb_substr ($new1->name_ru, 0, 80)."...");
		                }
		             if($a=='uz-Uz'){
		                   echo( mb_substr ($new1->name_kril, 0, 80)."...");
		                }
		                
		                ?>
									</h6>
								<div class="date">
									<img class="mr-2"
							 src="<?=\yii\helpers\Url::to(["../themes/default/image/clock.png"], true)?>">
										<span><?=$new->start_date?></span>
								</div>
								<a href="<?=\yii\helpers\Url::to(["/site/news/?id=$new1->id"], true)?>">
									<button class="button-hover">
										<?=\Yii::t('main', 'Batafsil'); ?>
										<i class="fa fa-angle-right"></i>
									</button>
								</a>
							</li>
		<?php endforeach?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>  

