<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/index"], true)?>" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Shaxsiy ma'lumotlar</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/exam"], true)?>" class="nav-link">
                <i class="nav-icon fa fa-check"></i>
                <p>Tekshirish</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/darsjadval"], true)?>" class="nav-link">
                <i class="fas fa-tv nav-icon"></i>
                <p>Dars Jadval</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/checking"], true)?>" class="nav-link">
                <i class="fas fa-check-double nav-icon"></i>
                <p>Yo`qlama</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/rating"], true)?>" class="nav-link">
                <i class="fas fa-marker nav-icon"></i>
                <p>Baholash</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/teacherprofile/mygroups"], true)?>" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Mening guruhlarim</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/document/index"], true)?>" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Mening hujjatlarim</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/library/index"], true)?>" class="nav-link">
                <i class="nav-icon glyphicon glyphicon-book"></i>
                <p>Kutubxona</p>
            </a>
        </li>
    </ul>
</nav>

