<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices sur les chaînes</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <header class="bg-image-full" style="background-image: url('letters.jpg'); background-repeat: no-repeat; background-size: cover; height: 125px">
            <div class="filter position-relative bg-light bg-image-full" style="opacity: 0.7; width: auto; height: 125px"></div>   
            <h1 class="position-relative text-center" style="top: -110px; color: #095228; font-size: 4rem;"><strong>Générateur d'acronymes</strong></h1>               
        </header>
        <?php
            /* Exercice 1 : Acronymes */      

            $acro = null;
            if (!empty($_GET["acro"])) {
                $acro = $_GET["acro"];
            }
        ?>

        <form class="py-5">
            <div class="form-group row">
                <label for="acro" class="col-sm-4 ml-5 pt-1" style="font-size: 20px">Phrase dont vous voulez l'acronyme :</label>
                <input type="text" class="form-control col-sm-7" name="acro" id="acro" value="<?php echo $acro; ?>" placeholder="Votre phrase">
            </div>    
            <div class="form-inline">        
                <button class="btn btn-success" style="margin-left: 414px">Obtenir l'acronyme</button>
                <div class="rep pl-3 text-success" style="font-size: 16px">
                    <strong>
                        <?php

                            function acronyme($acro) {
                                //transformer la phrase en tableau
                                $arrayPhrase = explode(" ", $acro);   
                                //parcourir le tableau
                                foreach($arrayPhrase as $ind => $phr) {
                                    //pour chaque mot, récupérer la première lettre qu'on met en majuscule
                                    $arrayPhrase[$ind] = strtoupper(substr($phr, 0, 1)) ;                                
                                } 
                                /* autre méthode : $sigle .= substr($phr, 0, 1) */
                                return implode("", $arrayPhrase);    
                            }

                            echo "Votre acronyme est : ".acronyme($acro);
                        ?>
                    </strong>
                </div>
            </div>
        </form>

        <div class="bg-image-full" style="background-image: url('letters2.jpg'); background-repeat: no-repeat; background-size: cover; height: 125px">
            <div class="filter position-relative bg-light bg-image-full" style="opacity: 0.7; width:auto; height:125px"></div>   
            <h1 class="position-relative text-center" style="top: -110px; color: #095228; font-size: 4rem;"><strong>Conjugueur</strong></h1>  
            <h2 class="text-center text-dark position-relative mt-3" style="top: -80px">1er groupe au présent de l'indicatif</h2>             
        </header>

        <?php
            /* Exercice 2 : Conjugaison */

            $conjug = null;
            if (!empty($_GET["conjug"])) {
                $conjug = $_GET["conjug"];
            }
        ?>
        <form class="position-relative" style="top: -55px">
            <div class="form-group row">
                <label for="conjug" class="col-sm-5 ml-5" style="font-size: 20px">Verbe dont vous voulez connaître la conjugaison :</label>
                <input type="text" class="form-control col-sm-3" name="conjug" id="conjug" value="<?php echo $conjug; ?>" placeholder="Votre verbe">                
                <button class="btn btn-success col-sm-3 ml-2">Obtenir la conjugaison</button>
            </div>           
            <div class="rep position-relative text-success" style="font-size: 16px; left: 520px">
                <strong>
                    <?php               
                        function conjugaison($conjug) {
                            $present = ["Je" => "e","Tu" => "es","Il / Elle / On" => "e", "Nous" => "ons", "Vous" => "ez","Ils" => "ent"];
                            $rep = [];
                            $long = strlen($conjug);
                            $prefixe = substr($conjug, 0, ($long-2));
                            /*autre méthode : $prefixe = substr($conjug, 0, -2); */
                            foreach ($present as $sujet => $term) {
                                array_push($rep, $sujet." ".$prefixe.$term);
                            }
                            if (substr($prefixe, 0, 1) == "a" || substr($prefixe, 0, 1) == "e" || substr($prefixe, 0, 1) == "h" || substr($prefixe, 0, 1) == "i" || substr($prefixe, 0, 1) == "o" || substr($prefixe, 0, 1) == "u" || substr($prefixe, 0, 1) == "y") {
                                $j = strstr($rep[0], "e", true);
                                $reste = substr($rep[0], 3);
                                $rep[0] = $j."'".$reste;
                            }
                            if (substr($prefixe, -1) == "g") {
                                $lg = strlen($rep[3]);
                                $g = substr($rep[3], 0, ($lg - 3));
                                $rest = substr($rep[3], -3);
                                $rep[3] = $g."e".$rest;
                            }
                            if (substr($prefixe, -1) == "c") {
                                $lg = strlen($rep[3]);
                                $c = substr($rep[3], 0, ($lg - 4));
                                $restc = substr($rep[3], -3);
                                $rep[3] = $c."ç".$restc;
                            }
                            if ($conjug !== null) {
                                return implode("<br/>", $rep);      
                            }  
                        }

                        echo conjugaison($conjug);    
                     ?>
            </div>
        </form>
    </div>
</body>
</html>