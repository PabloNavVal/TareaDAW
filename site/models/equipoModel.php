<?php
    // se crea el modelo que gestionara los datos de la tabla equipos
    class EquipoModel{
        // la propiedad db gestionara la conexsion con la base de datos
        protected $db;
        // se establecen los valores que guardaran los datos de la tabla
        protected $COD_EQUIPO;
        protected $NOMBRE_EQUIPO;
        protected $PRESUPUESTO;
        protected $FECHA_FUNDACION;
        protected $ZONA;
        protected $TITULOS;
        
        // se establece el metodo constructor 
        public function __construct(){
            $this->db = SPDO::singleton();
        }

        // se establecen los getters y los setters para interactuar con las propiedades
        public function getCOD_EQUIPO(){
            return $this->COD_EQUIPO;
        }
        public function setCOD_EQUIPO($COD_EQUIPO){
            $this->COD_EQUIPO = $COD_EQUIPO;
            return $this;
        }
        public function getNOMBRE_EQUIPO(){
            return $this->NOMBRE_EQUIPO;
        }
        public function setNOMBRE_EQUIPO($NOMBRE_EQUIPO){
            $this->NOMBRE_EQUIPO = $NOMBRE_EQUIPO;
            return $this;
        }
        public function getPRESUPUESTO(){
            return $this->PRESUPUESTO;
        }
        public function setPRESUPUESTO($PRESUPUESTO){
            $this->PRESUPUESTO = $PRESUPUESTO;
            return $this;
        }
        public function getFECHA_FUNDACION(){
            return $this->FECHA_FUNDACION;
        }
        public function setFECHA_FUNDACION($FECHA_FUNDACION){
            $this->FECHA_FUNDACION = $FECHA_FUNDACION;
            return $this;
        }
        
        public function getZONA(){
            return $this->ZONA;
        }
        public function setZONA($ZONA){
            $this->ZONA = $ZONA;
            return $this;
        }
        public function getTITULOS(){
            return $this->TITULOS;
        }
        public function setTITULOS($TITULOS){
            $this->TITULOS = $TITULOS;
            return $this;
        }

        // se establece el metodo que devolvera cada fila de la tabla como un objeto independiente
        public function getAll(){
            
            $consulta = $this->db->prepare('SELECT * FROM equipos');
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EquipoModel");

            return $resultado;
        }

        // se establecera el metodo para devolver un objeto concreto segun la clave primaria de la tabla
        public function getById($COD_EQUIPO){
            $gsent = $this->db->prepare('SELECT * FROM equipos where COD_EQUIPO = ?');
            $gsent->bindParam(1, $COD_EQUIPO);
            $gsent->execute();

            $gsent->setFetchMode(PDO::FETCH_CLASS, "EquipoModel");
            $resultado = $gsent->fetch();

            return $resultado;
        }

        // se establece un metodo para guardar una nueva fila en la tabla
        public function save(){
            // se establece la preconsulta
                $consulta = $this->db->prepare('INSERT INTO equipos ( COD_EQUIPO,NOMBRE_EQUIPO,PRESUPUESTO,FECHA_FUNDACION,ZONA,TITULOS) values (?,?,?,?,?,?)');
                // se determinan los valores de la preconsulta en el orden requerido
                $consulta->bindParam(1, $this->COD_EQUIPO);
                $consulta->bindParam(2, $this->NOMBRE_EQUIPO);
                $consulta->bindParam(3, $this->PRESUPUESTO);
                $consulta->bindParam(4, $this->FECHA_FUNDACION);
                $consulta->bindParam(5, $this->ZONA);
                $consulta->bindParam(6, $this->TITULOS);
                // se ejecuta la sentencia
                $consulta->execute();
            
        }

        // se establece el metodo que editara las dilas existentes
        public function edit() {
            // se establece la preconsulta
            $consulta = $this->db->prepare('UPDATE EQUIPOS SET NOMBRE_EQUIPO = ?, PRESUPUESTO=?, FECHA_FUNDACION=?, ZONA=?, TITULOS=?  WHERE COD_EQUIPO =  ? ');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->NOMBRE_EQUIPO);
            $consulta->bindParam(2, $this->PRESUPUESTO);
            $consulta->bindParam(3, $this->FECHA_FUNDACION);
            $consulta->bindParam(4, $this->ZONA);
            $consulta->bindParam(5, $this->TITULOS);
            $consulta->bindParam(6, $this->COD_EQUIPO);
            // se ejecuta la sentencia
            $consulta->execute();
        }

        // se establece el metodo para eliminar una fila de la tabla
        public function delete(){
            // se estabkece sentencia a ejecutar
            $consulta = $this->db->prepare('DELETE FROM  equipos WHERE COD_EQUIPO =  ?');
            // se indica la clave primaria a eliminar
            $consulta->bindParam(1, $this->COD_EQUIPO);
            // se ejecuta la sentencia
            $consulta->execute();
        }
    }
?>