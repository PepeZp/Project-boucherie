<?php

    $message=false;

    $bdd= connectToDataBase();
/*
    require_once "../include/config.php" ;
    $remi=emailExiste('azerty@uiop');
    var_dump($remi);
*/


    function connectToDataBase(){
        try{
            $bdd= new PDO('mysql:host='.DATABASE_HOST.';
            dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASS);
            //instance connexion à la BDD
            return $bdd;
            
        }catch (PDOException $e) {
            $GLOBALS["message"]="Erreur!: ".$e->getMessage()."</br>";
            die();
        }
    }


function emailExiste($email){
    
    
    $sql= "SELECT COUNT(*)as Nb FROM 'clients' WHERE 'email' = ?"; //intialise la requête renvoi el nbre de client dont email = requete
    
    $request= $GLOBALS["bdd"]->prepare($sql);
    
    $request->execute(Array($email));//execute la requete en remplacant ? par les V du tableau$
    
    $array = $request->fetchAll(PDO::FETCH_ASSOC); // trie les données
    
    return $array[0]["Nb"];
    
    
}

function registerClient($client){
     $sql="INSERT TO'clients',('firstname','lastname','email','encrypte','phone')
     VALUES (:firstname, :lastname, :email, :encrypte, :phone)";
        
     $request= $GLOBALS["bdd"]->prepare($sql);
    
     $array= Array(
         ":lastname"=> $client ["lastname"],
         ":email"=> $client  ["email"],
         ":firstname"=> $client ["fistname"],
         ":lastname"=> $client ["lastname"],
         ":phone_number"=> $client ["phone_number"],
         ":encrypte"=> $client ["password"]);
     
     $request->execute($array);
        
     $GLOBALS["bdd"]->lastInsertId();
        
}



?>

