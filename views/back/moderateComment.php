<? if (!empty($allCautionComments)) { foreach ($allCautionComments as $cautionComment) { ?>
<div class="col-xs-12 panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title col-xs-10 col-sm-11">By <? echo $cautionComment->getAuthor() ?></h3>
        <a href="?controller=back&amp;action=refreshComment&amp;id=<? echo $cautionComment->getId() ?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        <a class="trash" href="?controller=back&amp;action=eraseComment&amp;id=<? echo $cautionComment->getId() ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    </div>
    <div class="panel-body">
        <p>The <? echo $cautionComment->getDate()->format('M-d-Y') ?></p>
        <p><? echo $cautionComment->getContent() ?></p>
    </div>
</div>
<? } } else { ?>
    <div class="col-xs-12 panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Overview</h3>
        </div>
        <div class="panel-body">
            <p>No comments has been warned!</p>
        </div>
    </div>
<? } ?>
