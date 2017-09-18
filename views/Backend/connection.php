<div class="container">
    <section class="connection row well">
        <form action="" method="post">
            <legend class="legendConnection">Administration</legend>
            <? if ($this->_admin->hasAlert()) echo '<div class="col-xs-12 has-error"><span class="help-block">' .$this->_admin->getAlert(). '</span></div>' ?>
            <div class="form-group col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input type="text" class="form-control" name="login" value="" placeholder="Enter your login" autofocus required>
                </div>
            </div>
            <div class="form-group col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                    <input type="password" class="form-control" name="password" value="" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary">Connection</button>
            </div>
        </form>
    </section>
</div>
