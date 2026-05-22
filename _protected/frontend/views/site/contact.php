<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>

    <section class="con-con-sec contact">
        <div class="con-con-container container">
            <div class="heading-content">
                <h2 class="heading-h2"><?=\Yii::t('main', 'Biz bilan bog`lanish'); ?></h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <input class="form-control" type="text"
                             placeholder="<?=\Yii::t('main', 'F.I.Sh'); ?>">
                            <input class="form-control" type="text" 
                             placeholder="<?=\Yii::t('main', 'Email'); ?>">
                            <input class="form-control" type="text" 
                             placeholder="<?=\Yii::t('main', 'Mavzu'); ?>">
                            <textarea class="form-control" type="text
                            " placeholder="<?=\Yii::t('main', 'Xabar matni'); ?>"
                             rows="6"></textarea>
                    <button class="con-con-btn" type="submit"><?=\Yii::t('main', 'Yuborish'); ?></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <ul class="list-group contact-ul">
                      <li class="list-group-item">
                        <i class="fa fa-phone"></i>
                        <span>(+998 78) 150-31-50</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-phone"></i>
                        <span>(+998 71) 234-85-64</span>
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
                        <span>100202, Toshkent shahri, Xurshid ko'chasi 86a-uy</span>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<section class="cmap">
        <div class="heading-content">
            <h2 class="heading-h2"><?=\Yii::t('main', 'Bizning manzil'); ?></h2>
        </div>
        <div class="map-content">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A930e3dd3dc96d80d66f52ce8ab8083616efca0a42c69a6af2d290b41d334b63d&amp;width=100%25&amp;height=300&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </section>
