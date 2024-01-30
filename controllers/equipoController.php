<?php
// Controlador para el modelo equipoModel
class EquipoController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct(){
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los equipos almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/equipoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $equipos = new EquipoModel();

        //Le pedimos al modelo todos los equipos
        $listado = $equipos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['equipos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarEquiposView.php", $data);
    }


    // Método del controlador para crear un nuevo equipo
    public function nuevo()
    {
        require 'models/equipoModel.php';
        $equipo = new EquipoModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_EQUIPO']) || empty($_REQUEST['COD_EQUIPO']))
                $errores['COD_EQUIPO'] = "* Codigo: Error";
            if (!isset($_REQUEST['NOMBRE_EQUIPO']) || empty($_REQUEST['NOMBRE_EQUIPO']))
                $errores['NOMBRE_EQUIPO'] = "* Nombre: Error";
            if (!isset($_REQUEST['PRESUPUESTO']) || empty($_REQUEST['PRESUPUESTO']))
                $errores['PRESUPUESTO'] = "* Presupuesto: Error";
            if (!isset($_REQUEST['FECHA_FUNDACION']) || empty($_REQUEST['FECHA_FUNDACION']))
                $errores['FECHA_FUNDACION'] = "* Fecha: Error";
            if (!isset($_REQUEST['ZONA']) || empty($_REQUEST['ZONA']))
                $errores['ZONA'] = "* Zona: Error";
            if (!isset($_REQUEST['TITULOS']) || empty($_REQUEST['TITULOS']))
                $errores['TITULOS'] = "* error: Error";


            if (empty($errores)) {
                $equipo->setCOD_EQUIPO($_REQUEST['COD_EQUIPO']);
                $equipo->setNOMBRE_EQUIPO($_REQUEST['NOMBRE_EQUIPO']);
                $equipo->setPRESUPUESTO($_REQUEST['PRESUPUESTO']);
                $equipo->setFECHA_FUNDACION($_REQUEST['FECHA_FUNDACION']);
                $equipo->setZONA($_REQUEST['ZONA']);
                $equipo->setTITULOS($_REQUEST['TITULOS']);
                $equipo->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=equipo&accion=listar");
            }
        }

        // Si no recibe el equipo para añadir, devuelve la vista para añadir un nuevo equipo
        $this->view->show("nuevoEquipoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un equipo
    public function editar()
    {

        require 'models/equipoModel.php';
        $equipos = new EquipoModel();

        // Recuperar el equipo con el código recibido
        $equipo = $equipos->getById($_REQUEST['COD_EQUIPO']);

        if ($equipo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

          
            if (!isset($_REQUEST['NOMBRE_EQUIPO']) || empty($_REQUEST['NOMBRE_EQUIPO']))
                $errores['NOMBRE_EQUIPO'] = "* Nombre: Error";
            if (!isset($_REQUEST['PRESUPUESTO']) || empty($_REQUEST['PRESUPUESTO']))
                $errores['PRESUPUESTO'] = "* Presupuesto: Error";
            if (!isset($_REQUEST['FECHA_FUNDACION']) || empty($_REQUEST['FECHA_FUNDACION']))
                $errores['FECHA_FUNDACION'] = "* Fecha: Error";
            if (!isset($_REQUEST['ZONA']) || empty($_REQUEST['ZONA']))
                $errores['ZONA'] = "* Zona: Error";
            if (!isset($_REQUEST['TITULOS']) || empty($_REQUEST['TITULOS']))
                $errores['TITULOS'] = "* error: Error";

            if (empty($errores)) {
                // Cambia el valor del equipo y lo guarda en BD
            
                $equipo->setNOMBRE_EQUIPO($_REQUEST['NOMBRE_EQUIPO']);
                $equipo->setPRESUPUESTO($_REQUEST['PRESUPUESTO']);
                $equipo->setFECHA_FUNDACION($_REQUEST['FECHA_FUNDACION']);
                $equipo->setZONA($_REQUEST['ZONA']);
                $equipo->setTITULOS($_REQUEST['TITULOS']);
                $equipo->edit();

                // Reenvía a la aplicación a la lista de equipos
                header("Location: index.php?controlador=equipo&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el equipo
        $this->view->show("editarEquipoView.php", array('equipo' => $equipo, 'errores' => $errores));



    }

    // Método para borrar un equipo 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/equipoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $equipos = new EquipoModel();

        // Recupera el equipo con el código recibido por GET o por POST
        $equipo = $equipos->getById($_REQUEST['codigo']);

        if ($equipo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $equipo->delete();
            header("Location: index.php?controlador=equipo&accion=listar");
        }
    }

    //metodo para ejegir  la zona de lequipo mediante un select
    public static function  elegir(){
        //llamamos al modelo correspondiente
        require_once 'models/zonasModel.php';
        //instanciamos un nuevo objeto
        $zonas = new ZonasModel();

       //cogemos todos los calores de la zona
        $dato = $zonas->getAll();
        //establecemos una opcion base con valor vacio
        echo "<option value=''>--zona--</option>";
        //mediante un bucle mostraremos todas las opciones
        foreach ($dato as $zona) {
            $id = $zona->getCOD_ZONA();
            $nombre = $zona->getNOMBRE_ZONA();
            echo "<option value='$id'>$nombre</option>";       
        }     
    }
}
?>