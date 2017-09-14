<section class="row insertComment">
    <form action="" method="post" class="well col-sm-offset-2 col-sm-8 col-md-8 col-md-offset-2">
        <legend>Ajouter un commentaire</legend>
        <div class="form-group">
            <label for="pseudo">Pseudo : </label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="" maxlength="30" placeholder="Entrez votre pseudo de 30 caractères maximum." required>
        </div>
        <div class="form-group">
            <label for="commentContent">Contenu : </label>
            <textarea class="form-control" id="commentContent" rows="6" name="commentContent" value="" placeholder="Votre commentaire ici..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</section>
