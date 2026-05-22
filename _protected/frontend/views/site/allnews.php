<?php 
use yii\widgets\LinkPager;


 ?>
<!-- <section class="fbs">
		<div class="fbs-banner nbs-banner"></div>
		<div class="fbs-container">
			<div class="flex-in">
				<h2>Yangiliklar</h2>
			<p>
				Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<a href="#">
				<button>
					Batafsil
					<i class="fa fa-angle-right ml-2"></i>
				</button>
			</a>
			</div>
		</div>
	</section> -->
	<br>
	<br>
	<br>
	<br>
		<br>

	<section class="ncs">
		<div class="container">
			<div class="row">
				<!-- item -->
            <?php foreach ($news as $new):?>
				<div class="col-md-4 col-sm-6">
					<div class="news-col-inner">
						<img class="new-img" 
						src="<?=\yii\helpers\Url::to(["../uploads/$new->image"], true)?>">
						<div class="news-text-div">
							<div class="date-div">
								<span><?=$new->date?></span>
							</div>
							<div>
							
							</div>
							<div class="news-hr"></div>
							<div>
								<span class="new-text-body">
						<span>

 <?php   $a=\Yii::$app->language; 
                              
                if($a=='en-En'){
                   echo strip_tags( mb_substr ($new->title_lotin, 0, 105)."...");
                }
                 if($a=='ru-Ru'){
                    echo strip_tags( mb_substr ($new->title_ru, 0, 105)."...");
                }
             if($a=='uz-Uz'){
                   echo strip_tags( mb_substr ($new->title_kril, 0, 105)."...");
                }
                
                ?>
	 </span>


								</span>
							</div>
							<a href="<?=\yii\helpers\Url::to(["/site/news/?id=$new->id"], true)?>">
								<button class="new-button-bat">
									<?=\Yii::t('main', 'Batafsil'); ?>
									<i class="fa fa-angle-right"></i>
								</button>
							</a>
						</div>
					</div>
				</div>
			
				         <?php endforeach?>
			</div>
				<div class="paginations">
					 <?php
				            echo LinkPager::widget([
   			 'pagination' => $pages,
					])	;?>
				</div>
		</div>	
	</section>