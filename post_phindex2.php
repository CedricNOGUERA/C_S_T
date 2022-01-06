<?php session_start();

// Active tout les warning. Utile en phase de développement
	// En phase de production, remplacer E_ALL par 0
	error_reporting(E_ALL);
	
	// Inclus le fichier contenant les fonctions personalisées
	//in
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

  function get_ip() {
    // IP si internet partagé
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    return $_SERVER['HTTP_CLIENT_IP'];
    }
    // IP derrière un proxy
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Sinon : IP normale
    else {
    return (isset($_SERVER['REMOTE_ADDR']) ? gethostbyaddr($_SERVER['REMOTE_ADDR']) : '');
    }
    }
    // $ip_v = get_ip(); //IP Visiteur

    // echo ($_POST['id_prod']);


// identification USER
//
//

// if(null!==$_POST['email'] AND null!==$identif['passw']){


//   $identif = 'SELECT * FROM user WHERE id_user = \''.$_POST['email'].'\' AND password=\''.$_POST['passw'].'\'';
//   $identif = $dbco->query($identif);
//   //$tabl_commades = mysql_fetch_array($result);
//   $identif = $identif->fetch();


//   if(null!==$identif['id_user'] AND null!==$identif['password']){

//     header('Location: phindex2.php');
//       exit;

//   }
//   else {
//     $sql = 'INSERT INTO user (id_user,password,status) 
//               VALUES("'.$_POST['id_user'].'","'.$_POST['password'].'","1")';
      
//       /*on lance la commade
//       eton ajoute un msg erreur*/
//       $dbco->exec ($sql)or die ('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_connect_error());
    
//       header('Location: phindex2.php');
//       exit;

//   }
// }
//   $sql= $dbco->query('SELECT * from cde WHERE ip_client = "'.$_POST['email'].'"');
//   while ($rowss = $sql->fetch()){

