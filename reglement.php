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
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Règlemment</title>

	<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;500&display=swap" rel="stylesheet">
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<link rel='stylesheet' type='text/css' media='screen' href='mainBoost.css'>
	<!-- <meta http-equiv="refresh" content="900;url=identification.php" /> -->
</head>

<body class="overflow-hidden">


	<div class="container-fluid p-0">
		<!--    NAVBAR     -->
		<?php include('navbar.php'); ?>
		<!--    NAVBAR     -->

		<!-- partie de gauche-->
		<div class="row px-4">
			<div id="right_ticket" class="bg-white px-0">
				<div class="card-header">
					<h5 class="card-title text-center my-2">Ticket</h5>
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
						<div class="ticket row row-cols-auto">
							<div class="col-1 d-cols-sm-2 pe-0"><?php echo $row["quantite"] ?> X</div>
							<div class="col-7 pe-0"><?php echo $row["name_prod"] . '-' . $price_prod . ' xpf' ?></div>
							<div class="col-3 pe-0 text-end"><?php echo (number_format($sommes_art, $decimals = 0, $dec_point = ".", $m = " ")) ?> xpf</div>
							<div class="cross col-1">
								<form action="post_phindex2.php" method="post">
									<input name="id_del" type="hidden" value="<?php echo ($row["id_prod"]); ?>" />
									<input name="delete" type="hidden" value="<?php echo ($row["quantite"]); ?>" />
									<input name="email" type="hidden" value="<?php echo ($_SESSION['email']); ?>" />

									<!-- <input type="submit" value="Buy" /> -->
									<!-- <i type="submit" class="fa-solid fa-xmark"><input type="submit" value="X" /></i> -->
									<!-- <i type="submit" class="fa-solid fa-xmark"></i> -->
									<!-- <input type="image" src="https://img.icons8.com/metro/15/000000/cancel.png" value="" class="pt-1" /> -->
									<button type="submit" class="subm btn-close text-rest " aria-labl="Fermer"></button>
								</form>

							</div>
						</div>
					</div>
				<?php
				}

				?>
				<div id="total_ticket" class="container-fluid card px-0">
					<div class="card-body">
						<div id="calTop" class="row  border-bottom mb-2">
							<div class="col-4 border-end">
								<div>A PAYER </div>
								<div class="cdeL text-success">14.00Xpf</div>
							</div>
							<div class="col-8 ps-3">
								<div>PAIEMENT </div>
								<div class="cdeL text-primary">13.00Xpf</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row row-cols-auto">

							<h4 style="width: 70%">Total</h4>

							<h4> <?php echo $sommes; ?>xpf</h4>
							<p></p>
						</div>
					</div>
				</div> <!-- end #total_ticket-->

			</div>
			<!--end #left_ticket-->

			<!--end partie de ticket-->


			<!-- Partie Centrale-->
			<div class="card ms-1 p-0" style="width:43%">
				<div class="card-body ">

					<div id="calTop" class="row  border-bottom mb-2">
						<div class="col-4 border-end">
							<div>A PAYER </div>
							<div class="cdeL">14.00Xpf</div>
						</div>
						<div class="col-8 ps-3">
							<div>PAIEMENT </div>
							<div class="cdeL">13.00Xpf</div>
						</div>
					</div>
					<div class="container-lg p-0 fs-3">
						<div class="row row-cols-3 row-cols-lg-3 g-0 g-lg-0 m-auto">
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">1</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">2</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">3</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">4</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">5</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">6</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">7</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">8</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">9</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">0</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;">.</div>
							</div>
							<div class="col">
								<div class="pt-4 border bg-light text-center" style="height:11vh;"><i class="far fa-arrow-alt-circle-right"></i></div>
							</div>
						</div>
					</div>
					<div class="container bg-dark p-0 ps-1 mt-1 text-white text-center">
						<!-- <div class="row">
							<div id="encaiss" class="text-white col-12">
								<div class="container bg-dark">
									<div class="center"> -->
						<span class="encaisser"> Encaisser</span>
						<!-- </div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>

			<!-- partie de droite -->

			<div class="card bg-dark ms-1 px-0 border border-none " style="width: 26%;">
				<div id="mPaiement" class="card-header mb-2">
					<h5 class="card-title text-center my-2">Moyen de paiement</h5>
				</div>
				<div class="container">

					<ul>
						<li>
							<div class="col-12">
								<div class="row">

									<i class="far fa-money-bill-alt fa-2x me-2 col-2"></i>
									<div class="col-6 m-0">
										<h4>Espèces</h4>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="col-12">
								<div class="row">

									<i class="fas fa-credit-card fa-2x me-2 col-2"></i>
									<div class="col-6 m-0">
										<h4>Carte Bancaire</h4>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="col-12">
								<div class="row">

									<i class="fab fa-bitcoin fa-2x me-2 col-2"></i>
									<div class="col-6 m-0">
										<h4>Bitcoin</h4>
									</div>
								</div>
							</div>
						</li>



						<li>
							<div class="col-12">
								<div class="row">

									<i class="fas fa-bone fa-2x me-2 col-2"></i>
									<div class="col-6 m-0">
										<h4>Bonecoin</h4>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</div>
			</div>
		</div>


	</div>





	</div>



</body>

</html>