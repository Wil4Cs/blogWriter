<div class="container">
    <section class="row chapterOnly">
        <img class="hidden-xs col-sm-12" src="img/alaska5.jpg" alt="Humpback whales">
        <div class="row">
            <h1 class="col-xs-5">Chapter <? echo $chapter->getChapterNumber() ?></h1>
            <article class="col-xs-offset-1 col-xs-10">
                <h2 class="col-xs-12"><? echo $chapter->getTitle() ?></h2>
                <p class="col-xs-12"><? echo $chapter->getContent() ?></p>
                <p class="writer col-xs-offset-5 col-xs-7 col-sm-offset-7 col-sm-5 col-md-offset-7 col-md-5"><i class="fa fa-user-o" aria-hidden="true"></i> By <? echo $chapter->getAuthor() ?> <? echo $chapter->getDate()->format('d-M-Y') ?></p>
            </article>
        </div>
        <div class="row">
            <div class="comment col-xs-offset-1 col-xs-10">
                <a class="btn btn-default" href="?controller=front&amp;action=comment&amp;id=<? echo $chapter->getId() ?>">Post a comment<? if(empty($comments)) { ?> - Be the first!<? } ?></a>
                <div class="dashed row">
                    <? if(!empty($comments)) {
                        foreach ($comments as $comment) {
                            if ($comment->getAuthor() === 'Jean Forteroche') { ?>
                            <div class="commentAdmin col-xs-offset-2 col-xs-8">
                                <h5 class="date col-xs-8"><? echo $comment->getDate()->format('M-d-Y') ?></h5>
                                <h3 class="admin col-xs-12"><? echo strtoupper(htmlspecialchars($comment->getAuthor())) ?></h3>
                                <p class="adminContent col-xs-12"><? echo nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            <? } else { ?>
                            <div class="commentInfo col-xs-offset-2 col-xs-8">
                                <h5 class="date col-xs-8"><? echo $comment->getDate()->format('M-d-Y') ?></h5>
                            <? if ($comment->getFlag() == false) { ?>
                                <form  class="flag col-xs-4" action="" method="post">
                                    <input type="hidden" name="commentId" value="<? echo $comment->getId() ?>">
                                    <button type="submit" class="btn">Signaler</button>
                                </form>
                                <h3 class="author col-xs-12"><? echo strtoupper(htmlspecialchars($comment->getAuthor())) ?></h3>
                                <p class="content col-xs-12"><? echo nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            <? } else { ?>
                                <p class="danger"><i class="fa fa-lg fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>
                                <p class="offense col-xs-12">Offensive content reported to administrator</p>
                            <? } } if ($user->isAuthenticated()) { ?>
                                <div class="col-xs-offset-9 col-xs-3 col-md-offset-10 col-md-2">
                                    <a href="?controller=back&amp;action=editComment&amp;id=<? echo $comment->getId() ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="trash" href="?controller=back&amp;action=eraseComment&amp;id=<? echo $comment->getId() ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                            <? } ?>
                            </div>
                        <? } ?>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
</div>

