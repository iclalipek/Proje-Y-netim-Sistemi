<?php
class VT{
    var $sunucu = "localhost";
    var $user="root";
    var $password = "";
    var $dbname = "proje_kontrol_sistemi";
    var $baglanti;
    function __consturct()
    {
        try{
     $this->baglanti = new PDO("mysql:host".$this->sunucu.";dbname=".$this->dbname.";char=utf8",$this->user,$this->password);
    }catch(PDOException $error){
        echo $error->getMessage();
        exit();
    }
}
}

?>