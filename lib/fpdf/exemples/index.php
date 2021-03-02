
<!DOCTYPE html>

<html>
<?php 
$bdd=new PDO('mysql: host=localhost;dbname=exposer','root','');
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="index.css" />
        <title>CLASSE FPDF</title>
    </head>
    <body>
    	<header>
                
               
    	</header>
            <nav id="menu">
                
                
            </nav>
    	
    	<div id="corps"><h1>ENREGISTREMENT ETUDIANT</h1>
      
        

                <form  action="index.php" method="post">
      <LABEL>Nom</LABEL><input  type="text" name="nom" placeholder="Nom  ">
      <LABEL>PreNom</LABEL><input  type="text" name="prenom" placeholder="Prenom  "><br>
                     <label>HOMME
                    <input type="radio" name="sexe" value="Homme">
                    </label>
                    <label>FEMME
                    <input type="radio" name="sexe" value="Femme">
                    </label>
      <LABEL>Amail</LABEL><input  type="text" name="email" placeholder="email  "><br>
      <LABEL>Age</LABEL><input  type="number" name="age" placeholder="age "><br>
      <LABEL>Lieu de naissance</LABEL><input  type="text" name="naissance" placeholder="Lieu de naissance  "><br>
      
      <label>Description</label><br><textarea name="description"></textarea>

       


      <input type="submit" name="bouton" value="VALIDER">


                </form><br> 
                <a href="fpdf2.php"><button  >IMPRIMER</button></a>
       
        <?php
                     
                      
                     
                      if (isset($_POST['nom'])) 
                      {
                        
                      echo $_POST['email'];
                         $id=0;
                        $reponce=$bdd->query('SELECT ID FROM exposer');
                         while ($donnee=$reponce->fetch()) 
                            {
                              $id=$id+1;//recuperation de lID DU DERNIER ENREGISTREMENT
                            }
                             
                        $id=(string)$id;
                        $MATRICULE='15Y5'.$id;
                        echo $MATRICULE;

                        $ajouter=$bdd->prepare('INSERT INTO exposer(ID,MATRICULE,NOM,PRENOM,SEXE,EMAIL,AGE,LIEUXNAISSANCE,DESCRIPTION) VALUES (NULL,?,?,?,?,?,?,?,?)');
                        $ajouter->execute(array($MATRICULE,$_POST['nom'],$_POST['prenom'],$_POST['sexe'],$_POST['email'],$_POST['age'],$_POST['naissance'],$_POST['description']));
                        



                     }


                    
        ?>

         </div>
    	
    	<footer>
                
                    <h1></h1></footer>
    	

    </body>
</html>

