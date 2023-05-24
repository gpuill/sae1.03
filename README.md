# sae1.03
University project using Docker and bash scripts


Script "script_principal.php"

------------------------------------------------------------------------------------------------------------------------------------------------------------------

Résumé :

Le script "script_principal.php" sert a récuperer les informations provenant des fichiers textes, il vient placer les informations dans 4 fichier différents :
   "texte.dat" , Contient tout les textes ainsi que les sous titres.
   "tableau.dat" , Contient le tableau de statistique.
   "comm.dat" , Contient l'ensemble des meilleurs vendeurs repertorier dans le fichier texte.

------------------------------------------------------------------------------------------------------------------------------------------------------------------

Comment l'utiliser :

Appeler le script en donnant comme argument le nom du fichier a décortiquer.

 ex : php script_principal.php demo.txt

pour l'utiliser dans docker : 

Telecharger l'image docker 'sae103-php' 
1) docker image pull sae103-php 
2) puis lancer l'execution 

A noter : les choses entre crochet sont a remplir.

ex : docker run -v /Docker/<login>/sae103php:/work sae103-php php -f script_principal.php <nom du fichier a traité>

