<?php
        require_once "include/config.php" ;
        $message="";

        if(!empty($_POST)){

            //require function
            require("include/function-form.php"); // require dans le if car appelé QUE si besoin
            require("include/function-crud.php");

            $dataToVerif=Array("firstname", "lastname", "phone_number", "E-mail", "Password");

            if(!verifParam($_POST, $dataToVerif)):
                $message .= "<p> Erreur d'envoi d'information </>";

            elseif(!verifEmailSyntaxe($_POST["email"])):
                    $message .= "<p> Votre adresse e-mail est invalide</p>";

            else:

                $retour= true;

                if(strlen($_POST["firstname"])>70){
                    $message .= "votre prénom doit être compris entre 2 et 70 caractères";
                    $retour= false;
                }if(strlen($_POST["lastname"]) > 70){
                    $message .= "votre nom doit être compris entre 2 et 70 caractères";
                    $retour= false;
                }

                $_POST["phone_number"] = str_replace(" ", "", $_POST["phone_number"]);
                $_POST["phone_number"] = str_replace("-", "", $_POST["phone_number"]);
                $_POST["phone_number"] = str_replace(",", "", $_POST["phone_number"]);
                $_POST["phone_number"] = str_replace(".", "", $_POST["phone_number"]);

                if( strlen($_POST["phone_number"]) > 10 ){
                    $message .= "votre n° doit faire 10 chiffres";
                    $retour= false;
                }

                if(emailExiste($_POST["email"])){
                    $message = "déjà inscrit, <a href=connecter-vous</a>";
                    $retour= false;
                }

                if($retour == false){
                    registerClient($_POST);
                    header('location:index.html');
                    exit;
                }

            endif;
    }

?>



<!DOCTYPE html>
<html lang="fr">

    
<head>
    <?php require ("page_include/head.php");?>
</head>
<body>
        

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="firstname" name="firstname" type="firstname" value="<?= (isset($_POST["firstname"]))? $_POST["firstname"]: "" ?> " autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="lastname" name="lastname" type="lastname" value="<?= (isset($_POST["firstname"]))? $_POST["firstname"]: "" ?> " autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="phone_number" name="phone_number" type="phone_number" value="<?= (isset($_POST["firstname"]))? $_POST["firstname"]: "" ?> " autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?= (isset($_POST["firstname"]))? $_POST["firstname"]: "" ?> " autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="<?= (isset($_POST["firstname"]))? $_POST["firstname"]: "" ?> " autofocus>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -- Pepe-->
                                 <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                                <div style=" text-align: center; margin: 10% 0% 0% 0%; ">
                                    <a href="login.php" class="btn btn-lg btn-block btn-primary">Login</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>



