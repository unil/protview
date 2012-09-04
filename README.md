Aperçu
------------

`ProtView` est une « Single Page Application » qui permet de créer une représentation vectorielle (SVG) d‘une protéine transmembranaire en fonction de paramètres définis par l’utilisateur. Le premier jet est calculé selon un algorithme défini. Le résultat peut être modifié en interagissant avec la souris directement sur le graphique généré.
L’architecture applicative s’appuie sur :
  *	[xfm](https://github.com/damiencorpataux/xfm-php) (PHP 5 / MySQL)
  * [jQuery](http://jquery.com) / [jQuery SVG](http://keith-wood.name/svg.html) / [jQWidgets](http://www.jqwidgets.com)
  * [HTML 5](http://html5.org) / [SVG](http://www.w3.org/Graphics/SVG/) / [Bootstrap CSS](http://twitter.github.com/bootstrap/)
  * [Backbone.js](http://backbonejs.org) / [Underscore.js](http://underscorejs.org)
  * [REST](http://fr.wikipedia.org/wiki/Representational_State_Transfer)
  * MVC / PubSub / Façade / Médiateur / Décorateur


Installation
------------

### Prérequis

  * Apache, PHP 5.3, MySQL (p.ex: [WAMP](http://www.wampserver.com), LAMP, [MAMP](http://www.mamp.info/en/index.html))
  * [git] (http://git-scm.com/downloads)
  
### Mac OSX
#### Installation de ProtView

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:

```bash
# Aller dans le dossier d'installation
cd {DOSSIER_INSTALLATION}
# Télécharger l'application ProtView avec les dépendances
git clone --recursive https://github.com/unil/protview
# Aller sur la branche heigvd
git checkout heigvd
```

#### Configuration MySQL

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:

```bash
# Se connecter à MySQL en root
mysql -uroot -p
# Créer une base des données pour protview
CREATE DATABASE protview DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
# Créer un utilisateur 'protview' avec les droits pour la base des données protview
GRANT ALL PRIVILEGES ON protview.* TO 'protview'@'localhost' IDENTIFIED BY 'protview';
exit
```

#### Configuration Apache

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

#### Configuration ProtView

  * Ouvrir `/Applications/Utilities/Terminal.app` et exécuter les commandes suivantes:

```bash
# Création de la base de données
php app/lib/xfm/scripts/deploy/database.php
```

Utilisation
------------

  * **<http://localhost/protview>**<br/> Aller à la page d'accueil de l'application
