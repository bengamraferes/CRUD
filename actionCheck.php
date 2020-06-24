<?php
session_start();
require('config.php');
if(isset($_POST['options'])){
        $tabOptions = $_POST['options'];
        $nomnreOPtions = count($tabOptions) ;
        $sqlPost = 'post = ? ';
        if($nomnreOPtions > 1){
            for($i = 1 ; $i< $nomnreOPtions ;$i++ ){
                (string) $sqlPost .= 'OR post = ? ';
            }
        }
        echo $sqlPost;
        $reqNombreDePage = $bdd->prepare("SELECT COUNT(*) FROM  `employees` WHERE $sqlPost ");
        for($j = 0 ; $j < $nomnreOPtions ; $j++){
            $reqNombreDePage->bindValue($j+1,  $tabOptions[$j], PDO::PARAM_STR);
        }
        $reqNombreDePage->execute();
        $nombredepage = (int) $reqNombreDePage->fetchALL()[0][0];
            // $reponse = $bdd->prepare("SELECT * FROM `employees` WHERE  $sqlPost LIMIT $limite OFFSET $debut");
            $reponse = $bdd->prepare("SELECT * FROM `employees` WHERE  $sqlPost ");
        for($j = 0 ; $j < $nomnreOPtions ; $j++){
            $reponse->bindValue($j+1,  $tabOptions[$j], PDO::PARAM_STR);
        }
        $reponse->execute();
        $tabRes = $reponse->fetchALL(PDO::FETCH_ASSOC);
        echo $nombredepage;
        echo '<pre>';
        var_dump($tabRes);
        echo '</pre>';
    }
    header('Location: ./index.php');
    exit;

?>