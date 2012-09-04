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
  * Ouvrir `/Applications/Utilities/Terminal.app`
  * Exécuter les commandes suivantes :

````
# Aller dans le dossier d'installation
cd {DOSSIER_INSTALLATION}
# Télécharger l'application ProtView avec les dépendances
git clone --recursive https://github.com/unil/protview
# Aller sur la branche heigvd
git checkout heigvd
````
  