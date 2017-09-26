<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Kaushan+Script|Maven+Pro" rel="stylesheet">

        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

        <!-- Summernote CSS -->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/back.css">
        <!-- Title -->
        <title>Administration</title>
    </head>

    <body id="backend">

        <!-- Header
        ================================================== -->
        <header class="row">
            <div class="text-center col-md-3 col-md-offset-1"><h2>Billet simple pour</h2></div>
            <div class="col-md-4 text-center"><h1>l'Alaska</h1></div>
            <div class="col-md-3 text-center"><p>par Jean Forteroche</p></div>
        </header>

        <!-- Dashboard Header
        ================================================== -->
        <? if ($user->isAuthenticated()) { ?>
        <div class="container">
            <div class="page-title row">
                <h1 class="col-xs-12">DASHBOARD</h1>
            </div>
            <!-- Navigation
            ============================================== -->
            <div class="row nav-content">
                <nav class="nav col-xs-12 col-sm-2">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="nav">
                            <li><a href="?controller=back&action=index">Admin</a></li>
                            <li><a href="/">Accueil</a></li>
                            <li class="dropdown">
                                <a data-toggle="collapse" href="#item">Chapters<b class="caret"></b></a>
                                <div id="item" class="collapse">
                                    <? foreach ($chaptersList as $chapter) { ?>
                                    <p><a href="?controller=front&amp;action=show&amp;id=<? echo $chapter->getId() ?>" aria-label="book"<i class="fa fa-book" aria-hidden="true"></i>&nbsp;Chapter <? echo $chapter->getChapterNumber() ?></a></p>
                                    <? } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Section
                ================================================== -->
                <section class="col-xs-12 col-sm-10 page-content">
                    <div class="col-xs-12">
                        <h2 class="col-xs-8">Welcome Admin</h2>
                        <a class="log-out col-xs-4 log" href="?controller=back&amp;action=disconnect">Log-out&nbsp;<i class="fa fa-lg fa-sign-out" aria-hidden="true"></i></a>
                        <p class="col-xs-12">What would you like to do?</p>
                    </div>
                    <div class="link-buttons col-xs-12">
                        <div class="col-xs-3 col-sm-3 col-sm-offset-0 col-md-2"><button><a href="?controller=back&amp;action=addChapter"><i class="col-xs-12 fa fa-2x fa-pencil" aria-hidden="true"></i>Add Chapter</a></button></div>
                        <div class="col-xs-3 col-sm-3 col-sm-offset-0 col-md-2"><button><a href="?controller=back&amp;action=show"><i class="col-xs-12 fa fa-2x fa-pencil" aria-hidden="true"></i>All Chapters</a></button></div>
                        <div class="col-xs-3 col-sm-3 col-sm-offset-0 col-md-2"><button><a href="?controller=back&amp;action=moderateComment"><i class="col-xs-12 fa fa-2x fa-comments-o" aria-hidden="true"></i>Moderate Comment</a></button></div>
                    </div>
                    <? echo $content ?>
                </section>
            </div>
        </div>
        <? } else echo $content ?>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- Javascript de Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Javascript de Summernote -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    minHeight: 400
                });
            });
        </script>

    </body>
</html>

