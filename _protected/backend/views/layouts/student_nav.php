 <!-- SEARCH FORM -->
 <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                        
                     <h5>
                   
                     </h5>
                </div>
            </form>

 <!-- Right navbar links -->
           
 <ul class="navbar-nav ml-auto">
                
                <h5>
                    <a href="<?=\Yii\helpers\Url::to(["/uz/studentprofile/index"])?>">
                    <!-- <img src="/uploads/admins/default.jpg" style = "width: 40px; height: 40px; border-radius: 50%;"> -->
                  <?php echo $user->full_name;?> 
                   </a>
                </h5>   

                <li class="nav-item dropdown">

                <li class="nav-item">
                    <a href="<?=toRoute('/site/logout'); ?>" data-method="get" data-toggle="tooltip"
                        data-placement="bottom" title="Logout">
                        <i style="font-size: 35px; margin-left: 30px;" class="fas fa-sign-out-alt"></i>
                    </a>

                </li>
            </ul>