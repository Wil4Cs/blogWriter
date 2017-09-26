<h3 class="breadcrumbs">Add Chapter</h3>
<form action="?controller=back&amp;action=addChapter" method="post">
    <div class="input-group col-xs-6 col-xs-offset-3">
        <span class="input-group-addon"><i class="fa fa-address-book fa-fw"></i></span>
        <input type="text" class="form-control" name="chapterAuthor" value="" placeholder="Enter the author's name" required>
    </div>
    <div class="input-group col-xs-2 col-xs-offset-5">
        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc fa-fw"></i></span>
        <input type="text" class="form-control" name="chapterNumber" value="" placeholder="Enter the author's name" required>
    </div>
    <div class="input-group col-xs-6 col-xs-offset-3">
        <span class="input-group-addon"><i class="fa fa-address-book fa-fw"></i></span>
        <input type="text" class="form-control" name="chapterTitle" value="" placeholder="Enter the title" required>
    </div>
    <textarea id="summernote" name="chapterContent" value="" required></textarea>

    <div class="form-group col-xs-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<? if ($user->hasAlert()) echo'<p>'.$user->getAlert().'</p>' ?>