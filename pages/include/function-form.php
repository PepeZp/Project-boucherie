<?php

/*$toto= verifParam(array("email"=>"22", "password"=>"22"));array("email", "password"); //false car différent il compare les clés par les V

var_dump($toto); TEST unitaire */


function verifEmailSyntaxe($email){ //Valide un entier, éventuellement dans un intervalle donné et le convertie en entier en cas de succès.
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true:false; //ce filtre permet de vérifier si bien . , @ etc                           (http://php.net/manual/fr/filter.filters.validate.php)
    
}



function verifParam($data,$array){ //fonction qui vérifie les paramètres
    
    $retour = false;
    
        if(count($data) != count($array)) //vérifie nbre éléments ds les 2 arrays de données
            return false;
    
    foreach($array as $valeur){ //1ère boucle permet de parcourir les élèments obligatoires
        
        $retour = false;
        
        foreach($data as $key => $valData){ //Le tableau prend un nombre illimité de paramètres, chacun séparé par une virgule, sous la forme d'une paire key => value. 2éme boucle pr parcourir les données envoyées par le formulaire ($_POST)
            
            $retour = ($valeur == $key)?true:$retour; //ternaire 
                $retour = true;
            
        }
        
    
        if ($retour != true) // si V change suite condition second foreach, return false;
            return false; // false de base, si les champs du formulaire (vérifiés sur 2 boucles pr chaque éléments du array) ok alors retourne true si par contre différent sort de la boucle :false
        }
    

    return true;
}



?>