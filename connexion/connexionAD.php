<?php
	session_start();
	
	// INFORMATIONS A MODIFIER SELON L'APPLICATION QUE L'ON VEUT SECURISER OU SI DES MODIFICATIONS SONT APPORTEES A L'AD

	// ADRESSE DU SERVEUR AD
	$ldap_host = "wprod.ds.aphp.fr"; 
	
	// REPERTOIRE DE BASE OU VA SE FAIRE LA RECHERCHE DE L'UTILISATEUR
	$base_dn = "DC=wprod,DC=ds,DC=aphp,DC=fr"; 
	
	// COMPTE ADMIN AVEC LES DROITS DE LECTURE SUR L'AD POUR LISTER LES GROUPES AUXQUELS L'UTILISATEUR APPARTIENT
	$admin = "CN=s-nck-psupervision,OU=100-utilisateurs,OU=-standard,OU=NCK0,DC=wprod,DC=ds,DC=aphp,DC=fr"; 
	
	// MOT DE PASSE DU COMPTE ADMIN
	$password_admin = "azerty12"; 
	
	// LOGIN UTILISATEUR POUR SE CONNECTER A L'AD AFIN DE VERIFIER SI LE LOGIN ET LE MOT DE PASSE SONT VALIDES
	$user = $_SESSION['ANNUAIRE_ADMIN_user']."@wprod.ds.aphp.fr";  
	
	// MOT DE PASSE ENTRE PAR L'UTILISATEUR
	$password = $_SESSION['ANNUAIRE_ADMIN_pass']; 
	
	// GROUPE AUQUEL DOIT APPARTENIR L'UTILISATEUR POUR AVOIR ACCES A L'APPLICATION
	$groupe = "nck0-std-annuaire_admin"; 
	
	// FILTRE PLACE DANS LA FOCNTION DE RECHERCHE
	// RECHERCHE DE L'UTILISATEUR VIA SON sAMAccountName QUI CORRESPOND AU DISPLAY NAME DANS L'AD
	$filter= "sAMAccountName=".$_SESSION['ANNUAIRE_ADMIN_user'];
	$accueil_admin = "admin_accueil.php";
	$accueil_modif = "modif_accueil.php" ;

	// CONNEXION AU SERVEUR LDAP
	$connectAD = ldap_connect($ldap_host) or exit("La connexion au serveur LDAP à echoué.");
	
	// LES OPTIONS DE CONNEXION SUIVANTES SONT INDISPENSABLES POUR POUVOIR DIALOGUER AVEC LE SERVEUR AD
	ldap_set_option($connectAD, LDAP_OPT_PROTOCOL_VERSION, 3) or exit ("Impossible de passer le protocole ldap en version 3, contactez un administrateur"); 
	ldap_set_option($connectAD, LDAP_OPT_REFERRALS, 0) or exit ("Impossible de modifier les options LDAP, contactez un administrateur");
?>