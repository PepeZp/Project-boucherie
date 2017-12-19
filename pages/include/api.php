<?php
    
    header("Access-Control-Allow-Origin: *");
    require "function-crud.php";
  

if (!empty($_POST)){ //vérif formulaire rempli
    if(isset($_POST["email"])&& isset($_POST["password"])){ // vérif champs email et password existent
        
        $retour = Array("error" => true);
        
        $user = connectUser(trim($_POST["email"]), trim($_POST["password"])); 
            
        if ($user == -1)
            $retour["message"] = "utilisateur invisible";
            
        elseif($user == -2)
            $retour["message"] = "password/email error";
            
        else{
            $retour["error"] = false ;
            $retour["user"] = $user ;
        }    
        echo json_encode($retour);
    }
}
?> 