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

        //affichage du résultat via debug
        $result=$pdtsSup8->fetchAll(PDO::FETCH_ASSOC);
        echo '<pre>';
        print_r($result);
        echo '</pre>';

    }
    //on capture les exceptions si une exception est lancée, on affiche
    catch (PDOException $e){
        echo "Erreur: " . $e->getMessage();
    }
    //arrêt connexion
    // $connectDB=null;
    ?>
</body>
</html>