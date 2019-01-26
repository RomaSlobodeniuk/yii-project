<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

?>
<div class="site-articles">

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <h1 class="my-4">My Articles
            <small>Welcome!</small>
        </h1>

        <?php foreach ($articles as $article): ?>
            <div class="row">
                <div class="col-md-8">
                    <a href="#">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="<?=  Url::to('@web/assets/images/articles/' . $article->image) ?>" alt="">
                    </a>
                </div>
                <div class="col-md-4">
                    <h3><?= $article->title ?></h3>
                    <p><?= $article->short_description ?></p>
                    <p>Date: <?= $article->date ?></p>
                    <p>Author: <?= $article->author ?></p>
                    <a class="btn btn-primary" href="<?= $url = Url::to(['site/article', 'id' => $article->id]); ?>">Show More</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

        <!-- Pagination -->
        <div class="text-center">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'firstPageLabel' => 'Start',
                'lastPageLabel' => 'End',
            ]); ?>
            <div class="alert alert-info">
                Page <?= $activePage ?> from <?= $countPages ?>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
