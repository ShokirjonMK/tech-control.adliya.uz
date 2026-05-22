    <?php $a=\Yii::$app->language;  ?>
<!-- <section class="fbs">
		<div class="fbs-banner"></div>
		<div class="fbs-container">
			<div class="flex-in">
				<h2>Bizning Filiallarimiz</h2>
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
		<section class="fts">
		<ul class="nav nav-tabs" id="myTab" role="tablist">

	 <?php foreach($regions as $reg):?>
		  <li class="nav-item">
		    <a 
 <?php if($id!=$reg->id):?>
		    class="nav-link" 

		  <?php endif?> 

		   <?php if($id==$reg->id):?>
		    class="nav-link active" 

		  <?php endif?> 
		    id="tab-<?=$reg->id?>" data-toggle="tab" href="#viloyat<?=$reg->id?>" role="tab" aria-controls="toshkent" aria-selected="true"><?=$reg->title_kril?></a>
		  </li>
		  <?php endforeach; ?>
		  
		</ul>
		<div class="tab-content" id="myTabContent">
 <?php foreach($regions as $reg):?>
		<div 

<?php if($id!=$reg->id):?>
		    class="tab-pane fade show"

		  <?php endif?> 

		   <?php if($id==$reg->id):?>
		    class="tab-pane fade show active" 

		  <?php endif?> 


		 id="viloyat<?=$reg->id?>" role="tabpanel" 
			aria-labelledby="tab-<?=$reg->id?>">
			<div class="container">
				<div class="row">
	 <?php foreach($regions2 as $reg2):?>
	 	 <?php if($reg2->parent_id==$reg->id):?>
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="card">
						   
						  <div class="card-body">
						    <h5 class="card-title">
							<?php 

					          if($a=='en-En'){echo(($reg2->title_lotin));}                           
					        if($a=='ru-Ru'){echo(($reg2->title_ru)); } 
					         if($a=='uz-Uz'){ echo(($reg2->title_kril));}
					         ?>
						    	
						    </h5>
						  </div>
						  <ul class="list-group list-group-flush ft-ul">
						    <li class="list-group-item">
						    	<span class="left"><?=\Yii::t('main', 'Manzili'); ?>:</span>
						    	<span class="right">
						    		<?php 
 
					          if($a=='en-En'){echo(($reg2->addres_lotin));}                           
					        if($a=='ru-Ru'){echo(($reg2->addres_ru)); } 
					         if($a=='uz-Uz'){ echo(($reg2->addres_kril));}
					         ?>
						    	</span>
						    </li>
						    <li class="list-group-item">
						    	<span class="left"><?=\Yii::t('main', 'Filial raxbari'); ?>:</span>
						    	<span class="right">
						    			<?php 
 
					          if($a=='en-En'){echo(($reg2->director_lotin));}                           
					        if($a=='ru-Ru'){echo(($reg2->director_ru)); } 
					         if($a=='uz-Uz'){ echo(($reg2->director_kril));}
					         ?>
						    	</span>
						    </li>
						    <li class="list-group-item">
						    	<span class="left">Telefon:</span>
						    	<span class="right"><?=$reg2->number?></span>
						    </li>
						    <li class="list-group-item">
						    	<span class="left"> <?=\Yii::t('main', 'Fax'); ?>:</span>
						    	<span class="right"><?=$reg2->fax?></span>
						    </li>
						    <li class="list-group-item">
						    	<span class="left"><?=\Yii::t('main', 'E-mail'); ?>:</span>
						    	<span class="right"><?=$reg2->email?></span>
						    </li>
						   

						  </ul>
						</div>
					</div>
					  <?php endif?> 
					  <?php endforeach; ?>
				</div>
			</div>
		  </div>
				  <?php endforeach; ?>

		  
		</div>
	</section>