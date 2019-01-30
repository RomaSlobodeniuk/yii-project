<?php
/**
 * Created by PhpStorm.
 * User: olia
 * Date: 26.01.19
 * Time: 14:28
 */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1> <?= $var ?></h1>

        <p class="lead">My Articles</p>

        <ul class="list-group">
            <?php foreach ($articles as $article): ?>
            <li class="list-group-item">

            <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title <?=$article->title ?> </h5>
                <p class="card-text"><?=$article->short_description  ?> </p>
            </div>
            <ul class="list-group list-group-flush">

                <li class="list-group-item">Date: <?=$article->date ?> </li>
                <li class="list-group-item">Author:<?=$article->author ?> </li>

            </ul>

            <div class="card-body">
                <a href="#" class="card-link"><?=$article->title ?> </a>
            </div>
    </div>


         <?php endforeach; ?>
        </ul>

    </div>
</div>



<!--

<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
-->