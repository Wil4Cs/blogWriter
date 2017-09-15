<div class="container">
    <section class="row insertComment well">
        <form action="" method="post">
            <legend class="legInsCom">Ajouter un commentaire</legend>
            <div class="form-group col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <label for="pseudo">Pseudo : </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" value="" maxlength="30" placeholder="Entrez votre pseudo de 30 caractères maximum." required>
                </div>
            </div>
            <div class="form-group col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                <label for="commentContent">Contenu : </label>
                <textarea class="form-control" id="commentContent" rows="6" name="commentContent" value="" placeholder="Votre commentaire ici..." required></textarea>
            </div>
            <div class="form-group col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </section>
</div>