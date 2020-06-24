<?php
require('config.php');
if(isset($_GET['id']) AND isset($_POST['supprimer']))
 $id = (int) htmlspecialchars( $_GET['id']);
 $requette = $bdd->prepare(" DELETE FROM `employees` WHERE id = ? ");
 $requette->execute(array($id));
 header('Location: ./index.php');
 exit;
?>