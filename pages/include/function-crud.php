<?php

    $message=false;
/*  $hashed_password= cryptPassword("Mike");
    $verif = comparePassword ($hashed_password, "Mike");
    var_dump($verif);
*/

    $bdd= connectToDataBase();
/*
    require_once "../include/config.php" ;
    $remi=emailExiste('azerty@uiop');
    var_dump($remi);
*/


    function connectToDataBase(){
        try{
            require_once "config.php";
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
        
        $sql = "SELECT COUNT(*) as Nb FROM `clients` WHERE `email` = ?"; // Init la requete (Renvoi le nombre de client dont l'email est egal à $email)
        
        $request = $GLOBALS["bdd"]->prepare($sql); // Preparation de la requete avant execusion
        
        $request->execute(Array($email)); // Execute la requete en remplacant les ? par les data tu tableau
        
        $array = $request->fetchAll(PDO::FETCH_ASSOC); // Trie des données

        return (bool)$array[0]["Nb"];
    }

function registerClient($client){
     $sql="INSERT INTO `clients`(`firstname`, `lastname`, `email`, `encrypte`, `phone`)
     VALUES (:firstname, :lastname, :email, :encrypte, :phone)";
        
     $request= $GLOBALS["bdd"]->prepare($sql);
    
     $array= Array(
         ":email"=> $client["email"],
         ":firstname"=> $client["firstname"],
         ":lastname"=> $client["lastname"],
         ":phone"=> $client["phone_number"],
         ":encrypte"=> cryptPassword($client["password"]));
     
     $request->execute($array);
        
     return $GLOBALS["bdd"]->lastInsertId();
        
}


//salt clé aléatoire
function cryptPassword($password){ 
    $crypt = sha1(rand(11,22)."Mike".uniqid()."Mike".rand(11,22));
    return crypt($password, $crypt);
    }

function comparePassword($hashed_password, $password){
    return (hash_equals($hashed_password, crypt($password, $hashed_password))) ? "true" : "false";
    }
    
function selectUserByEmail($email){
$sql= "SELECT * FROM `clients` WHERE `email` = ?"; //intialise la requête renvoi el nbre de client dont email = requete
    
    $request= $GLOBALS["bdd"]->prepare($sql);
    
    $request->execute(Array($email));//execute la requete en remplacant ? par les V du tableau$
    
    $array = $request->fetchAll(PDO::FETCH_ASSOC); // trie les données

    return $array[0]; 
}

function connectUser($email, $password){ //verif si email existe
    if( !emailExiste($email))
        return -1;
    
    $user = selectUserByEmail($email);
    
    if (!comparePassword($user["encrypte"],$password)) //recup mdp verifier que ok, on renvoie les données de l'utilisateur
        return -2;
    
    unset ($user["encrypte"]); //suppr un élément d'un array
    
    return $user;
    
    }

?>

