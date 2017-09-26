<div class="col-xs-12 panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">Edit The Comment</h3>
    </div>
    <div class="panel-body">
        <form action="?controller=front&amp;action=comment" method="post">
            <div class="form-group col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <label for="pseudo">Pseudo : </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" value="<? echo $comment->getAuthor() ?>" maxlength="30" pattern=".{3,}" placeholder="" autofocus required>
                </div>
            </div>
            <div class="form-group col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                <label for="commentContent">Contenu : </label>
                <textarea class="form-control" id="commentContent" rows="6" name="commentContent" placeholder="" required><? echo $comment->getContent() ?></textarea>
            </div>
            <div class="form-group col-sm-12 col-md-offset-1 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <input type="hidden" name="id" value="<? echo $comment->getId() ?>">
                <input type="hidden" name="chapter" value="<? echo $comment->getChapterNumber() ?>">
            </div>
        </form>
    </div>
</div>