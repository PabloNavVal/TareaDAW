<?php
// Controlador para el modelo zonaModel 
class ZonasController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct(){
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los zonas almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/zonasModel.php';

        //Creamos una instancia de nuestro "modelo"
        $zonas = new ZonasModel();

        //Le pedimos al modelo todos los zonas
        $listado = $zonas->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['zonas'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarZonasView.php", $data);
    }


    // Método del controlador para crear un nuevo zona
    public function nuevo()
    {
        require 'models/zonasModel.php';
        $zona = new ZonasModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_ZONA']) || empty($_REQUEST['COD_ZONA']))
                $errores['COD_ZONA'] = "* Codigo: Error";
            if (!isset($_REQUEST['NOMBRE_ZONA']) || empty($_REQUEST['NOMBRE_ZONA']))
                $errores['NOMBRE_ZONA'] = "* Fecha: Error";



            if (empty($errores)) {
                $zona->setCOD_ZONA($_REQUEST['COD_ZONA']);
                $zona->setNOMBRE_ZONA($_REQUEST['NOMBRE_ZONA']);
                
                $zona->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=zonas&accion=listar");
            }
        }

        // Si no recibe el zona para añadir, devuelve la vista para añadir un nuevo zona
        $this->view->show("nuevoZonasView.php", array('errores' => $errores));



    }
    
    

    // Método que procesa la petición para editar un zona
    public function editar()
    {

        require 'models/zonasModel.php';
        $zonas = new ZonasModel();

        // Recuperar el zona con el código recibido
        $zona = $zonas->getById($_REQUEST['COD_ZONA']);

        if ($zona == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['COD_ZONA']) || empty($_REQUEST['COD_ZONA']))
                $errores['COD_ZONA'] = "* Codigo: Error";
            if (!isset($_REQUEST['NOMBRE_ZONA']) || empty($_REQUEST['NOMBRE_ZONA']))
                $errores['NOMBRE_ZONA'] = "* Nombre: Error";



            if (empty($errores)) {
                $zona->setCOD_ZONA($_REQUEST['COD_ZONA']);
                $zona->setNOMBRE_ZONA($_REQUEST['NOMBRE_ZONA']);
              
                $zona->edit();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=zonas&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el zona
        $this->view->show("editarZonasView.php", array('zonas' => $zona, 'errores' => $errores));



    }

    // Método para borrar un zona 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/zonasModel.php';

        //Creamos una instancia de nuestro "modelo"
        $zonas = new ZonasModel();

        // Recupera el zona con el código recibido por GET o por POST
        $zona = $zonas->getById($_REQUEST['COD_ZONA']);

        if ($zona == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $zona->delete();
            header("Location: index.php?controlador=zonas&accion=listar");
        }
    }

}
?>