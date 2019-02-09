<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4" style="color: red;"><?= $article->title?></h1>
            - <a href="<?= $url = Url::to(['site/edit', 'id' => $article->id]); ?>">Edit</a>
            - <a href="<?= $url = Url::to(['site/remove', 'id' => $article->id]); ?>">Remove</a>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#"><?= $article->author ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on <?= $article->date ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="<?=  Url::to('@web/' . $article->image) ?>" alt="" style="width: 100%;">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?= $article->short_description ?></p>

            <p><?= $article->description ?></p>

            <blockquote class="blockquote">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in
                    <cite title="Source Title">Source Title</cite>
                </footer>
            </blockquote>

            <div class="text-right">
                <a href="<?= $url = Url::to(['site/articles']) ?>" class="btn btn-primary">Go back</a>
            </div>
            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'comments']]); ?>
                    <?= $f->field($commentsForm, 'name')->input('text', ['value' => '']); ?>
                    <?= $f->field($commentsForm, 'text')->input('textarea', ['value' => '']); ?>
                    <?= $f->field($commentsForm, 'article_id')->textArea()->label(false)->input('hidden', ['value' => $article->id]); ?>
                    <?= Html::submitButton('Save'); ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <!-- Single Comment -->
            <div class="comments-block">
                <?php foreach ($comments as $comment): ?>
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">
                                <?php if ($comment->name === 'Vasia'): ?>
                                    <strong><?= $comment->name ?></strong>
                                <?php else: ?>
                                    <?= $comment->name ?>
                                <?php endif ?>
                            </h5>
                            <p><?= $comment->text ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
