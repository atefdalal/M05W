<?php
    //Connexion a la Base 
    $maConnexion = new PDO('mysql:host=localhost;dbname=F1_DALAL;charset=utf8','DALAL', 'DALAL');

     //Récupération du chemin dans l'URL 
     if(isset($_SERVER['PATH_INFO']))
     {
         $req_path=$_SERVER['PATH_INFO'];
         //echo 'PATH INFO : '.$req_path. '<br/>';
 
         $req_data=explode('/',$req_path);
         //print_r($req_data);
     }

    //Afficher si c'est une requette GET 
    $req_type=$_SERVER['REQUEST_METHOD'];

    if ($req_type == 'GET'){
        
        if (isset($req_data[1]) && $req_data[1] == 'pilote')
        {
            $req = "SELECT * FROM pilote WHERE nom=?";
            $reqprepare=$maConnexion->prepare($req);
            $tableauDeDonnees=array($req_data[2]);
            $reqprepare->execute($tableauDeDonnees);
            $reponse=$reqprepare->fetchAll(PDO::FETCH_ASSOC);
            //print_r($reponse);  
        }

        if(isset($req_data[1]) && $req_data[1] == 'mesure')
        {
        //rest.php/mesure/[date]
        if (isset($req_data[2]) && !isset($req_data[3]) && strtotime($req_data[2])) {
            $req = "SELECT * FROM mesure WHERE instant=?";
            $reqprepare = $maConnexion->prepare($req);
            $tableauDeDonnees = array($req_data[2]);
            $reqprepare->execute($tableauDeDonnees);
            $reponse = $reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        } 

        //rest.php/mesure
        if (!isset($req_data[2])) {
            $req = "SELECT instant,vitesse,regim FROM mesure";
            $reqprepare = $maConnexion->prepare($req);
            $tableauDeDonnees = array();
            $reqprepare->execute($tableauDeDonnees);
            $reponse = $reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        } 

        //rest.php/mesure/[datedebut]/[datfin]
        elseif (isset($req_data[2]) && isset($req_data[3]) && strtotime($req_data[2]) && strtotime($req_data[3])) {
            $req = "SELECT * FROM mesure WHERE instant BETWEEN ? AND ?";
            $reqprepare = $maConnexion->prepare($req);
            $tableauDeDonnees = array($req_data[2]);
            $reqprepare->execute($tableauDeDonnees);
            $reponse = $reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        } 

        //rest.php/mesure/vitesse
        elseif (isset($req_data[2]) && $req_data[2] === 'vitesse') {
            $req = "SELECT vitesse FROM mesure";
            $reqprepare = $maConnexion->prepare($req);
            $tableauDeDonnees = array();
            $reqprepare->execute($tableauDeDonnees);
            $reponse = $reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        } 

        //rest.php/mesure/régime
        elseif (isset($req_data[2]) && $req_data[2] === 'regime') {
            $req = "SELECT regime FROM mesure";
            $reqprepare = $maConnexion->prepare($req);
            $tableauDeDonnees = array();
            $reqprepare->execute($tableauDeDonnees);
            $reponse = $reqprepare->fetchAll(PDO::FETCH_ASSOC);
            print_r(json_encode($reponse));
        } 
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