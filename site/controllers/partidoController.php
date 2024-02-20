<?php
// Controlador para el modelo  partidoModel
class PartidoController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct(){
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los partidos almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/partidoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $partidos = new PartidoModel();

        //Le pedimos al modelo todos los items
        $listado = $partidos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['partidos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarPartidoView.php", $data);
    }


    // Método del controlador para crear un nuevo partido
    public function nuevo()
    {
        require 'models/partidoModel.php';
        $partido = new PartidoModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        //mediante estos if nos aseguraremos de que los datos se introduzcan completamente
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_PARTIDO']) || empty($_REQUEST['COD_PARTIDO']))
                $errores['COD_PARTIDO'] = "* Codigo: Error";
            if (!isset($_REQUEST['FECHA']) || empty($_REQUEST['FECHA']))
                $errores['FECHA'] = "* Fecha: Error";
            if (!isset($_REQUEST['COD_EQUIPO1']) || empty($_REQUEST['COD_EQUIPO1']))
                $errores['COD_EQUIPO1'] = "* Codigo equipo 1: Error";
            if (!isset($_REQUEST['COD_EQUIPO2']) || empty($_REQUEST['COD_EQUIPO2']))
                $errores['COD_EQUIPO2'] = "* Codigo equipo 2: Error";
            if (!isset($_REQUEST['PUNTOS_EQUIPO1']) || empty($_REQUEST['PUNTOS_EQUIPO1']))
                $errores['PUNTOS_EQUIPO1'] = "* Puntos equipo 1: Error";           
            if (!isset($_REQUEST['PUNTOS_EQUIPO2']) || empty($_REQUEST['PUNTOS_EQUIPO2']))
                $errores['PUNTOS_EQUIPO2'] = "* Puntos equipo 2: Error";
            //en el caso de este if nos aseguraremos de que no coincida el mismo equipo para un partido
            if ($_REQUEST['COD_EQUIPO1'] == $_REQUEST['COD_EQUIPO2'])
                $errores['repetido'] = "* Se ha seleccionado el mismo equipo dos veces";

            if (empty($errores)) {
                $partido->setCOD_PARTIDO($_REQUEST['COD_PARTIDO']);
                $partido->setFECHA($_REQUEST['FECHA']);
                $partido->setCOD_EQUIPO1($_REQUEST['COD_EQUIPO1']);
                $partido->setCOD_EQUIPO2($_REQUEST['COD_EQUIPO2']);
                $partido->setPUNTOS_EQUIPO1($_REQUEST['PUNTOS_EQUIPO1']);
                $partido->setPUNTOS_EQUIPO2($_REQUEST['PUNTOS_EQUIPO2']);
                $partido->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=partido&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo partido
        $this->view->show("nuevoPartidoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un partido
    public function editar()
    {

        require 'models/partidoModel.php';
        $partidoes = new PartidoModel();

        // Recuperar el item con el código recibido
        $partido = $partidoes->getById($_REQUEST['COD_PARTIDO']);

        if ($partido == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // como en el caso de la creacion de un nuevo elemento se compruevan los errores
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_PARTIDO']) || empty($_REQUEST['COD_PARTIDO']))
                $errores['COD_PARTIDO'] = "* Codigo: Error";
            if (!isset($_REQUEST['FECHA']) || empty($_REQUEST['FECHA']))
                $errores['FECHA'] = "* Fecha: Error";
            if (!isset($_REQUEST['COD_EQUIPO1']) || empty($_REQUEST['COD_EQUIPO1']))
                $errores['COD_EQUIPO1'] = "* Equipo 1: Error";
            if (!isset($_REQUEST['COD_EQUIPO2']) || empty($_REQUEST['COD_EQUIPO2']))
                $errores['COD_EQUIPO2'] = "* Equipo 2: Error"; 
            if (!isset($_REQUEST['PUNTOS_EQUIPO1']) || empty($_REQUEST['PUNTOS_EQUIPO1']))
                $errores['PUNTOS_EQUIPO1'] = "* Puntos equipo 1: Error";
            if (!isset($_REQUEST['PUNTOS_EQUIPO2']) || empty($_REQUEST['PUNTOS_EQUIPO2']))
                $errores['PUNTOS_EQUIPO2'] = "* Puntos equipo 2: Error";
            if ($_REQUEST['COD_EQUIPO1'] == $_REQUEST['COD_EQUIPO2'])
                $errores['repetido'] = "* Se ha seleccionado el mismo equipo dos veces";
           

            if (empty($errores)) {
                $partido->setCOD_PARTIDO($_REQUEST['COD_PARTIDO']);
                $partido->setFECHA($_REQUEST['FECHA']);
                $partido->setCOD_EQUIPO1($_REQUEST['COD_EQUIPO1']);
                $partido->setCOD_EQUIPO2($_REQUEST['COD_EQUIPO2']);
                $partido->setPUNTOS_EQUIPO1($_REQUEST['PUNTOS_EQUIPO1']);
                $partido->setPUNTOS_EQUIPO2($_REQUEST['PUNTOS_EQUIPO2']);
                $partido->edit();

                header("Location: index.php?controlador=partido&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el partido
        $this->view->show("editarPartidoView.php", array('partido' => $partido, 'errores' => $errores));



    }

    // Método para borrar un partido 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/partidoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $partidoes = new PartidoModel();

        // Recupera el item con el código recibido por GET o por POST
        $partido = $partidoes->getById($_REQUEST['COD_PARTIDO']);

        if ($partido == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $partido->delete();
            header("Location: index.php?controlador=partido&accion=listar");
        }
    }
    //funcion para poder elegir los equipos del partido mediante un select
    public static function  elegir(){
        //se requerira el modelo correspondiente
        require_once 'models/equipoModel.php';
        //se creara un nuevo objeto 
        $equipos = new EquipoModel();

        //solicitaremos todos los elementos
        $dato = $equipos->getAll();
        //se mostrara una opcion por defecto de valor vacio
        echo "<option value=''>--Equipo--</option>";
        //mediante un bucle se ira seleccionando todos los elementos
        foreach ($dato as $equipo) {
            $id = $equipo->getCOD_EQUIPO();
            $nombre = $equipo->getNOMBRE_EQUIPO();
            echo "<option value='$id'>$nombre</option>";
        }  
    }
}
?>