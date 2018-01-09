# sf_lp2018
![](https://symfony.com/images/v5/opengraph/symfony.png)

TP Symfony Licence MIM 2018

_moshi_


   * [Introduction](#introduction)
      * [Présentation](#présentation)
      * [Prérequis](#prérequis)
      * [Objectif de ce cours](#objectif-de-ce-cours)
      * [Installation](#installation)
   * [Autour de Symfony](#autour-de-symfony)
      * [Composer](#composer)
      * [MVC](#mvc)
      * [Entité](#entité)
      * [ORM](#orm)
      * [Repository](#repository)
      * [Annotation](#annotation)
      * [Route](#route)
      * [Bundle](#bundle)
      * [Environnement](#environnement)
      * [Profiler](#profiler)
      * [Arborescence](#arborescence)
      * [Lancement de l'application](#lancement-de-lapplication)
      * [Exo 1](#exo-1)
   * [Routes &amp; Controller](#routes--controller)
      * [Configs](#configs)
      * [Annotations](#annotations)
      * [Variables de routes](#variables-de-routes)
      * [Génération d'url](#génération-durl)
      * [Controller &amp; Action](#controller--action)
      * [Response](#response)
      * [Exo 2](#exo-2)
   * [Vues (TWIG)](#vues-twig)
      * [Affichage](#affichage)
      * [Logique](#logique)
      * [Exos 3](#exos-3)


Introduction
==========
Présentation
-----------------


**Nous allons parler essentiellement de Symfony 3.4 dans ce cours, version la plus stable et celle qui sera maintenue le plus longtemps avant la sortie de la version 4.4.**

Symfony est : 
* **Français !**
* un Framework PHP solide
* l'un des frameworks PHP les plus utilisés
* Grosse communauté active

![Frameworks PHP Connus](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/frameworks.jpeg?raw=true)

Symfony permet :
* un gain de temps (travail structuré)
* Open source
* Maintenabilité, flexibilité et interopérabilité
* travailler sur un framework mondialement reconnu

Symfony est malheureusement : 
* Lourd (structure et fichiers/répertoires)
* Long à prendre en main

Prérequis
-------------
* Serveur PHP 5.5.9 (version 3) ou PHP 7.1.3 (version 4)
* C'est tout.
* date.timezone doit être défini dans votre php.ini sinon risque d'erreur

Pour vérifier la compatibilité de votre serveur (une fois Symfony récupéré)
```bash
php bin/symfony_requirements 
```

Objectif de ce cours
---------------------------
L'objectif est de se familiariser avec le framework sans rentrer dans le développement poussé sur Symfony. Nous allons aborder le minimum pour une utilisation web basique (site vitrine, blog, recherche etc) via un cours suivi d'exos et d'un TP à rendre.

Installation
----------------

1. Installer composer : https://getcomposer.org/download/
2. Lancer projet : https://symfony.com/download 
```bash
composer create-project symfony/framework-standard-edition tp 3.4
```
3. Remplir les informations demandées (infos MySQL même si on peut s'en passer)
4. Tester les prérequis : 
```bash
cd tp
php bin/symfony_requirements 
 
```
5. Corriger les erreurs

Autour de Symfony
===============
Composer
--------------
Permet de gérer des dépendances PHP, on demande à composer de gérer que tel ou tel projet, via un fichier composer.json, a besoin d'un autre projet pour fonctionner, se charge de faire le maillage et de télécharger les librairies requises.

MVC
------
Modèle Vue Controller : Design pattern ou façon de structurer son développement.
Vous l'avez déjà utilisé dans pas mal de cours il est très répandu, dans le cas de Symfony :
* Le Modèle correspond aux Entités - Entity
* La vue correspond à la gestion de template TWIG par défaut 
* Controller correspond aux différents controllers qui vont vous permettre de faire le pont et les différents traitements complexes.

Entité 
-----
Une entité est une classe PHP faisant le lien avec une base de données, on y déclare les différentes propriétés accessibles ; Symfony utilise par défaut un outil de persistence de données : Doctrine.

ORM 
------
Système permettant de se libérer des requêtes pour la base de données. Il se charge de générer les requêtes à effectuer sur les Entités spécifiées.

Repository
--------------
Classe PHP qui fait le pont entre une entité et l'ORM, il permet notamment de structurer des requêtes complexes.

YAML
-------
Format de structuration de données très utilisé dans Symfony, mais on peut utiliser du JSON, XML ou des classes PHP, les fichiers de config par défaut sont en YAML.

Annotation
---------------
Commentaire PHP directement dans les classes utiles (controller, entité) interprété par Symfony pour générer des fichiers de config temporaires ; Nous utiliserons pour un soucis de simplification en majorité cette notation.

Route 
-------
Système permettant en gros de lier une URL à une méthode de controller ; Elle est gérée en priorité dans le fichier app/config/routing.yml, mais on le renseignera également en annotation dans les fichiers Controllers

Bundle 
-------
Sorte de modules Symfony qui peuvent contenir tout et n'importe quoi ; C'est la force de Symfony les modules peuvent fonctionner indépendemment et même sur d'autres structures PHP, autre framework etc.

Environnement 
------
Symfony propose par défaut 2 environnements : dev et prod qui permettent de donner des configs différentes en fonction de l'environnement de travail ; dev permet une utilisation sans cache avec des outils de dev comme le profiler ; prod lui permet d'utiliser le site sous cache et sans aucun message d'erreurs.
De plus on peut configurer les différentes environnements pour par exemple rediriger tous les mails vers toto@titi.com en dev et laisser le fonctionnement normal pour prod ; pratique pour les debugs.
Pour accéder à l'environnement dev : on passe par le point d'accès app_dev.php : 
http://localhost:8000/app_dev.php
http://localhost:8000/app.php est l'environnement prod.


Profiler
---------
Un outil très pratique pour debugger et voir la ligne de vie d'un appel.
Accessible qu'en environnement dev : 
http://localhost:8000/app_dev.php

![Profiler](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/profiler.jpeg?raw=true)
![Page Profiler](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/profiler2.jpeg?raw=true)

Il permet d'avoir toutes les informations propre à Symfony (requêtes BDD générées, routes, trace des méthodes utilisées, informations sur l'utilisateur courant ... et un historique des profilers), mais on peut également avoir des informations sur les mails envoyés, et on peut renvoyer des messages depuis le code PHP pour debuguer.

Arborescence
-----------------
![Arborescence](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/arborescence.jpeg?raw=true)
* /app : 
	* /config/ : Fichiers de configs principaux de l'application
	* /Resources/
		* /public/ : Fichiers js, css, images, fonts et autres fichiers accessibles en http
		* /views/ : Fichiers de template 
		 
* /src : Répertoire de développement et liste des bundles développé pour l'application
	* /AppBundle :  Bundle principal de l'application
	
* /web : Répertoire accessible en http (les autres ne sont pas visible via le navigateur)

Dans un Bundle on va retrouver 4 répertoires importants : 
* Controller : Controllers propres à ce bundle
* Entity : Modèles liés à ce bundle 
* Resources : Contient les vues et / ou d'autres fichiers accessibles en http propre à ce bundle (même arborescence que app/Resources)
* Form : Contient des classes permettant de gérer des formulaires.

Lancement de l'application 
-----
Soit vous disposez d'un serveur web et vous exposez le répertoire web :
http://localhost:8888/
Sinon Symfony embarque un serveur PHP via la commande : 
```bash
php bin/console server:run 
```
Et la console vous donnera l'url en local en général : http://localhost:8000

Exo 1
------
* Installer Symfony
* Check des requirements
* Vérifier que le site fonctionne
 ![Le site fonctionne](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/exo1.jpeg?raw=true)
* Tester les environnements dev et prod
* Changer le Hello World de Symfony par une page **"Bienvenue sur mon site"**
* Configurer symfony pour utiliser sqlite (https://symfony.com/doc/3.3/doctrine.html)

Routes & Controller
======
https://symfony.com/doc/3.4/routing.html

Une route permet de diriger une url (ou un pattern d'url) vers une méthode de controller appelée Action.

Par exemple l'url "/" renvoie vers :
_//app/src/AppBundle/Controller/DefautController.php :: indexAction_

Un fichier app/config/routing.yml permet de configurer les routings globales de l'appli et chaque bundle doit gérer ses routes indépendement.
Avec un autre fichier routing par exemple dans src/AppBundle/Resources/config/routing.yml.

Ou sous d'autres formats de fichiers : XML, JSON, Classe PHP et en annotation.

* Nous allons utiliser l'annotation dans notre cas, le plus simple à prendre en main.
![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/annotations_route.jpeg?raw=true)

Configs 
-----

* Une route peut être **constante** : /blog 

ou **dynamique** :  /blog/{slug}
Ici slug englobé de **{ }** devient une variable dynamique qui prend tous les caractères alphanumériques par exemple : 
/blog/42
/blog/lorem-ipsum
/blog/titi-32_tata
Ces 3 urls correspondent à la méthode ciblée par la route avec une variable slug différente.
Cette variable peut être récupérée par le controller.

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route2.jpeg?raw=true)

* Une route est au minimum un chemin (path) et un nom 
* Ces variables peut être mise par défaut grâce à "defaults"
* Ces variables peuvent être soumises à une validation de format via "requirements"

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route3.jpeg?raw=true)

* On peut également préfixer l'url avec le mot clé "prefix"
* Vous pouvez cumuler plusieurs routes pour une méthode Action


Annotations 
-------
http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html
Pour pouvoir utiliser une annotation il faut :
```
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
```
à ajouter après le namespace dans votre Controller, il devrait y être par défaut dans AppBundle:DefautController


Variables de routes
------
On définit une variable d'url via des accolades {ma_variable} : 
```
/**
* @Route("/page", defaults={"page": "nopage"}, name="blog_index")
* @Route("/page/{page}", name="blog_index")
*/
public function indexAction($page)
{
	echo $page;
} 
```
Ici on a deux routes pour la méthode indexAction avec une variable $page qui est à nopage si on accède à l'url /page.

On peut cumuler plusieurs variables :
```
/**
* @Route("/page/{page}/{subpage}", name="blog_index")
*/
public function indexAction($page, $subpage)
{
	echo $page.' '.$subpage;
} 
```

Génération d'url
-------
Pour générer une url en PHP on utilise : 
```
$this->generateurl('nom_de_la_route', $variables);
```

Ou sous TWIG on a deux fonctions : 
```
{{ path('nom_route', {'page': 'toto', 'vars2': 'titi'}) }}

{{ url('nom_route', {'page': 'toto', 'vars2': 'titi'}) }}
```

Controller & Action
-----
Les routes redirigent vers une méthode de Controller ; un controller Symfony se nomme de la sorte :
NomDuController où le suffix Controller est obligatoire et le nom du fichier et de la classe est en **CamelCase**.

Les différentes méthodes se nomment de la sorte : 

**nomDeLaMethodeAction** est lui en **miniCamelCase**


Response
------
Une Action renvoie toujours un type Response ; il existe plusieurs type de Response :
JsonResponse, RedirectResponse, HttpResponse, BinaryFileResponse etc ...

La plus utilisée est Response pour l'utiliser on va use : 
```
use Symfony\Component\HttpFoundation\Response; 
```

et dans la méthode action on : 
```
public function indexAction(){
	return new Response('Ma response');
}
```
Affiche à l'écran Ma response.

Une méthode render() permet aux Actions de récupérer une vue et d'afficher le contenu de la vue compilée avec les différentes variables envoyées.

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route4.jpeg?raw=true)

Ici on va récupérer la template présente dans app/Resources/views/default/index.html.twig pour affecter la variable base_uri.

* Pour récupérer une template dans votre Bundle le chemin du fichier twig sera : 
http://symfony.com/doc/3.4/templating/namespaced_paths.html

Exo 2 
-------
* Créer 2 nouvelles pages :
	* http://localhost/time/now : afficher la date l'heure  minute et seconde
	* http://localhost/color/blue : affiche "blue" à l'écran dynamiquement
	* http://localhost/color/red : affiche "red" à l'écran dynamiquement
	* Ajouter un menu avec des liens vers les 2 pages créées.

Vues (TWIG)
=====
http://twig.sensiolabs.org/

Twig est un moteur de rendu de template comme Smarty, mais a des rapports très proches avec Symfony, Sensio a contribué énormément à son développement.
Un moteur de template permet de limiter les logiques complexes pour réaliser des templates simples à coder.
La syntaxe commence toujours avec {} des accolades

Affichage 
------
* {{ ma_variable }} Pour affiche du texte ou un contenu 
* {# commentaire #}
* ~ : concatenation 
	* {{ 'toto' ~ 'titi' }}

Logique 
--------
* {% %} permet d'utiliser des logiques tels que :
	* {% if %} {% else %} {%endif %} : condition
	* {% for item in items %}{%endfor} : foreach
	* {% set foo='foo' %} : set des variables
 
Exos 3 
------
* Utiliser l'héritage pour mettre le menu dans un seul fichier mais visible sur les 2 pages.
* Intégrer bootstrap (CDN)
* Pour la page /color  afficher le mot de la même couleur dynamiquement ("bleu" en bleu) (en CSS)
* Pour la couleur rouge afficher en plus le Message : "Attention risque de virus" en rouge
* Dans le menu rajouter un lien vers les pages couleurs : red, blue, yellow, pink, violet, salmon en utilisant un foreach
* Mettre en souligné l'url active

Entités - modèles
=====git 