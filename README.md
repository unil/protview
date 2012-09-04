Aperçu
------------

`ProtView` est une « Single Page Application » qui permet de créer une représentation vectorielle (SVG) d‘une protéine transmembranaire en fonction de paramètres définis par l’utilisateur. Le premier jet est calculé selon un algorithme défini. Le résultat peut-être modifié en interagissant avec la souris directement sur le graphique généré.
L’architecture applicative s’appuie sur :
  *	xfreemwork (PHP 5 / MySQL)
  * jQuery / jQuery SVG / jQWidgets
  * HTML 5 / SVG / Bootstrap CSS
  * Backbone.js / Underscore.js
  * REST
  * MVC / PubSub / Façade / Médiateur / Décorateur


Installation
------------

### Prérequis

  * Apache, PHP 5.3, MySQL (p.ex: WAMP, LAMP, MAMP)
  * [git] (http://git-scm.com/downloads)
  
### Mac OSX
## Installation de ProtView

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:
```bash
# Aller dans le dossier d'installation
cd {DOSSIER_INSTALLATION}
# Télécharger l'application ProtView avec les dépendances
git clone --recursive https://github.com/unil/protview
# Aller sur la branche heigvd
git checkout heigvd
```

## Configuration MySQL

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:
```bash
# Se connecter à MySQL en root
mysql -p
# Créer un utilisateur 'protview' avec les droits pour la table protview
GRANT USAGE ON *.* TO 'protview'@'localhost';
CREATE USER 'protview'@'localhost' IDENTIFIED BY 'protview';
GRANT ALL PRIVILEGES ON *.* TO 'protview'@'localhost';
exit; 
```

## Configuration Apache

  * Création d'un hôte virtuel selon la configuration suivante:
```bash
Alias /protview "{DOSSIER_INSTALLATION}/app/public"

<Directory "{DOSSIER_INSTALLATION}">
    Options Indexes MultiViews
    Options FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>
```
  
  * Ajouter la ligne suivante au fichier `app/public/.htaccess
```bash
RewriteBase /protview
```

## Configuration ProtView

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:

```bash
# Création de la base de données
php app/lib/xfm/scripts/deploy/database.php
```


