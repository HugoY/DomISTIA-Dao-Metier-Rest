DomotiquePhp
============

Présentation
--------

La couche dao permet de communiquer avec les Arduinos, pour lire ou écrire des informations sur celles-ci. 

La couche web du serveur est exposée aux clients via un service REST (REpresentational State Transfer). 

Autres repositories du projet
--------
* Serveur d'enregistrement
    * [github.com/HugoY/DomISTIA-ArduinosRecorder](https://github.com/HugoY/DomISTIA-ArduinosRecorder)
* Carte Arduino
   * [github.com/Birot/DomISTIA-Arduino](https://github.com/Birot/DomISTIA-Arduino)

Installation
--------
* Flasher les cartes arduinos en personnalisant : 
    * L'adresse IP du serveur d'enregistrement
    * L'adresse IP de la carte arduino
    * L'identifiant de la carte arduino
    * La description de la carte arduino (facultatif)
* Avec Netbeans charger le serveur d'enregistrement et le serveur Web
* Lancer le serveur d'enregistrement en ligne de commande PHP
    * Facultatif : On peut passer en paramètre une adresse IP et un port  
    * Ce n'est utile que si l'adresse IP par défaut n'est pas celle voulu (ex : plusieurs cartes réseaux)
* Lancer le serveur web
    * Dans netbeans configurer correctement la copie des fichiers dans le répertoire web de votre serveur web
    * Il faut auparavant configurer l'adresse IP du serveur d'enregistrement dans le fichier dao/Dao.php, variable $address (ligne 21) de la méthode getArduinos.

Auteurs
--------
* Julien Birot
* Hugo Charles

