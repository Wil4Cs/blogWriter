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
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Kaushan+Script|Chewy|Maven+Pro" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
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

<!-- Navigation
================================================== -->
<div class="container">
    <div class="row ">
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
                    <li><a class="accueil" href="/">Accueil</a></li>
                    <li class="dropdown"><a data-toggle="dropdown" href="">Chapitres<b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <? foreach ($chapters as $chapter) { ?>
                                <li><a href='?controller=front&amp;action=show&amp;id=<? echo $chapter->getId() ?>'>Chapitre <? echo $chapter->getNumber() ?></a></li>
                            <? } ?>
                        </ul>
                    </li>
                    <li><a href="/admin/">Admin</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- Section
================================================== -->
<? echo $content ?>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Javascript de Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>

