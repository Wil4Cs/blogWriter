<div class="container">
    <section class="row chapterOnly">
        <img class="hidden-xs col-sm-12" src="img/alaska5.jpg" alt="Chapitre <?php echo $chapter->getId() ?>">
        <h1 class="col-xs-5">Chapter <?php echo $chapter->getId() ?></h1>
        <article class="col-xs-12">
            <h2><?php echo $chapter->getTitle() ?></h2>
            <p><?php echo $chapter->getContent() ?></p>
            <p class="writer"><i class="fa fa-user-o" aria-hidden="true"></i> Par <?php echo $chapter->getAuthor()?> le <?php echo $chapter->getDate() ?></p>
        </article>
    </section>
</div>
