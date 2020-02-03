<?php
/**
 * File:  index.php
 * Creation Date: 04/12/2017
 * description:
 *
 * @author: canals
 */
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use mywishlist\modele\Item;
use mywishlist\modele\Liste;
use \Slim\Slim as Slim;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('./src/conf/conf.ini'));

$db->setAsGlobal();
$db->bootEloquent();

$app = new Slim();

$app->get('/',function () {
    $c = new \mywishlist\controleur\ControlleurPrincipal();
    $c->afficherAccueil();
});

$app->post('/',function () {
    $c = new \mywishlist\controleur\ControlleurPrincipal();
    $c->afficherAccueil();
});

$app->get('/liste/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->afficherListe($id);
});

$app->post('/liste/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->commentaireListe($id);
});

$app->get('/item/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->afficherItem($id);
});

$app->post('/item/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->commentaireItem($id);
});

$app->post('/resitem/:id', function ($id) { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->reserveItem($id);
});

$app->get('/partage/:token', function($user) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->partagerListe($user);
});

$app->get('/checkmaliste/:token', function($id) {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->consulterReservation($id);
});

//Cagnotte
//$app->get('creercagnotte', function() {
//    $c = new \mywishlist\controleur\ControlleurCreation();
//    $c->creerCagnotte();
//});
//
//$app->post('/creercagnotte', function($idItem) {
//    $c = new \mywishlist\controleur\ControlleurCreation();
//    $c->creerCagnottePost($idItem);
//});
//
//$app->post('/participercagnotte/:cagnotte', function($cagnotte) { //eventuellement un get pour formulaire rentrer la cagnotte visée ?
//    $c = new \mywishlist\controleur\ControlleurCreation();
//    $c->participerCagnotte($cagnotte);
//});

$app->get('/leslistes', function() {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->afficherAllListe();
});

//Page des créations
$app->get('/creation', function() {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->modifs();
});

//Créer une liste
$app->get('/creerliste', function() { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->creerListe();
});

$app->post('/creerListe', function() {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->creerListePost();
});

//affichage des listes modifiables
$app->get('/affmodifsliste', function() {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->afficherListeModif();
});

    //modification de la liste - GET et POST
$app->get('/modifsliste/:id', function($id) { //AFFICHAGE FORMULAIRE
   $c = new \mywishlist\controleur\ControlleurCreation();
   $c->modifierListe($id);
});

$app->post('/modifsliste/:id', function($id) { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->modifierListePost($id);
});


//Suppression de liste

$app->get('/suppliste', function() { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->supprimerListes();
});

$app->get('/suppliste/:id', function($id) { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->supprimerListePost($id);
});

$app->post('/suppliste/:id', function($id) { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->supprimerListePost($id);
});



//Affichage des liste puis ajout d'un item
$app->get('/affadditem', function() { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->afficherItemAjout();
});

$app->get('/additem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->ajouterItem($id);
});

$app->post('/additem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->ajouterItemPost($id);
});



//Affichage des listes puis modification d'item

$app->get('/affmodifsitem', function() { //AFFICHAGE FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->afficherItemModif();
});

$app->get('/modifitem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->modifierItem($id);
});

$app->post('/modifitem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->modifierItemPost($id);
});


//Affichage des listes puis suppression d'item

$app->get('/affsuppitem', function() {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->affSuppItem();
});
$app->post('/suppitem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->supprimerItemPost($id);
});

$app->get('/suppitem/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCreation();
    $c->supprimerItem($id);
});



// GESTION DE COMPTE

$app->get('/inscription', function() { //AFFICHAGE FORMLAIRE
   $c = new \mywishlist\controleur\ControlleurCompte();
   $c->creerCompte();
});

$app->post('/inscription', function() { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->traitementInscription();
});

$app->get('/connexion', function() { //AFFICHAGE FORMULAIRE
   $c = new \mywishlist\controleur\ControlleurCompte();
   $c->identification();
});

$app->post('/connexion', function() { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->traitementIdentification();
});

$app->post('/deconnexion', function() { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->deconnexion();
});

$app->get('/moncompte', function() {
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->afficherCompte();
});

$app->post('/suppression', function() {
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->delete();
});

$app->get('/moncompte/modifier', function() { //AFFICHAGE FORMULAIRE
   $c = new \mywishlist\controleur\ControlleurCompte();
   $c->modifierCompte();
});

$app->post('/moncompte/modifier/:infos', function($infos) { //POST FORMULAIRE
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->modifierComptePost($infos);
});

$app->post('/supprimercompte', function() {
   $c = new \mywishlist\controleur\ControlleurCompte();
   $c->supprimercompte();
});

$app->get('/joindreliste/:id', function($id) {
    $c = new \mywishlist\controleur\ControlleurCompte();
    $c->joindreListe($id);
});

$app->get('/tes/listes', function() {
    $c = new \mywishlist\controleur\ControlleurParticipant();
    $c->getList();
});

$app->run();




