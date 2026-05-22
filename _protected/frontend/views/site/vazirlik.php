    <?php $i=1; ?>
           
<br>
<br>

	<section class="bcs">
		<div class="container">
			<div class="row">

				<div class="col-lg-8 col-md-8">

					<div class="left-col-in">
						<div class="b-heading-content">
							<h2>
				
							</h2>
						</div>
						<div>
						
						</div>
						<?php if ($id==8):?>
						<div class="con-con-container container">
            <div class="heading-content">
                <h2 class="heading-h2" style="text-align: center;"> <?=\Yii::t('main', 'Matbuot xizmati'); ?> </h2>
            </div>
             <div class="col-md-3">
             </div>
              <div class="col-md-3">
             </div>
                <div class="col-md-12">
                    <ul class="list-group contact-ul">
                      <li class="list-group-item">
                        <i class="fa fa-user"></i>
                        <span>
<?php echo(\Yii::t('main', '"Vatanparvar" tashkiloti Matbuot kotibi'));?><br>
<?php echo(\Yii::t('main', 'Xaitova Mastura Xusanovna'));?>
                        	</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-phone"></i>
                        <span> (+998 71) 234-85-64</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        <span>(+998 78)  150-31-50</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <span>info@vatanparvar.uz</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>

                       </span>
                      </li>
                    </ul>
                </div>
            </div>
             <?php endif?> 
             <h2>
             	<?php if ($id==3):?>
             	<?php echo(\Yii::t('main', 'Oʼzbekiston mudofaasiga koʼmaklashuvchi “Vatanparvar” tashkiloti Markaziy kengash rahbariyati.'));?>
             	 <?php endif?> 
             </h2>
						 <?php foreach ($vazirlik as $new):?>

							<?php if ($new->image!=""):?>
					<div class="image-content" style="display: flex;justify-content: center;">
			<img style="width: 500px;" src="<?=\yii\helpers\Url::to(["../uploads/$new->image"], true)?>">
									</div>
			  					 <?php endif?> 

						<div class="text-content">
							<p>

 <?php   $a=\Yii::$app->language; 
                              
                if($a=='en-En'){
                   echo (($new->title_lotin));
                }
                 if($a=='ru-Ru'){
                    echo (($new->title_ru));
                }
             if($a=='uz-Uz'){
                   echo (($new->title_kril));
                }
                
                ?>
								
							</p>
							
						</div><?php endforeach?>
					</div>
				</div>
					
				<div class="col-lg-4 col-md-4">
					<div class="right-col-in">
						<div class="heading-content">
							
						</div>
						<ul>
		  <?php foreach ($text as $te):?>
							<li>

								<h5><?php echo(\Yii::t('main', $te));?></h5>
								<div class="date">
									 <img class="mr-2" src="<?=\yii\helpers\Url::to(["../themes/default/image/clock.png"], true)?>">
										
								</div>
								<a href="<?=\yii\helpers\Url::to(["/site/vazirlik/?id=$i"], true)?>"> 
									<button class="button-hover">
										<?php echo(\Yii::t('main', 'Haqida'));?></h5>
										<i class="fa fa-angle-right"></i>
									</button>
								</a>
							</li>

		<?php $i++; endforeach?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
        </div>
	</section>  
