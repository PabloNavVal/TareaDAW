<?php
    // se crea el modelo que gestionara los datos de la tabla jugadores
    class ZonasModel{
        // la propiedad db gestionara la conexsion con la base de datos
        protected $db;

        // se establecen los valores que guardaran los datos de la tabla
        protected $COD_ZONA;
        protected $NOMBRE_ZONA;

        // se establece el metodo constructor 
        public function __construct(){
            $this->db = SPDO::singleton();
        }
            
        // se establecen los getters y los setters para interactuar con las propiedades
        public function getCOD_ZONA(){
            return $this->COD_ZONA;
        }

        public function setCOD_ZONA($COD_ZONA){
            $this->COD_ZONA = $COD_ZONA;
            return $this;
        }

        public function getNOMBRE_ZONA(){
            return $this->NOMBRE_ZONA;
        }

        public function setNOMBRE_ZONA($NOMBRE_ZONA){
            $this->NOMBRE_ZONA = $NOMBRE_ZONA;
            return $this;
        }

        // se establece el metodo que devolvera cada fila de la tabla como un objeto independiente       
        public function getAll(){
            
            $consulta = $this->db->prepare('SELECT * FROM zonas');
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "zonasModel");

            return $resultado;
        }


        
        // se establecera el metodo para devolver un objeto concreto segun la clave primaria de la tabla
        public function getById($COD_ZONA)
        {
            $gsent = $this->db->prepare('SELECT * FROM zonas where COD_ZONA = ?');
            $gsent->bindParam(1, $COD_ZONA);
            $gsent->execute();

            $gsent->setFetchMode(PDO::FETCH_CLASS, "zonasModel");
            $resultado = $gsent->fetch();

            return $resultado;
        }
        // se establece un metodo para guardar una nueva fila en la tabla
        public function save(){

            // se establece la preconsulta
            $consulta = $this->db->prepare('INSERT INTO zonas ( COD_ZONA, NOMBRE_ZONA ) values ( ? ,?)');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->COD_ZONA);
            $consulta->bindParam(2, $this->NOMBRE_ZONA);
            // se ejecuta la sentencia
            $consulta->execute();
            
        }
        // se establece el metodo que editara las dilas existentes
        public function edit() {
            // se establece la preconsulta
            $consulta = $this->db->prepare('UPDATE zonas SET NOMBRE_ZONA = ? WHERE COD_ZONA =  ? ');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->NOMBRE_ZONA);
            $consulta->bindParam(2, $this->COD_ZONA);
            // se ejecuta la sentencia
            $consulta->execute();
        }
        // se establece el metodo para eliminar una fila de la tabla
        public function delete(){
            // se estabkece sentencia a ejecutar
            $consulta = $this->db->prepare('DELETE FROM  zonas WHERE COD_ZONA =  ?');
            // se indica la clave primaria a eliminar
            $consulta->bindParam(1, $this->COD_ZONA);
            // se ejecuta la sentencia
            $consulta->execute();
        }
    }
?>