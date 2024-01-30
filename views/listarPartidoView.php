<!-- Vista para listar los registros de un determinado modelo -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listado de partidos</title>
</head>

<body>
    <table>
        <tr>
            <th>Codigo</th>
            <th>Fecha</th>
            <th>Equipo 1</th>
            <th>Equipo2</th>
            <th>Puntos Equipo 1</th>
            <th>Puntos Equipo 2</th>
        </tr>
        <?php
        foreach ($partidos as $partido) {
            ?>
            <tr>
                <td>
                    <?php echo $partido->getCOD_PARTIDO() ?>
                </td>
                <td>
                    <?php echo $partido->getFECHA() ?>
                </td>
                <td>
                    <?php echo $partido->getCOD_EQUIPO1() ?>
                </td>
                <td>
                    <?php echo $partido->getCOD_EQUIPO2() ?>
                </td>
                <td>
                    <?php echo $partido->getPUNTOS_EQUIPO1() ?>
                </td>
                <td>
                    <?php echo $partido->getPUNTOS_EQUIPO2() ?>
                </td>
                <td>
                    <a href="index.php?controlador=partido&accion=editar&COD_PARTIDO=<?php echo $partido->getCOD_PARTIDO() ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=partido&accion=borrar&COD_PARTIDO=<?php echo $partido->getCOD_PARTIDO() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="index.php?controlador=partido&accion=nuevo">Nuevo</a>
</body>

</html>