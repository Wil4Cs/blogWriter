<?php foreach($chapters as $chapter) { ?>
<div class="container ">
    <section class="chapters row">
        <img class="hidden-xs img-circle" src="img/alaska5.jpg" alt="Humpback whales">
        <article class="col-xs-12 col-sm-8">
            <h1>Chapter <?php echo $chapter->getNumber() ?> : </h1>
            <div class="horizontal_bar"></div>
            <h2><?php echo $chapter->getTitle() ?></h2>
            <p><?php echo $chapter->getContent() ?></p>
            <a class="btn btn-default" href="?controller=front&action=show&id=<?php echo $chapter->getId() ?>">Read Chapter</a>
        </article>
    </section>
</div>
<?php } ?>
