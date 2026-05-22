<?php
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$m_o = "menu-open";
$ac = "active";
?>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<?php  $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one(); ?>
        <li class="nav-item has-treeview
        <?php if (($controller == "tex" )) { echo $m_o; }?>">
            <a href="#" class="nav-link
            <?php if (($controller == "tex")) { echo $ac; }?>">
                <i class="nav-icon fas fa-university"></i>
                <p>
                	Tex
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ml-3" style="display: <?php
            if (($controller == "tex" || $controller == "tarkibiy-bolinma" )) { echo 'block'; } else { echo 'none';}?> ;">

                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/tex/index"], true) ?>" class="nav-link
                        <?php if (($controller == "tex" && $action == 'index')) { echo $ac; }?>">
                        <i class="fab fa-atlassian nav-icon"></i>
                        <p>Tex index</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/tarkibiy-bolinma"], true) ?>" class="nav-link
                        <?php if ($controller == "tarkibiy-bolinma") { echo $ac; }?>">
                        <i class="nav-icon fab glyphicon glyphicon-tasks"></i>
                        <p>Tarkibiy bo'linma</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/tex/chop"], true) ?>" class="nav-link
                        <?php if (($controller == "chop" && $action == 'chop')) { echo $ac; }?>">
                        <i class="nav-icon fab glyphicon glyphicon-adjust"></i>
                        <p>Chop qilish</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/site"], true) ?>" class="nav-link
                        <?php // if (($controller == "direction")) { echo $ac; }?>">
                        <i class="fab fa-asymmetrik nav-icon"></i>
                        <p>Test</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/building/index"], true) ?>" class="nav-link
                        <?php  if (($controller == "building")) { echo $ac; }?>">
                        <i class="fab fa-asymmetrik nav-icon"></i>
                        <p>Bino</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/room/index"], true) ?>" class="nav-link
                        <?php  if (($controller == "room")) { echo $ac; }?>">
                        <i class="fab fa-asymmetrik nav-icon"></i>
                        <p>Xona</p>
                    </a>
                </li>

               <li class="nav-item">
                    <a href="<?= \Yii\helpers\Url::to(["/material-base/index"], true) ?>" class="nav-link
                        <?php  if (($controller == "material-base")) { echo $ac; }?>">
                        <i class="fab fa-asymmetrik nav-icon"></i>
                        <p>material</p>
                    </a>
                </li>



            </ul>
        </li>



    </ul>
</nav>