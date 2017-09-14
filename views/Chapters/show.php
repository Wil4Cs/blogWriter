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
                <a class="btn btn-default" href="?controller=front&action=insertComment&id=<?php echo $chapter->getId() ?>">Poster un commentaire<?php if(empty($comments)) { ?> - Soyez le premier!<?php } ?></a>
                <div class="dashed row">
                    <?php if(!empty($comments)) {
                        foreach ($comments as $comment) { ?>
                            <div class="commentInfo col-xs-offset-2 col-xs-8">
                                <h5 class="date col-xs-8"><?php echo $comment->getDate() ?></h5>
                                <?php if ($comment->getFlag() == false) { ?>
                                    <form  class="flag col-xs-4" action="" method="post">
                                        <input type="hidden" name="commentId" value="<?php echo $comment->getId() ?>">
                                        <button type="submit" class="btn">Signaler</button>
                                    </form>
                                <?php } else { ?>
                                    <p class="danger"><i class="fa fa-lg fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>
                                <?php } ?>
                                <h3 class="author col-xs-12"><?php echo strtoupper(htmlspecialchars($comment->getAuthor())) ?></h3>
                                <p class="content col-xs-12"><?php echo nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>

