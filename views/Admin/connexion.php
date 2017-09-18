<h2>Connexion</h2>
<form action="" method="post">
    <label>Pseudo</label>
    <input type="text" name="login" /><br />

    <label>Mot de passe</label>
    <input type="password" name="password" /><br /><br />

    <input type="submit" value="connexion" />
    <? if ($this->_admin->hasAlert()) echo '<p>' .$this->_admin->getAlert(). '</p>' ?>
</form>