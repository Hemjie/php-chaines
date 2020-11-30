<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices sur les chaînes</title>
</head>
<body>
    <?php
        /* Exercice 1 : Acronymes */      

        echo "<h1>Acronymes</h1>";

        $acro = null;
        if (!empty($_GET["acro"])) {
            $acro = $_GET["acro"];
        }
    ?>
    <form>
        <label for="acro">Phrase dont vous voulez l'acronyme :</label>
        <input type="text" name="acro" id="acro" value="<?php echo $acro; ?>" placeholder="Votre phrase">
        <button>Obtenir l'acronyme</button>
    </form>

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

        echo acronyme($acro);
               
        /* Exercice 2 : Conjugaison */
        echo "<h1>Conjugaison</h1>";

        $conjug = null;
        if (!empty($_GET["conjug"])) {
            $conjug = $_GET["conjug"];
        }
    ?>
    <form>
        <label for="conjug">Quel est le verbe du 1er groupe dont vous voulez la conjugaison au présent de l'indicatif ?</label>
        <input type="text" name="conjug" id="conjug" value="<?php echo $conjug; ?>" placeholder="Votre verbe">
        <button>Conjugaison au présent</button>
    </form>
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
    
</body>
</html>