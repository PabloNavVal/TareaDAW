<!-- Vista para añadir un nuevo item a la tabla --> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuevo Jugador</title>
</head>

<body>
	<form action="index.php">
		<input type="hidden" name="controlador" value="jugador">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["COD_JUGADOR"]) ? "*" : "" ?>
		<label for="COD_JUGADOR">Codigo</label>
		<input type="number" name="COD_JUGADOR">
		</br>

		<?php echo isset($errores["NOMBRE_JUGADOR"]) ? "*" : "" ?>
		<label for="NOMBRE_JUGADOR">Nombre</label>
		<input type="text" name="NOMBRE_JUGADOR">
		</br>

		<?php echo isset($errores["FECHA_NACIMIENTO"]) ? "*" : "" ?>
		<label for="FECHA_NACIMIENTO">Fecha de nacimiento</label>
		<input type="date" name="FECHA_NACIMIENTO">
		</br>

		<?php echo isset($errores["ESTATURA"]) ? "*" : "" ?>
		<label for="ESTATURA">Estatura en cm</label>
		<input type="number" name="ESTATURA">
		</br>

		<?php echo isset($errores["POSICION"]) ? "*" : "" ?>
		<label for="POSICION">Posicion</label>
		<input type="text" name="POSICION">
		</br>

		<?php echo isset($errores["EQUIPO"]) ? "*" : "" ?>
		<label for="EQUIPO">Equipo</label>
		<select name="EQUIPO" id="EQUIPO">
			<?PHP JugadorController::elegir(); ?>
			</select>
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