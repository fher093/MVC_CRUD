<html> 
	<head>  
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>		 
	</head> 
	
	<body>  
		<header>
			<img src="img/banner2.png" alt="baner">
		</header> 
		<nav>
			<ul>
				<li><a href="index.php?action=inicio">inicio</a></li>
				<li><a href="index.php?action=Nosotros">Nosotros</a></li>
				<li><a href="index.php?action=Servicios">Servicios</a></li>
				<li><a href="index.php?action=Contacto">Contacto</a></li>
			</ul>
		</nav>  
		
		<?php  
			require_once "controllers/controller.php";
			$mvc= new controllerMVC(); 
			$mvc->enlacesPaginasController();
		?>
	 
		<footer>
			<p>Derechos reservados 2024</p>	
		</footer>

	</body> 
	

</html> 