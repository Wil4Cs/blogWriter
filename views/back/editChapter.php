<h3 class="breadcrumbs">Add Chapter</h3>
<form action="?controller=back&amp;action=editChapter" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-xs-6">
            <label for="author">Author :</label>
            <input type="text" class="form-control" id="author" name="chapterAuthor" value="<? echo $chapter->getAuthor() ?>" placeholder="Enter the author's name" required>
        </div>
        <div class="form-group col-xs-6">
            <label for="title">Title :</label>
            <input type="text" class="form-control" id="title" name="chapterTitle" value="<? echo $chapter->getTitle() ?>" placeholder="Enter the title" required>
        </div>
        <div class="form-group col-xs-6 col-md-4">
            <label for="chapterNumber">Chapter's number :</label>
            <input type="text" class="form-control" id="chapterNumber" name="chapterNumber" value="<? echo $chapter->getChapterNumber() ?>" placeholder="Enter the chapter's number" required>
        </div>

        <? if ($user->hasAlert()) echo'<p class="col-xs-12 text-danger">'.$user->getAlert().'</p>' ?>
    </div>
    <textarea id="summernote" name="chapterContent" value="" required><? echo $chapter->getContent() ?></textarea>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <input type="hidden" name="id" value="<? echo $chapter->getId() ?>">
</form>