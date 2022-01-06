<?php
session_start();
// Active tout les warning. Utile en phase de développement
// En phase de production, remplacer E_ALL par 0
error_reporting(E_ALL);

// Inclus le fichier contenant les fonctions personalisées
//include ('mes_fonctions.php');
try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', $pdo_options);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>


<!DOCTYPE html>
<html>
<?php
// $mysqli = new mysqli("localhost", "root", "", "test");
// if ($mysqli->connect_errno) {
//     echo "Échec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
// }

// echo "$mysqli->host_info" . "\n";
//    $result=mysqli_query($mysqli, "SELECT * FROM produits");
//                             while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
//                                 printf("ID : %s  Nom : %s", $row["ID"], $row["name_prod"]);
//                              }

//                              mysqli_free_result($result);

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//   header("refresh: 1"); 

//   exit; 
?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bootsindex</title>

    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;500&display=swap" rel="stylesheet">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='mainBoost.css'>

</head>

<body>
    <div class="container-fluid p-0">

        <!--    NAVBAR     -->
        <?php include('navbar.php'); ?>
        <!--    NAVBAR     -->


      
                <div class="container-fluid">


                    <div class="row p-auto">
                        <!-- Menu -->



                        <div id="menu" class="col-sm-1  overflow-auto">

                            <div class="card border rounded-circle m-auto p-2">
                                <a href="phindex2.php">
                                    <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/36/000000/external-magnifying-glass-search-flatart-icons-outline-flatarticons-15.png" />
                                </a>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php">Recherhe</a></p>

                            <div class="card border rounded-circle m-auto p-2">
                                <buttton class="m-auto fs-2"> <i class="fa-solid fa-bars"></i></i></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4">Formules</p>

                            <div class="card border rounded-circle m-auto p-2" style="background-color: #98A340;">
                                <a class="m-auto fs-2" href="phindex2.php?categorie_prod=Entrees" style="color: #FFF"> EN</a>

                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Entrees">Entrées</a></p>

                            <div class="card border rounded-circle m-auto p-2" style="background-color: #cc7171;">
                                <buttton class="m-auto fs-2"><a href="phindex2.php?categorie_prod=Plats" style="color: #FFF"> Pl</a></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Plats">Plats</a></p>

                            <div class="card border rounded-circle m-auto p-2" style="background-color: #26b144;">
                                <buttton class="m-auto fs-2" style="color:  #FFF"><a href="phindex2.php?categorie_prod=Salades" style="color: #FFF">Sa</a></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Salades">Salades</a></p>

                            <div class="card border rounded-circle m-auto p-2" style="background-color: #2672b1;">
                                <buttton class="m-auto fs-2" style="color:  #FFF"><a href="phindex2.php?categorie_prod=Eaux" style="color: #FFF">Ea</a></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Eaux">Eaux</a></p>

                            <div class="card border rounded-circle m-auto p-2" style="background-color: #98A340;">
                                <buttton class="m-auto fs-2" style="color:  #FFF"><a href="phindex2.php?categorie_prod=Vins" style="color: #FFF">Vi</a></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Vins">Vins</a></p>
                            <div class="card border rounded-circle m-auto p-2" style="background-color: #98A340;">
                                <buttton class="m-auto fs-2" style="color:  #FFF"><a href="phindex2.php?categorie_prod=Sodas" style="color: #FFF">So</a></buttton>
                            </div>
                            <p class="text-center mb-2 fs-4"><a href="phindex2.php?categorie_prod=Sodas">Sodas</a></p>



                        </div>

                        <!-- Partie centrale -->
                        <div id="contenu" class="col ">
                            <div class="row">

                                <?php
                                if (isset($_GET['categorie_prod'])) {
                                    $result = 'SELECT * FROM produits WHERE categorie_prod = "' . $_GET['categorie_prod'] . '"';
                                } else {
                                    $result = 'SELECT * FROM produits';
                                }
                                $result = $bdd->query($result);
                                while ($row = $result->fetch()) {

                                ?>

                                    <div class="me-3 mb-3 card ">
                                        <div class="card-body px-0">
                                            <h5 class="card-title"><?php echo ($row["name_prod"]); ?></h5>
                                            <div>
                                                <form action="post_phindex2.php" method="post">
                                                    <input name="name_prod" type="hidden" value="<?php echo ($row["name_prod"]); ?>" />
                                                    <input name="id_prod" type="hidden" value="<?php echo ($row["id_prod"]); ?>" />
                                                    <input name="price_prod" type="hidden" value="<?php echo ($row["price_prod"]); ?>" />
                                                    <input name="pseudo" type="hidden" value="<?php echo ($_SESSION['pseudo']); ?>" />

                                                    <input class="achat border" type="submit" value="" />
                                                </form>
                                            </div>
                                            <p class="pt-5"><?php echo ($row["price_prod"]); ?> xpf</p>

                                        </div>
                                    </div>
                                <?php
                                }



                                // // echo 'L\'adresse IP de l utilisateur est : '.getIp(); 
                                // // echo $_SERVER['REMOTE_ADDR'];
                                // echo $_SESSION['email'];
                                // if(null!==$_SESSION['pseudo']){

                                // echo $_SESSION['pseudo'];
                                // }



                                ?>


                            </div>
                        </div>

                        <!-- Partie de gauche - ticket -->
                        <div id="right_ticket" class="col-4 bg-white p-0">
                            <div class="card-header" style="width:100%">
                                <h4 class="card-title text-center my-2">Ticket</h4>
                            </div>
                            <?php

                            $sommes = 0;

                            $result = 'SELECT p.id_prod, p.name_prod, p.price_prod, c.quantite
                                    FROM  cde c
                                    INNER JOIN produits p 
                                    ON c.produit_id = p.id_prod
                                    WHERE c.ip_client = "' . $_SESSION['pseudo'] . '"
                                    ORDER BY c.id ASC';



                            $result = $bdd->query($result);

                            //   var_dump($result->fetchAll());



                            while ($row = $result->fetch()) {
                                // $id_prod=$row['id_prod'];
                                // $qte_cde=$row['quantite'];
                                // var_dump($row);

                                $m = " ";
                                $price_prod = number_format($row["price_prod"], $decimals = 0, $dec_point = ".", $m = " ");
                                $sommes_art = $row["price_prod"] * $row["quantite"];
                                $sommes += $row['price_prod'] * $row['quantite'];

                            ?> <div class="container bg-white mt-1">
                                    <div class="ticket row row-cols-sm">
                                        <div class="col-1 d-cols-sm-2 pe-0"><?php echo $row["quantite"] ?> X</div>
                                        <div class="col-7 pe-0"><?php echo $row["name_prod"] . '-' . $price_prod . ' xpf' ?></div>
                                        <div class="col-3 pe-0 text-end"><?php echo (number_format($sommes_art, $decimals = 0, $dec_point = ".", $m = " ")) ?> xpf</div>
                                        <div class="cross col-1">

                                            <form action="post_phindex2.php" method="post">
                                                <input name="id_del" type="hidden" value="<?php echo ($row["id_prod"]); ?>" />
                                                <input name="delete" type="hidden" value="<?php echo ($row["quantite"]); ?>" />
                                                <input name="pseudo" type="hidden" value="<?php echo ($_SESSION['pseudo']); ?>" />

                                                <!-- <input type="submit" value="Buy" /> -->
                                                <!-- <i type="submit" class="fa-solid fa-xmark"><input type="submit" value="X" /></i> -->
                                                <!-- <i type="submit" class="fa-solid fa-xmark"></i> -->
                                                <!-- <input type="image" src="https://img.icons8.com/metro/15/000000/cancel.png" value="" class="pt-1" /> -->
                                                <!-- <button class="subm" type="submit"></button> -->
                                                <button type="submit" class="subm btn-close text-rest " aria-labl="Fermer"></button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            $sommes = number_format($sommes, $decimals = 0, $dec_point = ".", $m = " ");

                            ?>



                            <div id="total_ticket" class="container-fluid card px-0">
                                <div class="card-body">
                                    <div class="row row-cols-auto">

                                        <h4 style="width: 70%">Total</h4>

                                        <h4> <?php echo $sommes; ?>xpf</h4>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cols-auto">

                                        <h4 style="width: 70%">Total</h4>

                                        <h4> <?php echo $sommes; ?>xpf</h4>
                                        <p></p>
                                    </div>
                                </div>

                            </div>
                            <div id="icon-paiement" class="mx-5">
                                <a href="reglement.php"><img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/56/000000/external-money-business-kiranshastry-lineal-kiranshastry.png" /></a>
                                <img onclick="on()" src="https://img.icons8.com/ios/50/000000/bank-card-back-side.png" />
                            </div>
                        </div>
                    </div>
                </div>
           
    </div>
    </div>
    </div>
    <div id="overlay" onclick="off()">
        <div class="container" style="width:60%;">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h2 class="alert alert-success"> Paiement par Carte Bancaire</h2>
                            Saisissez votre code afin de régler vos achats
                            <p class="text-center fs-1"> <?php
                                                            echo $sommes;
                                                            ?>
                                xpf
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        console.log()

        function on() {
            document.getElementById("overlay").style.display = "block";
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>

</html>