<?php 
session_start();
if(isset($_POST['select'])){
    $_SESSION['ordre'] = $_POST['select'];
    echo  $_SESSION['ordre'];
    header('Location: ./index.php');
    exit;
}

// if (isset($_SESSION['ordre'])){
//     //echo  $_SESSION['ordre'];
//     $ordre = (string) htmlspecialchars($_SESSION['ordre']) ;
//     echo $ordre ;
//     $reponse = $bdd->query("SELECT * FROM `employees` ORDER BY $ordre LIMIT $limite OFFSET $debut");
//     //$reponse = $bdd->prepare("SELECT * FROM `employees` ORDER BY ?" );
//     //$reponse->bindValue(':ordre', $ordre);
//     // $reponse->bindValue('limite', $limite, PDO::PARAM_INT);
//     // $reponse->bindValue('debut', $debut, PDO::PARAM_INT);
//     // $reponse->execute(array($ordre));
//      $tabRes = $reponse->fetchALL(PDO::FETCH_ASSOC);
//     // echo '<pre>';
//     // var_dump($tabRes);
//     // echo '</pre>';
// }
?>