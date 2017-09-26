<? foreach($chapters as $chapter) { ?>
<div class="container ">
    <section class="chapters row">
        <img class="hidden-xs img-circle" src="img/<? echo $chapter->getImageName() ?>" alt="Humpback whales">
        <article class="col-xs-12 col-sm-8">
            <h1>Chapter <? echo $chapter->getChapterNumber() ?> : </h1>
            <div class="horizontal_bar"></div>
            <h2><? echo $chapter->getTitle() ?></h2>
            <p><? echo $chapter->getContent() ?></p>
            <a class="btn btn-default" href="?controller=front&amp;action=show&amp;id=<? echo $chapter->getId() ?>">Read Chapter</a>
        </article>
    </section>
</div>
<? } ?>
