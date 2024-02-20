<?php
    // se crea el modelo que gestionara los datos de la tabla jugadores
    class JugadorModel{
        // la propiedad db gestionara la conexsion con la base de datos
        protected $db;
        // se establecen los valores que guardaran los datos de la tabla
        protected $COD_JUGADOR;
        protected $NOMBRE_JUGADOR;
        protected $FECHA_NACIMIENTO;
        protected $ESTATURA;
        protected $POSICION;
        protected $EQUIPO;
        // se establece el metodo constructor 
        public function __construct(){
            $this->db = SPDO::singleton();
        }
        // se establecen los getters y los setters para interactuar con las propiedades
        public function getCOD_JUGADOR(){
            return $this->COD_JUGADOR;
        }
        public function setCOD_JUGADOR($COD_JUGADOR){
            $this->COD_JUGADOR = $COD_JUGADOR;
            return $this;
        }
        public function getNOMBRE_JUGADOR(){
            return $this->NOMBRE_JUGADOR;
        }
        public function setNOMBRE_JUGADOR($NOMBRE_JUGADOR){
            $this->NOMBRE_JUGADOR = $NOMBRE_JUGADOR;
            return $this;
        }
        public function getFECHA_NACIMIENTO(){
            return $this->FECHA_NACIMIENTO;
        }
        public function setFECHA_NACIMIENTO($FECHA_NACIMIENTO){
            $this->FECHA_NACIMIENTO = $FECHA_NACIMIENTO;
            return $this;
        }
        public function getESTATURA(){
            return $this->ESTATURA;
        }
        public function setESTATURA($ESTATURA){
            $this->ESTATURA = $ESTATURA;
            return $this;
        }
        public function getPOSICION(){
            return $this->POSICION;
        }
        public function setPOSICION($POSICION){
            $this->POSICION = $POSICION;
            return $this;
        }
        public function getEQUIPO(){
            return $this->EQUIPO;
        }
        public function setEQUIPO($EQUIPO){
            $this->EQUIPO = $EQUIPO;
            return $this;
        }
        // se establece el metodo que devolvera cada fila de la tabla como un objeto independiente       
        public function getAll(){
            
            $consulta = $this->db->prepare('SELECT * FROM jugadores');
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "jugadorModel");

            return $resultado;
        }
        // se establecera el metodo para devolver un objeto concreto segun la clave primaria de la tabla
        public function getById($COD_JUGADOR){
            $gsent = $this->db->prepare('SELECT * FROM jugadores where COD_JUGADOR = ?');
            $gsent->bindParam(1, $COD_JUGADOR);
            $gsent->execute();

            $gsent->setFetchMode(PDO::FETCH_CLASS, "JugadorModel");
            $resultado = $gsent->fetch();

            return $resultado;
        }
        // se establece un metodo para guardar una nueva fila en la tabla
        public function save(){
            // se establece la preconsulta
            $consulta = $this->db->prepare('INSERT INTO jugadores ( COD_JUGADOR,NOMBRE_JUGADOR,FECHA_NACIMIENTO,ESTATURA,POSICION,EQUIPO ) values ( ?,?,?,?,?,? )');
            // se determinan los valores de la preconsulta en el orden requerido
            $consulta->bindParam(1, $this->COD_JUGADOR);
            $consulta->bindParam(2, $this->NOMBRE_JUGADOR);
            $consulta->bindParam(3, $this->FECHA_NACIMIENTO);
            $consulta->bindParam(4, $this->ESTATURA);
            $consulta->bindParam(5, $this->POSICION);
            $consulta->bindParam(6, $this->EQUIPO);
            // se ejecuta la sentencia
            $consulta->execute();
        }
        // se establece el metodo que editara las dilas existentes
        public function edit() {
            // se establece la preconsulta
            $consulta = $this->db->prepare('UPDATE jugadores SET NOMBRE_JUGADOR = ?,FECHA_NACIMIENTO = ?,ESTATURA = ?,POSICION = ?,EQUIPO = ? WHERE COD_JUGADOR =  ? ');
            // se determinan los valores de la preconsulta en el orden requerido          
            $consulta->bindParam(1, $this->NOMBRE_JUGADOR);
            $consulta->bindParam(2, $this->FECHA_NACIMIENTO);
            $consulta->bindParam(3, $this->ESTATURA);
            $consulta->bindParam(4, $this->POSICION);
            $consulta->bindParam(5, $this->EQUIPO);
            $consulta->bindParam(6, $this->COD_JUGADOR);
            // se ejecuta la sentencia
            $consulta->execute();
        }
        // se establece el metodo para eliminar una fila de la tabla
        public function delete(){
            // se estabkece sentencia a ejecutar
            $consulta = $this->db->prepare('DELETE FROM  jugadores WHERE COD_JUGADOR =  ?');
            // se indica la clave primaria a eliminar
            $consulta->bindParam(1, $this->COD_JUGADOR);
            // se ejecuta la sentencia
            $consulta->execute();
        }
    }
?>