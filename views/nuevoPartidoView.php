<!-- Vista para añadir un nuevo item a la tabla --> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuevo Jugador</title>
</head>

<body>
	<form action="index.php">
		<input type="hidden" name="controlador" value="partido">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["COD_PARTIDO"]) ? "*" : "" ?>
		<label for="COD_PARTIDO">Codigo</label>
		<input type="number" name="COD_PARTIDO">
		</br>

		<?php echo isset($errores["FECHA"]) ? "*" : "" ?>
		<label for="FECHA">Fecha</label>
		<input type="date" name="FECHA">
		</br>

		<?php echo isset($errores["COD_EQUIPO1"]) ? "*" : "" ?>
		<label for="COD_EQUIPO1">Equipo 1</label>
		<select name="COD_EQUIPO1" id="COD_EQUIPO1">
			<?PHP PartidoController::elegir(); ?>
		</select>
		</br>

		<?php echo isset($errores["COD_EQUIPO2"]) ? "*" : "" ?>
		<label for="COD_EQUIPO2">Equipo 2</label>
		<select name="COD_EQUIPO2" id="COD_EQUIPO2">
			<?PHP PartidoController::elegir(); ?>
			</select>
		</br>

		<?php echo isset($errores["PUNTOS_EQUIPO1"]) ? "*" : "" ?>
		<label for="PUNTOS_EQUIPO1">Puntos equipo 1</label>
		<input type="number" name="PUNTOS_EQUIPO1">
		</br>

		<?php echo isset($errores["PUNTOS_EQUIPO2"]) ? "*" : "" ?>
		<label for="PUNTOS_EQUIPO2">Puntos equipo 2</label>
		<input type="text" name="PUNTOS_EQUIPO2">
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