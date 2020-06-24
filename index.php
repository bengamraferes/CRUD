<?php
session_start();
require('config.php');

$limite = 5;
$nombredepage =(int) $bdd->query('SELECT COUNT(*) FROM  employees')->fetchALL()[0][0];
$sql = ' WHERE 1';
$ordre = ' ORDER BY lastname ';
if(isset($_GET['page']) AND (int) $_GET['page']>0){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
if(isset($_POST['rest'])){
session_destroy();
}
if(isset($_SESSION['ordre'])){
    $ordre = ' ORDER BY '.$_SESSION['ordre'];
}
$debut = ($page -1) * $limite;
$sqlLimte = ' LIMIT ' .$limite. ' OFFSET ' .$debut;
$sqlExecute = $sql.$ordre.$sqlLimte;
$reponse = $bdd->prepare("SELECT * FROM `employees` $sqlExecute ");
$reponse->execute();
$tabRes = $reponse->fetchALL(PDO::FETCH_ASSOC);

if(isset($_POST['options'])){
    $tabOptions = $_POST['options'];
    $nomnreOPtions = count($tabOptions) ;
    $sqlPost = 'post = ? ';
    if($nomnreOPtions > 1){
        for($i = 1 ; $i< $nomnreOPtions ;$i++ ){
            (string) $sqlPost .= 'OR post = ? ';
        }
    }
    $reqNombreDePage = $bdd->prepare("SELECT COUNT(*) FROM  `employees` WHERE $sqlPost ");
    for($j = 0 ; $j < $nomnreOPtions ; $j++){
        $reqNombreDePage->bindValue($j+1,  $tabOptions[$j], PDO::PARAM_STR);
    }
    $reqNombreDePage->execute();
    $nombredepage = (int) $reqNombreDePage->fetchALL()[0][0];
        $reponse = $bdd->prepare("SELECT * FROM `employees` WHERE  $sqlPost LIMIT $limite OFFSET $debut");
    for($j = 0 ; $j < $nomnreOPtions ; $j++){
        $reponse->bindValue($j+1,  $tabOptions[$j], PDO::PARAM_STR);
    }
    $reponse->execute();
    $tabRes = $reponse->fetchALL(PDO::FETCH_ASSOC);
}
$nb = ceil($nombredepage / $limite);
if($page>$nb){
    $page =1;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
      <a href="./add_employee.php">Page employees</a>
      <br>
      <a href="install/install.php"> Install</a>
    </header>
    <main>
    <form action="./actionSelect.php" method = "Post">
        <label for="pet-select">Select:</label>
        <select name="select" id="pet-select">
        <option value="">--Please choose an option--</option>
        <option value="lastname">nom</option>
        <option value="firstname">prenom</option>
        <option value="hiding_date">date</option>
        </select>
        <input type="submit" value="Trier" />
    </form>
    <form action="./index.php" method = "post">
        <label for="chekt">check ici:</label>
        <input type="checkbox" id="radio1" name="options[]" value="Manager" checked="nane"><label for="radio1">Manager</label>
        <input type="checkbox" id="radio2" name="options[]" value="Développeur" checked="checked"><label for="radio2">Développeur</label>
        <input type="checkbox" id="radio2" name="options[]" value="Graphiste" checked=""><label for="radio2">Graphiste</label>
        <input type="checkbox" id="radio2" name="options[]" value="Illustrateur" checked=""><label for="radio2">Illustrateur</label>
        <input type="checkbox" id="radio2" name="options[]" value="Commercial" checked=""><label for="radio2">Commercial</label>
        <input type="checkbox" id="radio2" name="options[]" value="Chef de projet" checked=""><label for="radio2">Chef de projet</label>
        <input type="checkbox" id="radio2" name="options[]" value="Game Designer" checked=""><label for="radio2">Game Designer</label>
        <input type="checkbox" id="radio2" name="options[]" value="Scénariste" checked=""><label for="radio2">Scénariste</label>
        <input type="submit" value="Trier" />
    </form>
    <form action="./index.php" method = "post"> <br>
    <input type="submit" value="Rest" name = "rest"/>
    <br>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th colspan="1">Prénom</th>
                <th colspan="1">Nom</th>
                <th colspan="1">Mail</th>
                <th colspan="1">Poste</th>
                <th colspan="1">Salaire</th>
                <th colspan="1">Date Embauche</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($tabRes as $row): ?>
        <?php $prenom =$row['firstname'];$nom =$row['lastname'];$mail = $row['email'];$poste = $row['post'];$salire =$row['salary'];$dateEmbauche =$row['hiring_date']; $id = $row['id'];  ?>
        <tr>
            <td><?= $prenom; ?></td>
            <td> <?=$nom;?></td>
            <td> <?=$mail;?></td>
            <td> <?=$poste;?></td>
            <td> <?=$salire;?></td>
            <td> <?=$dateEmbauche;?></td>
            <td><form action=<?php echo '"actionDelete.php?id='.$id.'"'?> method = "POST"><button type="submit" name ="supprimer">supprimer</button></form></td>
            <td><?php echo '<a href="edit_employee.php?nom='.$nom.'&amp;prenom='.$prenom.'&amp;mail='.$mail.'&amp;poste='.$poste.'&amp;salaire='.$salire.'&amp;dateEmbauche='.$dateEmbauche.'&amp;id='.$id.'">EDITER</a>'  ?></td>
        </tr>
    <?php endforeach; ?>
   
    <?php for($i = 1; $i <= $nb;$i++ ):?>
    <a href="?page=<?php echo $i ; ?>"><?= 'Page '.$i.' ' ?></a>
    <?php endfor?>
   
         
        </tbody>
    </table>
    </main>
    <footer>
    
    </footer>
   
</body>
</html>