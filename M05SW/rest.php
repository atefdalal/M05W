<?php
    //Connexion a la Base 
    $maConnexion = new PDO('mysql:host=localhost;dbname=F1_DALAL;charset=utf8','DALAL', 'DALAL');

     //Récupération du chemin dans l'URL 
     if(isset($_SERVER['PATH_INFO']))
     {
         $req_path=$_SERVER['PATH_INFO'];
         echo 'PATH INFO : '.$req_path. '<br/>';
 
         $req_data=explode('/',$req_path);
         print_r($req_data);
     }

    //Afficher si c'est une requette GET 
    $req_type=$_SERVER['REQUEST_METHOD'];

    if ($req_type == 'GET'){
        
        if (isset($req_data[1]) && $req_data[1] == 'pilote')
        {
            $req = "SELECT * FROM pilote WHERE nom=?";
            $reqprepare=$maConnexion->prepare($req);
            $tableauDeDonees=array($req_data[2]);
            $reqprepare->execute($tableauDeDonees);
            $reponse=$reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r($reponse);  
        }

        //rest.php/mesure/[date]
        if (isset($req_data[2]) && isset($req_data[3]) && strtotime($req_data[2]) && strtotime($req_data[3])) {
            $reg = "SELECT * FROM mesure WHERE instant BETWEEN ? AND ?";
            $regpreparer = $maConnexion->prepare($reg);
            $tableauDeDonnees = array($req_data[2], $req_data[3]);
            $regpreparer->execute($tableauDeDonnees);
            $reponse = $regpreparer->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));

        //rest.php/mesure/[datedebut]/[datfin]
        } elseif (isset($req_data[2]) && isset($req_data[3]) && strtotime($req_data[2]) && strtotime($req_data[3])) {
            $reg = "SELECT * FROM mesure WHERE instant BETWEEN ? AND ?";
            $regpreparer = $maConnexion->prepare($reg);
            $tableauDeDonnees = array($req_data[2], $req_data[3]);
            $regpreparer->execute($tableauDeDonnees);
            $reponse = $regpreparer->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));

        //rest.php/mesure/vitesse
        } elseif (isset($req_data[2]) && $req_data[2] === 'vitesse') {
            $reg = "SELECT vitesse FROM mesure";
            $regpreparer = $maConnexion->prepare($reg);
            $tableauDeDonnees = array();
            $regpreparer->execute($tableauDeDonnees);
            $reponse = $regpreparer->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));

        //rest.php/mesure/régime
        } elseif (isset($req_data[2]) && $req_data[2] === 'regime') {
            $req = "SELECT regime FROM mesure";
            $regpreparer = $maConnexion->prepare($req);
            $tableauDeDonnees = array();
            $regpreparer->execute($tableauDeDonnees);
            $reponse = $regpreparer->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        }
    } 

    
    /*$maConnexion = new PDO('mysql:host=localhost;dbname=F1_DALAL;charset=utf8','DALAL', 'DALAL');
    $req = "SELECT * FROM pilote";
    $reqpreparer=$maConnexion->prepare($req);
    $tableauDeDonnees=array();
    $reqpreparer->execute($tableauDeDonnees);
    $reponse=$reqpreparer ->fetchAll(PDO::FETCH_ASSOC);
    $reqpreparer->closeCursor();
    print_r($reponse); */ 
?>