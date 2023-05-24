
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="sample-style-to-pdf.css">
</head>
<body>
    <section>
        <h1><?php
$iso = file_get_contents("iso.data");
$region = file("regions.conf");
foreach($region as $value){
    $value = explode(',', $value);
    $isoReg = $value[4];
    $iso = strtolower($iso);
    $isoReg = strtolower($isoReg);
    if (preg_match("/".$iso."*/",$isoReg)){
        echo $value[0];
    }

}
?></h1>
        <p><?php
$iso = file_get_contents("iso.data");
$region = file("regions.conf");
foreach($region as $value){
    $value = explode(',', $value);
    $isoReg = $value[4];
    $iso = strtolower($iso);
    $isoReg = strtolower($isoReg);
    if (preg_match("/".$iso."*/",$isoReg)){
        echo "Nombre d'habitant : ".$value[3];
    }

}
?></p>
        <p><?php
$iso = file_get_contents("iso.data");
$region = file("regions.conf");
foreach($region as $value){
    $value = explode(',', $value);
    $isoReg = $value[4];
    $iso = strtolower($iso);
    $isoReg = strtolower($isoReg);
    if (preg_match("/".$iso."*/",$isoReg)){
        echo $value[1]."Km²";
    }

}
?></p>
        <p><?php
$iso = file_get_contents("iso.data");
$region = file("regions.conf");
foreach($region as $value){
    $value = explode(',', $value);
    $isoReg = $value[4];
    $iso = strtolower($iso);
    $isoReg = strtolower($isoReg);
    if (preg_match("/".$iso."*/",$isoReg)){
        echo $value[2]." département.";
    }

}
?></p>
        <figure>
            <img src="<?php
$iso = file_get_contents("iso.data");
$iso = strtoupper($iso);
echo $iso . ".png";

?>  ">
        </figure>
        <div class="bottom"><?php echo date("d-m-Y H:i") ?></div>
    </section>
    <section>
        <h2>Résultats trimestriels <?php 
        if (date("m")=="01" or  date("m")=="02" or date("m")=="03"){
            echo('01-');
            echo(date("Y"));
        }
        if(date("m")=="04" or  date("m")=="05" or date("m")=="06"){
            echo('02-');
            echo(date("Y"));
        }
        if(date("m")=="07" or  date("m")=="08" or date("m")=="09"){
            echo('03-');
            echo(date("Y"));
        }
        if(date("m")=="10" or  date("m")=="11" or date("m")=="12"){
            echo('04-');
            echo(date("Y"));
        }
        
        ?></h2>
        <p>
        <?php
$texte = file("texte.dat");
$crochet = 'false';
$lienB = 'false';
$paranthèse='false';
$texteF = '';
$cliquable = '';
foreach ($texte as $value) {
    if(preg_match("~^TITRE~",$value) OR preg_match("~^Titre~",$value)){
        echo "</p><h3>" . substr($value, 6) . "</h3><p>";
    }
    else if(preg_match("~SOUS_TITRE~",$value) OR preg_match("~Sous_titre~",$value)){
        echo "</p><h4>" . substr($value, 11) . "</h4><p>";
    }
    else{
        $texteE = explode(' ', $value);
        $texteF = '';
        $cliquable = '';
        foreach($texteE as $walue){
            if(preg_match('~\[~',$walue)){
                $crochet = 'true';
                $cliquable = $cliquable . substr($walue, 1).' ';
            }
            else if(preg_match('~\]~',$walue) && $crochet == 'true'){
                $fin_cliquable = explode(']', $walue);
                $cliquable ='<a href="'.substr($fin_cliquable[1],1,-1).'">'. $cliquable . $fin_cliquable[0].' </a>';
                $texteF = $texteF . $cliquable;
                $crochet = 'false';
            }
            else{
                $texteF = $texteF . $walue . ' ';
            }
        }
        echo $texteF;
    }

}
?>
</p>
        <table>
            <tr>
                <th>Nom du produit</th>
                <th>Ventes du trimestres</th>
                <th>Chiffre d'affaire du trimestre</th>
                <th>Ventre trimèstre de l'année dernière</th>
                <th>Chiffre d'affaire année dernière</th>
                <th>Evolution CA</th>
            </tr>
            <?php
$tableau = file("tableau.dat");
foreach($tableau as $value){
    $value = explode(",", $value);
    $CA = $value[1] / $value[3];
    echo '<tr>';
    for($i = 0; $i<6;$i++){
        if($i<5){
            echo '<td>' . $value[$i] . '</td>';
        }
        else{
            if($CA<1){
                echo '<td class="grasR">'. (integer)(($CA-1)*(-100)) .'%</td>';
            }
            else{
                echo '<td class="grasV">'. (integer)(($CA-1)*100) .'%</td>';
            }
        }
    }
    echo '</tr>';
}

?>
            

        </table>
        <div class="bottom"><?php echo date("d-m-Y H:i") ?></div>
    </section>
    <section>
        <h2>Nos meilleurs ventes du trimestre</h2>
        <ul>
        <?php 

$line = file_get_contents("comm.dat"); 
$line=explode(",",$line);
foreach ($line as $meilleur){
    $comm=$meilleur;
    echo "<figure>\n";
    $comm=explode("/",$meilleur);
    $best=$comm[0];
    echo "<img src=".$best.".png>\n";
    $CA=explode("=",$comm[1]);
    $name=$CA[0];
    $ca=$CA[1];
    echo "<figcaption>$name $ca</figcaption>\n";
    echo "</figure>\n";
}
?>
        </ul>
        <div class="bottom"><?php echo date("d-m-Y H:i") ?></div>
    </section>
    <section>
        <a href="https://bigbrain.biz/<?php
$iso = file_get_contents("iso.data");
echo $iso;
?>">Entreprise</a>
        <figure>
            <img src="qrode.png">
        </figure>
        <div class="bottom"><?php echo date("d-m-Y H:i") ?></div>
    </section>
</body>