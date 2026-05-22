
    <?php $a=\Yii::$app->language;  ?>	
<!-- 
<section class="gb">
		<div class="banner-div"></div>
		<div class="ban-con">
			<div class="display-in">
				<h2>Foto galereya</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
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
	<section class="gg">
		<div class="container">
		<div class="row">
				<div class="gal-right col-lg-2 col-md-3">
					<div class="heading-content">
						<h2 class="heading-h2">Galereya</h2>
					</div>
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
 <?php foreach ($category as $cat):?>
					  <li class="nav-item">
					    <a 

 <?php if ($cat->id==$id):?>
class="nav-link active" 
  <?php endif?>	
   <?php if ($cat->id!=$id):?>
   class="nav-link " 
  <?php endif?>
					    id="pills-home-tab<?=$cat->id?>" data-toggle="pill" 
					    	href="#pills<?=$cat->id?>" role="tab" 
					    	aria-controls="pills-home<?=$cat->id?>"
					    	 aria-selected="true">
					    	<?php   
                              
                                            if($a=='en-En'){
                                            	if (strlen($cat->title)>0) {
                                            		 echo( mb_substr ($cat->title, 0, 25)."..");
                                            	}
                                               
                                            }
                                             if($a=='ru-Ru'){
                                                 if (strlen($cat->title_ru)>0) {
                                            		 echo( mb_substr ($cat->title_ru, 0, 25)."..");
                                            	}
                                            }
                                         if($a=='uz-Uz'){
                                               if (strlen($cat->title_kril)>0) {
                                            		 echo( mb_substr ($cat->title_kril, 0, 25)."..");
                                            	}
                                            }
                                            ?>
					    	 </a>
					  </li>
 <?php endforeach?>
					
					  
					</ul>
				</div>
				<div class="tab-content col-lg-10 col-md-9" id="pills-tabContent">
 <?php foreach ($category as $cat):?>
				  <div 
 <?php if ($cat->id==$id):?>
       class="tab-pane fade show active"
  <?php endif?>	
   <?php if ($cat->id!=$id):?>
       class="tab-pane fade"
  <?php endif?>	
				   id="pills<?=$cat->id?>" role="tabpanel" 
				  aria-labelledby="pills-home-tab<?=$cat->id?>">

				  <section id="gallery">
	  <div class="container">
	    <div id="image-gallery">
	      <div class="row">
	      	<?php foreach ($galery as $gal):?>
				  			    <?php if ($gal->category_id==$cat->id):?>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
          <div class="img-wrapper">
            <a href="<?=\yii\helpers\Url::to(["../uploads/$gal->image"], true)?>"><img 
            	src="<?=\yii\helpers\Url::to(["../uploads/$gal->image"], true)?>" class="img-responsive"></a>
            <div class="img-overlay">
              <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
          </div>
        </div>
          <?php endif?>	
 <?php endforeach?>
      </div><!-- End row -->
    </div><!-- End image gallery -->
  </div><!-- End container --> 
</section>
				  </div>	

 <?php endforeach?>			
				 
				</div>
			</div>
			</div>
		</div>
 	</section>
	 	