 <div class="navbar navbar-inverse">
	<ul class="nav navbar-nav">
		<li class="active"> <a href="<?= LINK ?>">Accueil</a> </li>
		<li> <a href="<?= LINK ?>pages/membres.php">Membres</a> </li>
		<li> <a href="<?= LINK ?>pages/cotisation.php">Cotisations</a> </li>
		<li> <a href="<?= LINK ?>pages/textes.php">Textes</a> </li>
	</ul>
	<ul class="nav navbar-nav pull-right">
	    <?php
	    //echo SERVER_URL
	    if (isset($_SESSION['auth'])) {
	    ?>
		<li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
		        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
		    </a>
		    <ul class="dropdown-menu dropdown-user pull-right">
		        <li><a href="<?= LINK ?>pages/profil.php"><i class="fa fa-user fa-fw"></i> Profil</a>
		        </li>
		        <li><a href="<?= LINK ?>pages/reglage.php"><i class="fa fa-gear fa-fw"></i> Réglagess</a>
		        </li>
		        <li class="divider"></li>
		        <li><a href="<?= LINK ?>connexion/deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
		        </li>
		    </ul>
		    <!-- /.dropdown-user -->
		</li>
	    <?php
	    }else{    
	    	//$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
	    	//echo '<li><a href="http:\\\\'.$_SERVER['SERVER_NAME'].'connexion/Connexion.php">Connexion</a></li>';
	    	echo '<li><a href="'.LINK.'connexion/connexion.php">Connexion</a></li>';
	    }
	    ?>
	</ul>
</div>