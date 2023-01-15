<?php
    class Connect{
        protected $dbconn;

        protected function Connection(){
            try {
                $conn = $this->dbconn = new PDO("mysql:local=localhost;dbname=movil21","root","");
                return $conn;
            } catch (Exception $e) {
                print "error ".$e->getMessage();
                die();
            }
        }

        public function setNames(){
            return $this->dbconn->query("SET NAMES 'utf8'");
        }
    }
?>