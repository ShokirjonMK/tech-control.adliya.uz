<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/studentprofile/index"], true)?>" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Shaxsiy ma'lumotlar</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/studentprofile/exam"], true)?>" class="nav-link">
                <i class="fa fa-tasks nav-icon"></i>
                <p>Imtixonlar</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/studentprofile/darsjadval"], true)?>" class="nav-link">
                <i class="fas fa-tv nav-icon"></i>
                <p>Dars Jadval</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/studentprofile/myattendance"], true)?>" class="nav-link">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>Darsga qatnashish</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="<?=\Yii\helpers\Url::to(["/studentprofile/rating"], true)?>" class="nav-link">
                <i class="nav-icon fas fa-book-reader"></i>
                <p>O'zlashtirish</p>
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

