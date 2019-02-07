<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations! <?= $my_custom_param ?></h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a id="my_button" class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators test-class">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?=  Url::to('@web/assets/images/articles/maks.jpg') ?>" alt="...">
                    <div class="carousel-caption"></div>
                </div>
                <div class="item">
                    <img src="<?=  Url::to('@web/assets/images/articles/roma.jpg') ?>" alt="...">
                    <div class="carousel-caption"></div>
                </div>
                <div class="item">
                    <img src="<?=  Url::to('@web/assets/images/articles/igor.jpg') ?>" alt="...">
                    <div class="carousel-caption"></div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

