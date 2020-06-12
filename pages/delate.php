<?php
session_start();
include('fonctions.php');

echo register::supprimer($_GET['id']);
redirection('liste_joueur.php');
?>