// // echo ($rowss['produit_id'].'<br/>') ;
//   }
 
  if (ISSET ($_POST['id_prod'])){
    $name = $_POST['name_prod'];
    $price = $_POST['price_prod'];
    
    $pseudo = $_POST['pseudo'];
  
		
		$_POST['id_prod'] = htmlspecialchars($_POST['id_prod']);  //Conversion des données reçues en string pour éviter les injections
		$ancre= htmlspecialchars($_POST['id_prod']);
		
		//$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);// récupère ip du visiteur
		$hostname = get_ip();// récupère ip du visiteur
	
		$_SESSION['id_prod'][] = $_POST['id_prod']; // stock les ID des produits ds 1 tableau-session
		$id_prod[]=$_POST['id_prod'];


    $strrSQL = 'SELECT * FROM cde WHERE produit_id = \''.$_POST['id_prod'].'\' AND ip_client=\''.$pseudo.'\'';
    $result = $dbco->query($strrSQL);
    $tabl_commades = $result->fetch();
    

    // Gestion du stock
		$strSQL = 'SELECT * FROM produits WHERE id_prod = \''.$_POST['id_prod'].'\'';
    $resultat = $dbco->query($strSQL);
    $tabl_result = $resultat->fetch();



    
    if(isset($tabl_commades['produit_id'])){   //si produit deja dans la base 'commande' on augmente de 1 la qté et on sauvegarde le changement
      // gestion du Panier et de la commande	
        $tabl_commades['quantite']+= 1;
        $strrSQL = 'UPDATE cde SET quantite=\''.$tabl_commades['quantite'].'\'  WHERE produit_id = \''.$_POST['id_prod'].'\'AND ip_client=\''.$pseudo.'\'';
        $dbco->query ($strrSQL)or die ('Erreur SQL !<br/>'.$strrSQL.'<br/>'.mysqli_connect_error());
      // Gestion du stock

			$tabl_result['stock_prod']-= 1;
			$sttrSQL = 'UPDATE produits SET stock_prod=\''.$tabl_result['stock_prod'].'\'  WHERE id_prod = \''.$_POST['id_prod'].'\'';
			$dbco->query ($sttrSQL)or die ('Erreur SQL !<br/>'.$sttrSQL.'<br/>'.mysqli_connect_error());	
			header('Location: phindex2.php#'.$tabl_commades['produit_id'].'');
      exit;
		}
		else{ //sinon on ajoute en base
			
      $sql = 'INSERT INTO cde (ip_client,produit_id,quantite,date_cde,id_clt) 
              VALUES("'.$pseudo.'","'.$_POST['id_prod'].'","1",NOW(),"'.$pseudo.'")';
      
      /*on lance la commade
      eton ajoute un msg erreur*/
      $dbco->exec ($sql)or die ('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_connect_error());
    
    // Gestion du stock
      $strSQL = 'SELECT * FROM produits WHERE id_prod = \''.$_POST['id_prod'].'\'';
        $resultat = $dbco->query($strSQL);
        $tabl_result = $resultat->fetch();
  
        $tabl_result['stock_prod']-= 1;
        $sttrSQL = 'UPDATE produits SET stock_prod=\''.$tabl_result['stock_prod'].'\'  WHERE id_prod = \''.$_POST['id_prod'].'\'';
        $dbco->query ($sttrSQL)or die ('Erreur SQL !<br/>'.$sttrSQL.'<br/>'.mysqli_connect_error());	
      }
        header('Location: phindex2.php');
        exit;
      }

/*                                                */
/*                                                */  
/*          Suppression prouit du panier          */
/*                                                */
/*                                                */

      if (ISSET ($_POST['delete'])){      					

        if (ISSET ($_POST['delete'])){
          $chemin ="phindex2.php";
          // $ancre = $_POST['ancre'];
        }
        else{
          $chemin ="commande.php";
          $ancre = "";
          
        }
          
        


        $_POST['delete'] = htmlspecialchars($_POST['delete']);
        // $_POST['delete_2'] = htmlspecialchars($_POST['delete_2']);
        $_POST['id_del'] = htmlspecialchars($_POST['id_del']);	
        
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);           // récupère ip du visiteur
        
        $sstrSQL = 'SELECT * FROM cde WHERE produit_id = \''.$_POST['id_del'].'\' AND ip_client=\''.$_SESSION['pseudo'].'\'';
        $resultats = $dbco->query($sstrSQL);
        //$tabl_results = mysql_fetch_array($resultats);
        $tabl_results = $resultats->fetch();
        
        if($tabl_results['quantite'] == $_POST['delete']){ //vérif de qté à sup et de la qté en panier
        
          $strrSQL = 'DELETE FROM cde WHERE produit_id = \''.$_POST['id_del'].'\' AND ip_client=\''.$_SESSION['pseudo'].'\'';
          $result = $dbco->query($strrSQL);
          
          
          // Gestion du stock
          $strSQL = 'SELECT * FROM produits WHERE id_prod = \''.$_POST['id_del'].'\'';
          $resultat = $dbco->query($strSQL);
          $tabl_result = $resultat->fetch();
          
          $qte_erase = (ISSET($_POST['delete'])) ? $_POST['delete'] : $_POST['delete_2'];
          
          $tabl_result['stock_prod']+= $tabl_results['quantite'];    // on met le stock à jour
          $sttrSQL = 'UPDATE produits SET stock_prod=\''.$tabl_result['stock_prod'].'\'  WHERE id_prod = \''.$_POST['id_del'].'\'';
          $dbco->query ($sttrSQL)or die ('Erreur SQL !<br/>'.$sttrSQL.'<br/>'.mysqli_connect_error());			
        }
          
        
        //if (ISSET ($_GET['delete_2'])){
          //header('Location: index_beta_2.php#'.$_GET['ancre'] .'');exit;
          header('Location: '.$chemin.'');exit;
        //}
        //else{
          //header('Location: commande.php');exit;
          //header('Location: index_beta_2.php#'.$_GET['ancre'] .'');exit;
        //}
      }

    