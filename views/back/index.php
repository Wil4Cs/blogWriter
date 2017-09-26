<div class="col-xs-12 panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">Overview</h3>
    </div>
    <div class="panel-body">
        <p>Currently, <? echo $numbersOfChapters ?> chapter(s) have been published!</p>
        <? if ($numbersOfCautionComments == '0') { ?>
        <p>No comments have been warned!</p>
        <? } else { ?>
        <p class="cautionComment"><i class="fa fa-flag text-danger" aria-hidden="true"></i> <? echo $numbersOfCautionComments ?> comment(s) has been warned!</p>
        <? } ?>
    </div>
</div>