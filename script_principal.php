#!/usr/bin/php 

<?php 

$input = fopen ("$argv[1]","r");
$texte = fopen("texte.dat", "w");
$tableau = fopen("tableau.dat", "w");
$vendeur = fopen("comm.dat","w");

while(!feof($input)){ 

	$line=fgets($input); 
    if ((preg_match('/^DEBUT_TEXTE/', $line))||(preg_match('/^Début_texte/', $line))) { 
        while ((!preg_match('/^FIN_TEXTE/', $line))&&!(preg_match('/^Fin_texte/', $line))){ 
            if (!(preg_match('/^DEBUT_TEXTE/', $line))&&!(preg_match('/^Début_texte/', $line))){ 
                fwrite($texte, $line);
            } 
            $line=fgets($input);
        } 
    }
    if ((preg_match('/^SOUS_TITRE/',$line))||preg_match('/^Sous_titre/',$line)) {
        fwrite($texte, $line);
    }
    if ((preg_match('/^Meilleurs:/',$line))||preg_match('/^MEILLEURS:/',$line)) {
        fwrite($vendeur, $line);
    }
    if ((preg_match('/^DEBUT_STATS/', $line))||(preg_match('/^Début_stats/', $line))){ 
        $line=fgets($input);
        while (!preg_match('/^FIN_STATS/', $line)&&!preg_match('/^Fin_stats/', $line)){
            fwrite($tableau, $line);
            $line=fgets($input); 
        } 
    }
} 

fclose($input);
fclose($texte);
fclose($tableau);
fclose($vendeur);
//a partir de la ligne des meilleurs vendeurs ont va réecrire par dessus et inscrire les 3 meilleurs vendeurs de la region dans comm.dat
$input = fopen ("comm.dat","r"); 
$line=fgets($input); 
$code = explode(":", $line); // Recupere tout les vendeurs sans l'intitulé meilleur avant.
$code = explode(",", $code[1]); //Recupere tous les clients
$nb_res = count($code);

foreach (range(0,$nb_res-1) as $vendeur){
    $vending=$code; 
    $vending = explode("=",$vending[$vendeur]); //Recuperer les 37k de chaque vendeur 
    $monnaie = explode("K",$vending[1]); 
    //echo $vending[0]; //recupere 37 de chaque vendeur 
    //ALGO MAX ET MAXIMUS A FAIRE PUIS EXPLODE JUSQUAU NOMS DES VENDEURS 

    if ($vendeur==0){
        $max1=$monnaie[0];
        $maximus1=$code[$vendeur];
    } 

    else if ($vendeur==1){
        if ($max1<=$monnaie[0]){ 
            $max2=$max1;
            $maximus2=$maximus1;
            $max1=$monnaie[0];
            $maximus1=$code[$vendeur];
        } 
        else {
            $max2=$monnaie[0];
            $maximus2=$code[$vendeur];
        }
    }
    else if ($vendeur==2){

        if ($max1<=$monnaie[0]){ 
            $max3=$max2;
            $maximus3=$maximus2;
            $max2=$max1;
            $maximus2=$maximus1;
            $max1=$monnaie[0];
            $maximus1=$code[$vendeur];
        } 
        else if($max2<=$monnaie[0]){ 
            $max3=$max2;
            $maximus3=$maximus2;
            $max2=$monnaie[0];
            $maximus2=$code[$vendeur];
        }
        else{
            $max3=$monnaie[0];
            $maximus3=$code[$vendeur];
        }
    }
    else{
        
        if ($max1<=$monnaie[0]){ 
            $max3=$max2;
            $maximus3=$maximus2;
            $max2=$max1;
            $maximus2=$maximus1;
            $max1=$monnaie[0];
            $maximus1=$code[$vendeur];
        } 
        else if($max2<=$monnaie[0]){ 
            $max3=$max2;
            $maximus3=$maximus2;
            $max2=$monnaie[0];
            $maximus2=$code[$vendeur];
        }
        else if($max3<=$monnaie[0]){
            $max3=$monnaie[0];
            $maximus3=$code[$vendeur];
        }
    }
}
fclose($input);
$input = fopen ("comm.dat","w");
fwrite($input, "$maximus1,$maximus2,$maximus3");

?> 