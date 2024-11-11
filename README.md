# ZOO ARCADIA
Arcadia est un project scolaire full stack d'application complète pour un Zoo fictif.

# Environnement de travail

Plusieurs pré-recquis pouvoir faire fonctionner le projet en local.

# IDE

Ce projet a été réalisé avec l'IDE *Visual Studio Code* [(lien de téléchargement)](https://code.visualstudio.com/download).

# GITHUB

Installer Git sur sa machine : [lien de téléchargement](https://git-scm.com/downloads).

CLONER LE DÉPÔT DU PROJET:
    - rendez-vous dans un terminal de l'IDE de votre choix.
    - vérifier le chemin de dossier de votre machine pour cloner le dépôt où vous le désirez.
    - écrivez cette commande dans votre terminal 
    ```git clone https://github.com/Daniel-Gros/arcadiabackend.git```


# SYMFONY

**PRÉREQUIS**

**PHP**

Il vous faudra avoir la version 8.2.12 de *PHP* installée sur votre machine. 
Vous devrez pour cela installer le serveur local *XAMPP* que vous pouvez télécharger en [cliquant ici](https://www.apachefriends.org/fr/download.html).
*XAMPP* installera sur votre machine automatique la version 8.2.12 de PHP ainsi que *MySQL* dont vous aurez besoin pour la gestion des bases de données.

**SYMFONY**

Il vous faudra télécharger *Composer* qui est un gestionnaire de dépendances PHP. 
Vous pouvez le télécharger en [cliquant ici](https://getcomposer.org/download/).
Une fois *Composer* installé sur votre machine , vous pouvez passer à l'étape suivante

*CLI Symfony*

Pour installer le CLI vous devrez vous rendre [sur ce lien](https://symfony.com/download) et suivre les instructions. 
Télécharger *Scoop*
Télécharger le *Symfony CLI* avec la commande dans votre terminal: 
    
```scoop install symfony-cli```

**LES DÉPENDANCES**

**LES BUNDLES SYMFONY**

Pour ce projet, j'ai utilisé quelques bundles que vous pourrez télécharger pour la plupart en utilsant *Composer* et/ou *npm*

*AssetMapper* en lançant dans votre terminal à la racine du projet la commande:
```composer require symfony/asset-mapper symfony/asset symfony/twig-pack ```

*Bootstrap* en lançant dans votre terminal à la racine du projet la commande:
```php bin/console importmap:require bootstrap/dist/css/bootstrap.min.css```

Importer Bootstrap dans un fichier app.js 
```// assets/app.js
import 'bootstrap/dist/css/bootstrap.min.css';
```
Exécuter la commande : ````php bin/console importmap:require bootstrap``` pour configurer bootstrap dans le fichier importmap.php à la racine du projet.

*SymfonyCastsBundle* en lançant dans votre terminal la commande à la racine du projet:
```composer require symfonycasts/sass-bundle```

Puis éxécuter la commande ```php bin/console sass:build --watch``` pour lancer le watcher de votre préprocesseur de style.

*Symfony-twig-bundle* en lançant dans votre terminal la commande à la racine du projet: 
```composer require twig/twig symfony/twig-bundle```



*IMPORTANT*

Vous n'avez pas besoin de cloner le dépôt dans le dossier du serveur local associé (htdocs pour XAMPP, www pour WAMP).
Ce projet étant réalisé avec Symfony, vous devrez juste écrire la commande ```symfony server:start```
cela ouvrira votre navigateur avec le projet partie frontend à l'adresse [http://localhost:8000]

**Le Projet Arcadia**

Arcadia est un projet fictif de fin d'études. Toute ressemblance avec des applications et des animaux existants ou ayant existé dans différents coins du monde 
serait purement fortuite et ne pourrait être que le fruit d'une pure coïncidence.

Les images de l'application sont toutes des images libre de droit que l'on peut trouver sur différentes ressources :
- [Pexels](https://www.pexels.com/fr-fr/)
- [Pixabay](https://pixabay.com/fr/)
- [Unsplash](https://unsplash.com/fr)

La charte graphique réalisée grâce à l'outil figma: 


![Charte Graphique d'Arcadia](https://github.com/user-attachments/assets/4c18eeba-a64a-4e13-b732-e2ade4ad192e)

J'espère que vous aurez autant de plaisir à explorer le code de ce projet, que j'ai eu de plaisir à le concevoir.

**Daniel Gros.
Tous droits réservés.
Projet crée pour la promotion développeur web et web mobile d'Avril 2025.**
