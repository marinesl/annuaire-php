# annuaire-php
Annuaire et plateforme Back Office Administrateur


## Contexte
- Diplôme : BTS SIO
- Ecole : ITIC Paris
- Année : 2014


## Enoncé
Créer un annuaire en PHP pour les hôpitaux avec une plateforme Back Office pour les administrateurs


## Utilisation

Deux recherches sont possibles : par service et avancée

Pour accéder au Back Office, cliquez sur Connexion Admin en bas de la page d'accueil et utilisez :
- login : 700700
- mot de passe : azerty

Naviguez dans le Back Office et gérez les différentes données


## Arborescence des fichiers

### /
- annuaire-php.sql : export de la base de données
- index.php : page d'accueil

### /connexion
- connexionBdd.php : connexion à la base de données
- deconnexionBdd.php : déconnexion à la base de données

### /doc_img
- image.jpeg : image pour les utilisateurs

### /outils
- /bootstrap : fichiers CSS et JS de la librairie Bootstrap
- /fontawesome : fichiers CSS et Fonts de la librairie Fontawesome

### /vues
- /admin_interface : toutes les pages du Back Office pour afficher, ajouter et modifier tous les données de l'annuaire
- /numeros_abreges : toutes les pages pour tous les différents numéros abrégés par régions, hôpitaux, etc...
- admin_accueil.php : page d'accueil administrateur
- admin_connexion.php : page de connexion administrateur
- admin_identification.php : script de connexion administrateur
- modif_accueil.php : page d'accueil de modification des informations administrateur
- modif_connexion.php : page de connexion pour la modification des informations administrateur
- modif_identification.php : script de connexion pour la modification des informations administrateur
- notice_telephone.php : page de la notice d'utilisation des téléphones
- numeros_abreges.php : page des numéros abrégés
- numeros_urgence.php : page des numéro d'urgence
- resultat_recherche_avancee.php : page des résultats de la recherche avancée
- resultat_recherche_large.php : page des résultats de la recherche large
- resultat_recherche_service.php : page des résultats de la recherche par service


## Installation

1. Créez un fichier .env.php à la racine du dossier, copiez le code suivant et remplissez les informations de votre base de données :

``
    define('BDD_USER', ''); 
    define('BDD_PASSWORD', '');  
    define('BDD_HOST', '');  
    define('BDD_PORT', '');  
    define('BDD_NAME', 'annuaire-php');
``

2. Importez le fichier annuaire-php.sql dans votre base de données


## Optimisations pour la V2
- Fichiers pour le header et le footer
- Optimiser les recherches
- La requête dans resultat_recherche_large.php est à revoir car l'utilisation de info_integrale dans la table annuaire_php_param_moteur_recherche n'est pas pratique
- Rassembler les pages communes (ex: les numéros abrégés)
- Barre de navigation : Mettre en évidence l'onglet 'Numéros d'urgence' lorsque les pages intérieures sont affichées 
- modif_connexion.php : Afficher le numéro du standard
- admin_interface/*_ajouter.php : Afficher les messages d'erreur correctement
- Lorsque le formulaire est vide, le message d'erreur correspondant n'est pas affiché : 
    - parametrage_service_modifier.php
    - parametrage_ua_modifier.php
    - parametrage_uh_modifier.php
- parametrage_*_*.php : Insérer dans la table 'annuaire_admin_log' les actions
- parametrage_abonne.php : 
    - Fenêtre modale ajouter -> gestion_creer_personne/lieu.php
    - Fenêtre modale modifier -> gestion_creer_personne/lieu.php
    - Barre de recherche
- gestion_creer_personne.php : Insérer la photo
- resultat_recherche_*.php : Afficher la photo
- admin_interface/parametrage_*.php:
	- Dans les fenêtres modales 'ajouter', afficher un bouton pour augmenter le nombre de lignes d'ajout 
	- Colorer les lignes dont 'actif' égal à 0 
	- Dans les fenêtres modales 'modifier', transformer le champ de saisie 'actif' en un menu déroulant avec comme champs '1' et '0'
- BDD :
	- Préciser et différencier les hôpitaux de jour et les hôpitaux de nuit
	- Ajouter dans la table 'annuaire_exploit_abonne' les lieux n'appartenant pas à 	l'hôpital comme : l'espace famille, les boutiques, les cafétérias, l'espace 	lecture, l'amphithéâtre ...
	- Préciser l'ordre des abonnés par service :
		- le chef de service (préciser le numéro de téléphone du secrétariat)
		- la secrétaire
		- les cadres
		- les médecins avec bureaux
		- les médecins sans bureaux (préciser le numéro de téléphone de l'accueil et du box de consultation)

