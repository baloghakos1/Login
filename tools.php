<?php
class Tools {
    static function dbExists($mysqli, $a) {
        $sql = "SELECT SCHEMA_NAME
        FROM INFORMATION_SCHEMA.SCHEMATA
       WHERE SCHEMA_NAME = '$a'";
       $asd = $mysqli->query($sql)->fetch_all();
       if($asd == null) {
        return false;
       } else {
        return true;
       }
    }

    static function userExist($mysqli, $email, $pw) {
        return false;
    }

}