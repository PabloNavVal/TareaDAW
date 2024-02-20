<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Microframework MVC - Modelo, Vista, Controlador</title>
</head>

<body>
	<form action="index.php">
		<input type="hidden" name="controlador" value="equipo">
		<input type="hidden" name="accion" value="editar">

		<label for="COD_EQUIPO">Codigo</label>
		<input type="text" name="COD_EQUIPO" value="<?php echo $equipo->getCOD_EQUIPO(); ?>">
		</br>

		<?php echo isset($errores["NOMBRE_EQUIPO"]) ? "*" : "" ?>
		<label for="NOMBRE_EQUIPO">Nombre del Equipo</label>
		<input type="text" name="NOMBRE_EQUIPO">
		</br>

		<?php echo isset($errores["PRESUPUESTO"]) ? "*" : "" ?>
		<label for="PRESUPUESTO">Presupuesto</label>
		<input type="number" name="PRESUPUESTO">
		</br>

		<?php echo isset($errores["FECHA_FUNDACION"]) ? "*" : "" ?>
		<label for="FECHA_FUNDACION">Fecha de fundacion</label>
		<input type="date" name="FECHA_FUNDACION">
		</br>

		<?php echo isset($errores["ZONA"]) ? "*" : "" ?>
		<label for="ZONA">Zona</label>
		<select name="ZONA" id="ZONA">
			<option value=''>--zona--</option>
			<?PHP EquipoController::elegir(); ?></select>
		</br>

		<?php echo isset($errores["TITULOS"]) ? "*" : "" ?>
		<label for="TITULOS">Titulos</label>
		<input type="number" name="TITULOS">
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