<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à ma base de données ABC</title>
</head>
<body>
    <h1>Base de données ABC </h1>

 <?php
    // on déclare les variables pour la connexion
    $servername= 'localhost';
    $username='root';
    $password='';

    // on se connecte
    try {
        $connectDB= new PDO("mysql:host=$servername;dbname=abc", $username, $password); 

        // on définit le mode d'erreur de PDO sur Exception
        $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion réussie";

        // récupérez, dans la base ABC, les produits dont le prix unitaire est supérieur ou égal à 8 euros.
        $pdtsSup8=$connectDB->prepare(" SELECT * FROM produit WHERE prixUnitaire>=8");
        $pdtsSup8->execute();

    }
    //on capture les exceptions si une exception est lancée, on affiche
    catch (PDOException $e){
        echo "Erreur: " . $e->getMessage();
    }
    //arrêt connexion
    // $connectDB=null;
    ?>

      <!-- Renvoie des données avec mise en forme  -->
        <h2>Liste des produits >=8 euros </h2>
        <table>
          <thead>
            <tr>
              <td>RefProduit&emsp;</td>
              <td>Description</td>
              <td>PrixUnitaire</td>
            </tr>
          </thead>
          <tbody>
            <?php while($result = $pdtsSup8->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $result['refProduit']; ?></td>
              <td><?php echo $result['description']; ?>&emsp;</td>
              <td><?php echo $result['prixUnitaire']; }?></td>
            </tr>
          </tbody>
        </table>
</body>
</html>