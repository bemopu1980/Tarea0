<?php  
		if(isset($_GET['id'])){
			$ID=$_GET['id'];
			$_SESSION['id']=$ID;
		}else{
			if(isset($_SESSION['id'])){
				$ID=$_SESSION['id'];
			}else{
				$ID=1;//header location: index.php
			}
		} 
    
		require_once('conexion.php');

		$detalle = "SELECT worker.NAME,worker.PICTURE,worker.EMAIL,worker.PHONE,worker.SALARY,worker.ABOUT,worker.ID,country.COUNTRY
		FROM worker JOIN COUNTRY 
        ON worker.COUNTRY=COUNTRY.ID
        WHERE worker.ID=".$ID;
		$detalle_result = $conn->query($detalle);
		$detalle_rows = $detalle_result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
						<thead>
							<tr class="table100-head">
								<th class="column1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="column1"> 
									<table>
										<tbody>
											<tr>
											  <th class="column1"><?php echo $detalle_rows['NAME'] ?></th>
											</tr>
											<tr>
											   <td class="column1"><img src=images/photo/<?php echo $detalle_rows['PICTURE']?> class="profileimg"></td>
											</tr>
											<tr>
												<td class="column1"><?php echo 'Email: '.$detalle_rows['EMAIL']?></td>
											</tr>
											<tr>
												<td class="column1"><?php echo 'Phone: '.$detalle_rows['PHONE']?></td>
											</tr>
											<tr>
												<td class="column1"><?php echo 'Country: '.$detalle_rows['COUNTRY']?></td>
											</tr>
											<tr>
												<td class="column1"><?php echo 'Salary: '.$detalle_rows['SALARY'] . ' € '?></td>
										   </tr>
										   <tr>
										   <td>
											<?php
													$language="SELECT language.language
													FROM worker
													INNER JOIN language_worker
													ON worker.ID=language_worker.id_worker
													INNER JOIN language 
													ON language_worker.id_language=language.ID WHERE worker.ID=".$ID;
									
													$language_result = $conn->query($language);
														if($language_result->num_rows>0){
															echo '&nbsp  &nbsp &nbsp &nbsp   <class="column1"> Idiomas: &nbsp;';
															while($language_rows = $language_result->fetch_assoc()){
																
															echo '<img src="images/icons/'.$language_rows['language'].'.png" title="'.$language_rows['language'].'">&nbsp;';
														}
													}
												?> 
											</td>
											</tr>
												
											<tr>
											<td>
											<?php	
											$skills="SELECT skills.skill 
											FROM worker
											INNER JOIN skills_worker
											  ON worker.ID=skills_worker.id_worker
											INNER JOIN skills 
											  ON skills_worker.id_skills=skills.ID WHERE worker.ID=".$ID;
										
											$skills_result = $conn->query($skills);
												if($skills_result->num_rows>0){
													echo '&nbsp  &nbsp &nbsp &nbsp   <class="column1">Habilidades: &nbsp;';	
													while($skills_rows = $skills_result->fetch_assoc()){	
												
													echo '<img src="images/icons/'.$skills_rows['skill'].'.png" title="'.$skills_rows['skill'].'">&nbsp;';
														 
													}
												}
											?>
											</td>
										    </tr>
											<tr>
												<td colspan="2" class="column1">
													<p> <?php echo 'Resumen: ' .$detalle_rows['ABOUT']?></p>
													<p></p>
												</td>
											</tr>
											<tr>
												<td colspan="2" class="column1"><a href="index.php">Volver a la lista</a></td>
							                </tr>
										</tbody>
									</table>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>

<?php

$conn->close();

?>