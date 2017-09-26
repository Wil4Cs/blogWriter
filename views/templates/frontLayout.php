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

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/front.css">
    <!-- Title -->
    <title>Billet simple pour l'Alaska</title>
  </head>

  <body id="frontend">

      <!-- Header
      ================================================== -->
      <header class="row">
        <div class="text-center col-md-3 col-md-offset-1"><h2>Billet simple pour</h2></div>
        <div class="col-md-4 text-center"><h1>l'Alaska</h1></div>
        <div class="col-md-3 text-center"><p>by Jean Forteroche</p></div>
        <? if(isset($carousel)) echo $carousel ?>
      </header>

      <!-- Navigation
      ================================================== -->
      <div class="front-page-content container">
        <div class="row">
          <nav class="navbar navbar-light" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="visible-xs navbar-brand"><img src="img/mountains.png" alt="Mountains"></a>
            </div>
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a class="accueil" href="./">Home</a></li>
                  <li class="dropdown"><a data-toggle="dropdown" href="">Chapters<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <? foreach ($chaptersList as $chapter) { ?>
                            <li><a href='?controller=front&amp;action=show&amp;id=<? echo $chapter->getId() ?>' aria-label="book"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Chapter <? echo $chapter->getChapterNumber() ?></a></li>
                        <? } ?>
                    </ul>
                  </li>
                <? if ($user->isAuthenticated()) { ?><li><a href="?controller=back&amp;action=index">Admin</a></li><? } ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>

      <!-- Section
      ================================================== -->
      <? echo $content ?>

      <!-- Footer
      ================================================== -->
      <footer class="container">
        <div class="row col-xs-6 col-xs-offset-3 col-md-offset-3 text-center socialIcons">
          <a class="btn btn-default" href="https://twitter.com" aria-label="Twitter">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a class="btn btn-default" href="https://www.facebook.com" aria-label="Facebook">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a class="btn btn-default" href="https://plus.google.com" aria-label="Google Plus">
            <i class="fa fa-google-plus" aria-hidden="true"></i>
          </a>
          <a class="btn btn-default" href="https://www.instagram.com" aria-label="Instagram">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
        </div>
        <div class="row pull-right backToTop">
          <a class="btn btn-default" href="#frontend" aria-label="Back to Top">
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
          </a>
        </div>
      </footer>

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <!-- Javascript de Bootstrap -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </body>
</html>
