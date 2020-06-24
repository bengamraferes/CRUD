<?php
require('config.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //$requette = $bdd->query("SELECT `id` FROM `employees` WHERE 1 ");
    $requette = $bdd->prepare("SELECT * FROM `employees` WHERE id = ? ");
    $requette->execute(array($id));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php while($donnes = $requette->fetch()): ?>
        <form action=<?php echo '"./actionUpdate.php?id='.$donnes['id'].'" '?>method = "POST"  >
        <p>Prénom : <input type="text" name ="prenom" value =<?php echo $donnes['firstname']; ?> ></p>
        <p>Nom : <input type="text" name = "nom" value =<?php echo $donnes['lastname']; ?>></p>
        <p>Mail : <input type="email" name = "mail" value =<?php echo  $donnes['email']; ?>></p>
        <p>Poste : <input type="text" name = "poste"value =<?php echo $donnes['post']; ?>></p>
        <p>Slaire : <input type="number" name = "salaire"value =<?php echo $donnes['salary']; ?>></p>
        <p>Date d'embauche : <input type="date" name = "dateEmbauche"value =<?php echo $donnes['hiring_date']; ?>></p>
        <p><button type="submit" name ="valider">Accéder </button></p>
        </form>
        <?php endwhile ?>
</body>
</html>