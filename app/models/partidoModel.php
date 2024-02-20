<?php
    // se crea el modelo que gestionara los datos de la tabla jugadores
    class PartidoModel{
        // la propiedad db gestionara la conexsion con la base de datos
        protected $db;

        // se establecen los valores que guardaran los datos de la tabla
        protected $COD_PARTIDO;
        protected $FECHA;
        protected $COD_EQUIPO1;
        protected $COD_EQUIPO2;
        protected $PUNTOS_EQUIPO1;
        protected $PUNTOS_EQUIPO2;

        // se establece el metodo constructor 
        public function __construct(){
            $this->db = SPDO::singleton();
        }

        // se establecen los getters y los setters para interactuar con las propiedades
        public function getCOD_PARTIDO(){
            return $this->COD_PARTIDO;
        }
        public function setCOD_PARTIDO($COD_PARTIDO){
            $this->COD_PARTIDO = $COD_PARTIDO;
            return $this;
        }
        public function getFECHA(){
            return $this->FECHA;
        }
        public function setFECHA($FECHA){
            $this->FECHA = $FECHA;
            return $this;
        }
        public function getCOD_EQUIPO1() {
            return $this->COD_EQUIPO1;
        }
        public function setCOD_EQUIPO1($COD_EQUIPO1){
            $this->COD_EQUIPO1 = $COD_EQUIPO1;
            return $this;
        }
        public function getCOD_EQUIPO2(){
            return $this->COD_EQUIPO2;
        }
        public function setCOD_EQUIPO2($COD_EQUIPO2){
            $this->COD_EQUIPO2 = $COD_EQUIPO2;
            return $this;
        }
        public function getPUNTOS_EQUIPO1(){
            return $this->PUNTOS_EQUIPO1;
        }
        public function setPUNTOS_EQUIPO1($PUNTOS_EQUIPO1){
            $this->PUNTOS_EQUIPO1 = $PUNTOS_EQUIPO1;
            return $this;
        }
        public function getPUNTOS_EQUIPO2(){
            return $this->PUNTOS_EQUIPO2;
        }
        public function setPUNTOS_EQUIPO2($PUNTOS_EQUIPO2){
            $this->PUNTOS_EQUIPO2 = $PUNTOS_EQUIPO2;
            return $this;
        }

        // se establece el metodo que devolvera cada fila de la tabla como un objeto independiente       
        public function getAll(){
            
            $consulta = $this->db->prepare('SELECT * FROM partidos');
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "partidoModel");

            return $resultado;
        }
        // se establecera el metodo para devolver un objeto concreto segun la clave primaria de la tabla
        public function getById($COD_PARTIDO){
            $gsent = $this->db->prepare('SELECT * FROM partidos where COD_PARTIDO = ?');
            $gsent->bindParam(1, $COD_PARTIDO);
            $gsent->execute();

            $gsent->setFetchMode(PDO::FETCH_CLASS, "PartidoModel");
            $resultado = $gsent->fetch();

            return $resultado;
        }
        // se establece un metodo para guardar una nueva fila en la tabla
        public function save(){   
            // se establece la preconsulta
            $consulta = $this->db->prepare('INSERT INTO partidos ( COD_PARTIDO,FECHA,COD_EQUIPO1,COD_EQUIPO2,PUNTOS_EQUIPO1,PUNTOS_EQUIPO2 ) values ( ?,?,?,?,?,? )');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->COD_PARTIDO);
            $consulta->bindParam(2, $this->FECHA);
            $consulta->bindParam(3, $this->COD_EQUIPO1);
            $consulta->bindParam(4, $this->COD_EQUIPO2);
            $consulta->bindParam(5, $this->PUNTOS_EQUIPO1);
            $consulta->bindParam(6, $this->PUNTOS_EQUIPO2);
            // se ejecuta la sentencia
            $consulta->execute();
      
        }
        // se establece el metodo que editara las dilas existentes
        public function edit() {
            // se establece la preconsulta
            $consulta = $this->db->prepare('UPDATE partidos SET FECHA = ?,COD_EQUIPO1 = ?,COD_EQUIPO2 = ?, PUNTOS_EQUIPO1 = ?,PUNTOS_EQUIPO2  = ? WHERE  COD_PARTIDO =  ? ');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->FECHA);
            $consulta->bindParam(2, $this->COD_EQUIPO1);
            $consulta->bindParam(3, $this->COD_EQUIPO2);
            $consulta->bindParam(4, $this->PUNTOS_EQUIPO1);
            $consulta->bindParam(5, $this->PUNTOS_EQUIPO2);
            $consulta->bindParam(6, $this->COD_PARTIDO);
            // se ejecuta la sentencia
            $consulta->execute();
        }
        // se establece el metodo para eliminar una fila de la tabla
        public function delete(){
            // se estabkece sentencia a ejecutar
            $consulta = $this->db->prepare('DELETE FROM  partidos WHERE COD_PARTIDO =  ?');
            // se indica la clave primaria a eliminar
            $consulta->bindParam(1, $this->COD_PARTIDO);
            // se ejecuta la sentencia
            $consulta->execute();
        }
    }
?>