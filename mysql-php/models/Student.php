<?php
    class Student extends Connect{

        public function getStudent(){
            $conn = parent::Connection();
            parent::setNames();
            
            $sql = "SELECT * FROM `estudiantes`";
            $sql = $conn->prepare($sql);
            $sql->execute();

            return $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getStudentByCod($codU){
            $conn = parent::Connection();
            parent::setNames();
            
            $sql = "SELECT * FROM `estudiantes` WHERE id_estudiante = ?";
            $sql = $conn->prepare($sql);
            $sql->bindValue(1, $codU);
            $sql->execute();

            return $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function setStudent($nameEst, $lstnEst, $phneEst){
            $conn = parent::Connection();
            parent::setNames();
            
            $sql = "INSERT INTO `estudiantes` VALUES(NULL, ?, ?, ?) ";
            $sql = $conn->prepare($sql);
            $sql->bindValue(1, $nameEst);
            $sql->bindValue(2, $lstnEst);
            $sql->bindValue(3, $phneEst);
            $sql->execute();

            return $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updStudentByCod($nameEst, $lstnEst, $phneEst ,$codU){
            $conn = parent::Connection();
            parent::setNames();
            
            $sql = "UPDATE `estudiantes` SET `nombres` = ?, `apellidos` = ?, `telefono` = ? WHERE id_estudiante = ?";
            $sql = $conn->prepare($sql);
            $sql->bindValue(1, $nameEst);
            $sql->bindValue(2, $lstnEst);
            $sql->bindValue(3, $phneEst);
            $sql->bindValue(4, $codU);
            $sql->execute();

            return $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delStudentByCod($codU){
            $conn = parent::Connection();
            parent::setNames();
            
            $sql = "DELETE FROM `estudiantes` WHERE id_estudiante = ?";
            $sql = $conn->prepare($sql);
            $sql->bindValue(1, $codU);
            $sql->execute();

            return $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>