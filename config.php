<?php
$host = 'localhost';
$username ='root';
$password = '';
$dbname = 'monentreprise'; 
try
    {
        $bdd = new PDO('mysql:host='.$host.';dbname='. $dbname .'',$username,$password,array(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

?>