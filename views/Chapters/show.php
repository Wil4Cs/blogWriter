<div class="container">
    <section class="row chapterOnly">
        <img class="hidden-xs col-sm-12" src="img/alaska5.jpg" alt="Humpback whales">
        <div class="row">
            <h1 class="col-xs-5">Chapter <?php echo $chapter->getNumber() ?></h1>
            <article class="col-xs-offset-1 col-xs-10">
                <h2 class="col-xs-12"><?php echo $chapter->getTitle() ?></h2>
                <p class="col-xs-12"><?php echo $chapter->getContent() ?></p>
                <p class="writer col-xs-offset-5 col-xs-7 col-sm-offset-6 col-sm-6"><i class="fa fa-user-o" aria-hidden="true"></i> Par <?php echo $chapter->getAuthor()?> le <?php echo $chapter->getDate() ?></p>
            </article>
        </div>
        <div class="row">
            <div class="comment col-xs-offset-1 col-xs-10">
                <a class=" col-xs-12">Poster un commentaire</a>
                <div class="row">
                    <div class="col-xs-offset-2 col-xs-8">
                        <p class="col-xs-8">Date</p>
                        <p class="col-xs-4">Signaler</p>
                        <p class="col-xs-12">Auteur</p>
                        <p class="col-xs-12">PARAGRAPHE</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
