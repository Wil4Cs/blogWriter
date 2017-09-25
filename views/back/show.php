<? foreach ($chapters as $chapter) { ?>
<div class="col-xs-12 panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title col-xs-10 col-sm-11">Chapter <? echo $chapter->getNumber() ?> posted the <? echo $chapter->getDate()->format('M-d-Y') ?></h3>
        <a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a  class="trash" href="?controller=back&amp;action=deleteChapter&amp;id=<? echo $chapter->getId() ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    </div>
    <div class="panel-body">
        <h3><? echo $chapter->getTitle() ?></h3>
        <p><? echo $chapter->getContent() ?></p>
    </div>
</div>
<? } ?>