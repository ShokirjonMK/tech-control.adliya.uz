<!-- SEARCH FORM -->
<form class="form-inline ml-3">
    <div class="input-group input-group-sm">

        <h5>

        </h5>
    </div>
</form>
<ul class="navbar-nav ml-auto">
    <br>
    <h5>
        <a href="<?=\Yii\helpers\Url::to(["/user/viewuser?id=$user->id"])?>">
            <?php echo $user->username ;?>
        </a>
    </h5>

    <li class="nav-item">
        <a href="<?=toRoute('/site/logout'); ?>" data-method="get" data-toggle="tooltip"
           data-placement="bottom" title="Logout">
            <i style="font-size: 35px; margin-left: 30px;" class="fas fa-sign-out-alt"></i>
        </a>
    </li>
</ul>
