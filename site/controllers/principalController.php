<?php
// establezcon una clase principal para que se acceda directamente a una pagina para elegir 
// a que listado se va a acceder
    class PrincipalController{    
        // se setablece una atributo view con su constructor para usar luego su metodo show()
        protected $view;

        function __construct(){
            $this->view = new View();
        }

        public function pagina(){
            $this->view->show("PrincipalView.php");
        }
    }
?>