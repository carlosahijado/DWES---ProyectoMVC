<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Proyecto</title>

<link href="<?php echo URL_BASE?>/assets/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo URL_BASE?>/assets/css/all.min.css" rel="stylesheet" type="text/css">
<link
	href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
	rel='stylesheet' type='text/css'>

<link href="<?php echo URL_BASE?>/assets/css/clean-blog.css" rel="stylesheet">
<link href="<?php echo URL_BASE?>/assets/css/estilos.css" rel="stylesheet">

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top"
		id="mainNav">
		<div class="container">
			<a class="navbar-brand" href="<?php echo URL_BASE?>">Read Only</a>
			<button class="navbar-toggler navbar-toggler-right" type="button"
				data-toggle="collapse" data-target="#navbarResponsive"
				aria-controls="navbarResponsive" aria-expanded="false"
				aria-label="Toggle navigation">
				Menu <i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="<?php echo URL_BASE?>/libro/mostrar">Libros</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="<?php echo URL_BASE?>/user/registro">Registro</a></li>
				</ul>
			</div>
		</div>
		<?php
		if(!isset($_SESSION))
		{
		    session_start();
		}
		if(isset($_SESSION["usuario"])):?>
		
		<form class="form-inline my-2 my-lg-0 col-md-5 offset-md-3" action="<?php echo URL_BASE;?>/user/cerrarSesion" method="post">
			<h5 class="text-light"> <?php echo $_SESSION["usuario"]->getEmail()?></h5>
			<button class="btn btn-outline-light my-2 my-sm-0" name="btncerrar" type="submit">Cerrar
				Sesión</button>
		</form>
		<?php else:?>
		<form class="form-inline my-2 my-lg-0 col-md-5" action="<?php echo URL_BASE;?>/user/login" method="post">
			<input class="form-control mr-sm-2" name="email" type="email" placeholder="Correo"
				size="15" aria-label="Search"> <input class="form-control mr-sm-2"
				size="10" type="password" name="clave" placeholder="Contraseña"
				aria-label="Search">
			<button class="btn btn-outline-light my-2 my-sm-0" name="btnlogin" type="submit">Iniciar
				Sesión</button>
		</form>
		<?php endif?>
		
	</nav>