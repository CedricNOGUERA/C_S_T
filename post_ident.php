<?php session_start();
// Active tout les warning. Utile en phase de développement
	// En phase de production, remplacer E_ALL par 0
	error_reporting(E_ALL);
	
	// Inclus le fichier contenant les fonctions personalisées

            $servname = 'localhost';
            $dbname = 'test';
            $user = 'root';
            $pass = '';
try{
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }


// identification USER
//
//

if(null!==$_POST['pseudo']){


    $identif = 'SELECT * FROM user WHERE nom = \''.$_POST['pseudo'].'\' AND password=\''.$_POST['password'].'\'';
    $identif = $dbco->query($identif);
    //$tabl_commades = mysql_fetch_array($result);
    $identif = $identif->fetch();
  
  
    if(null!==$identif['nom'] AND null!==$identif['password']){

        $_SESSION['password']=$_POST['password']; // on stock l'email dans une variable Sesion afin qu'elle soit accessible partout
        $_SESSION['pseudo']=$_POST['pseudo']; 
      
        header('Location: phindex2.php');
       
        exit;
  
    }
    // elseif (){

    // }
    else {
      $sql = 'INSERT INTO user (password,nom,status,Date_connexion) 
                VALUES("'.$_POST['password'].'","'.$_POST['pseudo'].'","1",NOW())';
        
        /*on lance la commade
        eton ajoute un msg erreur*/
        $dbco->exec ($sql)or die ('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_connect_error());

                $_SESSION['password']=$_POST['password']; // on stock l'email dans une variable Sesion afin qu'elle soit accessible partout
                $_SESSION['pseudo']=$_POST['pseudo']; 

        header('Location: phindex2.php?pseudo='.$_SESSION['pseudo']);
        exit;
  
    }
  }
  // else{
  //   header('Location: identification.php?msg=1');
  //   exit;

  // }


