<?php
// Controlador para el modelo jugadorModel
class JugadorController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct(){
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los jugadores almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/jugadorModel.php';

        //Creamos una instancia de nuestro "modelo"
        $jugadores = new JugadorModel();

        //Le pedimos al modelo todos los jugadores
        $listado = $jugadores->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['jugadores'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarJugadorView.php", $data);
    }


    // Método del controlador para crear un nuevo jugador
    public function nuevo()
    {
        require 'models/jugadorModel.php';
        $jugador = new JugadorModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_JUGADOR']) || empty($_REQUEST['COD_JUGADOR']))
                $errores['COD_JUGADOR'] = "* Codigo: Error";
            if (!isset($_REQUEST['NOMBRE_JUGADOR']) || empty($_REQUEST['NOMBRE_JUGADOR']))
                $errores['NOMBRE_JUGADOR'] = "* Nombre: Error";
            if (!isset($_REQUEST['FECHA_NACIMIENTO']) || empty($_REQUEST['FECHA_NACIMIENTO']))
                $errores['FECHA_NACIMIENTO'] = "* Fecha: Error";
            if (!isset($_REQUEST['ESTATURA']) || empty($_REQUEST['ESTATURA']))
                $errores['ESTATURA'] = "* Estatura: Error";
            if (!isset($_REQUEST['POSICION']) || empty($_REQUEST['POSICION']))
                $errores['POSICION'] = "* Posicion: Error";
            if (!isset($_REQUEST['EQUIPO']) || empty($_REQUEST['EQUIPO']))
                $errores['EQUIPO'] = "* Equipo: Error";


            if (empty($errores)) {
                $jugador->setCOD_JUGADOR($_REQUEST['COD_JUGADOR']);
                $jugador->setNOMBRE_JUGADOR($_REQUEST['NOMBRE_JUGADOR']);
                $jugador->setFECHA_NACIMIENTO($_REQUEST['FECHA_NACIMIENTO']);
                $jugador->setESTATURA($_REQUEST['ESTATURA']);
                $jugador->setPOSICION($_REQUEST['POSICION']);
                $jugador->setEQUIPO($_REQUEST['EQUIPO']);
                $jugador->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=jugador&accion=listar");
            }
        }

        // Si no recibe el jugador para añadir, devuelve la vista para añadir un nuevo jugador
        $this->view->show("nuevoJugadorView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un jugador
    public function editar()
    {

        require 'models/jugadorModel.php';
        $jugadores = new JugadorModel();

        // Recuperar el jugador con el código recibido
        $jugador = $jugadores->getById($_REQUEST['COD_JUGADOR']);

        if ($jugador == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_JUGADOR']) || empty($_REQUEST['COD_JUGADOR']))
                $errores['COD_JUGADOR'] = "* Codigo: Error";
            if (!isset($_REQUEST['NOMBRE_JUGADOR']) || empty($_REQUEST['NOMBRE_JUGADOR']))
                $errores['NOMBRE_JUGADOR'] = "* Nombre: Error";
            if (!isset($_REQUEST['FECHA_NACIMIENTO']) || empty($_REQUEST['FECHA_NACIMIENTO']))
                $errores['FECHA_NACIMIENTO'] = "* Fecha: Error";
            if (!isset($_REQUEST['ESTATURA']) || empty($_REQUEST['ESTATURA']))
                $errores['ESTATURA'] = "* Estatura: Error";
            if (!isset($_REQUEST['POSICION']) || empty($_REQUEST['POSICION']))
                $errores['POSICION'] = "* Posicion: Error";
            if (!isset($_REQUEST['EQUIPO']) || empty($_REQUEST['EQUIPO']))
                $errores['EQUIPO'] = "* Equipo: Error";


            if (empty($errores)) {
                $jugador->setCOD_JUGADOR($_REQUEST['COD_JUGADOR']);
                $jugador->setNOMBRE_JUGADOR($_REQUEST['NOMBRE_JUGADOR']);
                $jugador->setFECHA_NACIMIENTO($_REQUEST['FECHA_NACIMIENTO']);
                $jugador->setESTATURA($_REQUEST['ESTATURA']);
                $jugador->setPOSICION($_REQUEST['POSICION']);
                $jugador->setEQUIPO($_REQUEST['EQUIPO']);
                $jugador->edit();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=jugador&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el jugador
        $this->view->show("editarJugadorView.php", array('jugador' => $jugador, 'errores' => $errores));



    }

    // Método para borrar un jugador 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/jugadorModel.php';

        //Creamos una instancia de nuestro "modelo"
        $jugadores = new JugadorModel();

        // Recupera el jugador con el código recibido por GET o por POST
        $jugador = $jugadores->getById($_REQUEST['COD_JUGADOR']);

        if ($jugador == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $jugador->delete();
            header("Location: index.php?controlador=jugador&accion=listar");
        }
    }

    // metodo para seleccionar el equipo del equipo mediante un select
    public static function  elegir(){
        // se llama al modelo requerido 
        require_once 'models/equipoModel.php';
        // se crea un nuevo objeto equipo
        $equipos = new EquipoModel();

        // se pediran todos los equipos
        $dato = $equipos->getAll();
            // se establece una opcion predeterminada con valor vacio
            echo "<option value=''>--Equipo--</option>";
            // se establece un bucle para mostrar todas las opciones
            foreach ($dato as $equipo) {
            $id = $equipo->getCOD_EQUIPO();
            $nombre = $equipo->getNOMBRE_EQUIPO();
            echo "<option value='$id'>$nombre</option>";
           
        } 
        
    }

}
?>