<!-- Vista para añadir un nuevo item a la tabla --> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuevo zona</title>
</head>

<body>
	<form action="index.php">
		<input type="hidden" name="controlador" value="zonas">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["COD_ZONA"]) ? "*" : "" ?>
		<label for="COD_ZONA">Codigo</label>
		<input type="number" name="COD_ZONA">
		</br>

		<?php echo isset($errores["NOMBRE_ZONA"]) ? "*" : "" ?>
		<label for="NOMBRE_ZONA">Nombre</label>
		<input type="text" name="NOMBRE_ZONA">
		</br>

		<input type="submit" name="submit" value="Aceptar">
	</form>
	</br>
	<?php
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>