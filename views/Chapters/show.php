<div class="container">
    <section class="row chapterOnly">
        <img class="hidden-xs col-sm-12" src="img/alaska5.jpg" alt="Humpback whales">
        <div class="row">
            <h1 class="col-xs-5">Chapter <? echo $chapter->getNumber() ?></h1>
            <article class="col-xs-offset-1 col-xs-10">
                <h2 class="col-xs-12"><? echo $chapter->getTitle() ?></h2>
                <p class="col-xs-12"><? echo $chapter->getContent() ?></p>
                <p class="writer col-xs-offset-5 col-xs-7 col-sm-offset-6 col-sm-6"><i class="fa fa-user-o" aria-hidden="true"></i> Par <? echo $chapter->getAuthor() ?> le <? echo $chapter->getDate()->format('d-M-Y') ?></p>
            </article>
        </div>
        <div class="row">
            <div class="comment col-xs-offset-1 col-xs-10">
                <a class="btn btn-default" href="?controller=front&action=insertComment&id=<? echo $chapter->getId() ?>">Poster un commentaire<? if(empty($comments)) { ?> - Soyez le premier!<? } ?></a>
                <div class="dashed row">
                    <? if(!empty($comments)) {
                        foreach ($comments as $comment) { ?>
                            <div class="commentInfo col-xs-offset-2 col-xs-8">
                                <h5 class="date col-xs-8">le <? echo $comment->getDate()->format('d-M-Y') ?></h5>
                                <? if ($comment->getFlag() == false) { ?>
                                    <form  class="flag col-xs-4" action="" method="post">
                                        <input type="hidden" name="commentId" value="<? echo $comment->getId() ?>">
                                        <button type="submit" class="btn">Signaler</button>
                                    </form>
                                <? } else { ?>
                                    <p class="danger"><i class="fa fa-lg fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>
                                <? } ?>
                                <h3 class="author col-xs-12"><? echo strtoupper(htmlspecialchars($comment->getAuthor())) ?></h3>
                                <p class="content col-xs-12"><? echo nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            </div>
                        <? } ?>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
</div>

