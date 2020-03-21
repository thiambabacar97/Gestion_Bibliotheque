<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/connexion',     'authentification\ConnexionController@index')->name('auth.index');
Route::post('/connexion',    'authentification\ConnexionController@connect')->name('auth.connect');
Route::get('/retourener',     'testcontroller@return')->name('retourner');
Route::get('/test',           'testcontroller@index')->name('test');


Route::group(['middleware' => ['admin']], function () {

    Route::get('/livre',           'testcontroller@livre')->name('livre');
    Route::get('/livre/table',      'testcontroller@get_datatable')->name('livre_table');

    Route::get('/administrateur/noteFoundPage',        'testcontroller@notFound')->name('notefound');

    Route::post('/administrateur/logout',              'authentification\ConnexionController@logout')->name('auth.logout');

    Route::get('/administrateur/edit_profile',            'admin\ProfileController@index')->name('profile.index');
    Route::post('/administrateur/update_image',           'admin\ProfileController@update_image')->name('profile.update_image');
    Route::post('/administrateur/update_email',           'admin\ProfileController@update_email')->name('profile.update_email');
    Route::post('/administrateur/update_password',        'admin\ProfileController@update_password')->name('profile.update_password');

    Route::get('/administrateur', 'testcontroller@index')->name('home.admin');

    Route::get('/administrateur/ajout_nouveau_admin',       'admin\AjouterAdminController@index')->name('ajout_admin.index');
    Route::post('/administrateur/ajout_nouveau_admin',      'admin\AjouterAdminController@create')->name('ajout_admin.create');

    Route::resource('/administrateur/lecteurs','admin\crudLecteurControler');
    Route::get('/administrateur/ajout_lecteur',             'admin\LecteurController@index')->name('lecteur.index');
    Route::post('/administrateur/ajout_lecteur',            'admin\LecteurController@create')->name('lecteur.create');
    Route::get('/administrateur/lister_lecteur',            'admin\LecteurController@show')->name('lecteur.show');
    Route::get('/administrateur/lecteur/{id}/voire_detail', 'admin\LecteurController@show_detail')->name('lecteur.show_detail');
    Route::get('/administrateur/lecteur/{id}/modifier',     'admin\LecteurController@update_index')->name('lecteur.update_index');
    Route::post('/administrateur/lecteur/{id}/modifier',    'admin\LecteurController@update')->name('lecteur.update');
    Route::get('/administrateur/lecteur/{id}/delete',       'admin\LecteurController@delete')->name('lecteur.delete');
    Route::get('/administrateur/sanction/',                 'admin\LecteurController@sanction')->name('lecteur.sanction');
    Route::get('/administrateur/sanction/{id}',             'admin\LecteurController@get_User_sanction')->name('lecteur.get_User_sanction');



    // Route::get('/livre',                                    'testcontroller@livre_show_datatable')->name('lecteur.livre_show_datatable');
    // Route::get('/administrateur/lister_datatable',          'testcontroller@get_datatable')->name('lecteur.livre_get_datatable');
    Route::get('/livre1',                                    'testcontroller@show_livre_demander')->name('lecteur.show_livre_demander');
    Route::get('/livre/get',                                  'testcontroller@get_livre_demander')->name('lecteur.show_livre_demander');
    Route::get('/livre{livre}/valider{user}/{livre_demander_id}', 'testcontroller@valider_emprunt')->name('livre.valider_empruntt');

    Route::get('/administrateur/ajout_domaine',             'admin\DomaineController@index')->name('domaine.index');
    Route::post('/administrateur/ajout_domaine',            'admin\DomaineController@create')->name('domaine.create');
    Route::get('/administrateur/livre/ajouter',             'admin\LivreController@index')->name('livre.index');
    Route::post('/administrateur/ajout_livre',              'admin\LivreController@create')->name('livre.create');
    Route::get('/administrateur/livre/lister',              'admin\LivreController@show')->name('livre.show');
    Route::get('/administrateur/livre/{id}/voire_detail',   'admin\LivreController@show_detail')->name('livre.show_detail');
    Route::get('/administrateur/livre/{id}/modifier',       'admin\LivreController@update_index')->name('livre.update_index');
    Route::post('/administrateur/livre/{id}/modifier',      'admin\LivreController@update')->name('livre.update');
    Route::get('/administrateur/livre/{id}/delete',         'admin\LivreController@delete')->name('livre.delete');
    Route::get('/administrateur/livre/livre_demander',      'admin\LivreController@show_book_ask')->name('livre.show_book_ask');
    Route::get('/administrateur/livre/demande',             'admin\LivreController@get_livre_demander')->name('lecteur.livre_get_livre_demander');
    Route::get('/administrateur/livre/{livre}/valider{user}', 'admin\LivreController@valider_emprunt')->name('livre.valider_emprunt');
    Route::get('/administrateur/livre/{livre}/rejeter_emprunt{user}',  'admin\LivreController@rejeter_emprunt')->name('livre.rejeter_emprunt');
    Route::get('/administrateur/livre/livre_preter',          'admin\LivreController@list_livre_preter')->name('livre.list_livre_preter');
    Route::get('/administrateur/livre/preter',                'admin\LivreController@get_livre_preter')->name('lecteur.livre_get_livre_preter');
    Route::get('/administrateur/livre/{livre}/rendre_livre{user}',     'admin\LivreController@rendre_livre')->name('livre.rendre_livre');
    Route::get('/administrateur/livre/{livre}/renouveler_livre{user}', 'admin\LivreController@renouveler_livre')->name('livre.renouveler_livre');



    Route::get('/administrateur/ajout_auteur',              'admin\AuteurController@index')->name('auteur.index');
    Route::post('/administrateur/ajout_auteur',              'admin\AuteurController@create')->name('auteur.create');

    Route::get('/administrateur/ajout_etudiant',             'admin\EtudiantController@index')->name('etudiant.index');
    Route::post('/administrateur/ajout_etudiant',            'admin\EtudiantController@create')->name('etudiant.create');

    Route::get('/administrateur/ajout_memoire',               'admin\MemoireController@index')->name('memoire.index');
    Route::post('/administrateur/ajout_memoire',              'admin\MemoireController@create')->name('memoire.create');


});


Route::group(['middleware' => ['lecteur']], function () {

    Route::post('/lecteur/logout'   ,                       'authentification\ConnexionController@logout')->name('lecteur.auth.logout');

    Route::get('/lecteur/acceuill',                        'lecteur\HommeLecteurController@index')->name('home.index');
    Route::get('/lecteur/listes_livre',                    'lecteur\LivreController@show')->name('lecteur.livre.show');
    Route::get('/lecteur/listes_livre/{id}/voire_detail',  'lecteur\LivreController@show_detail')->name('lecteur.livre.show_detail');
    Route::get('/lecteur/livre/{id}/emprunter',            'lecteur\LivreController@emprunter')->name('lecteur.livre.emprunter');
    Route::get('/lecteur/livre/{id}/reserver',             'lecteur\LivreController@reserver')->name('lecteur.livre.reserver');
    Route::post('/lecteur/livre/{id}enrigistre_resrevation','lecteur\LivreController@enrigistre_resrevation')->name('lecteur.livre.enrigistre_resrevation');
    Route::get('/lecteur/mes_livres',                      'lecteur\LivreController@mes_livres_emprunte')->name('lecteur.livre.mes_livres_emprunte');
    Route::get('/lecteur/mes_livres/{livre}/{notification}','lecteur\LivreController@show_notificationEmprunter')->name('lecteur.livre.mes_livres_emprunte_notif');



    Route::get('/lecteur/edit_profile',                     'lecteur\ProfileController@index')->name('lecteur.profile.index');
    Route::post('/lecteur/update_image',                    'lecteur\ProfileController@update_image')->name('lecteur.profile.update_image');
    Route::post('/lecteur/update_email',                    'lecteur\ProfileController@update_email')->name('lecteur.profile.update_email');
    Route::post('/lecteur/update_password',                 'lecteur\ProfileController@update_password')->name('lecteur.profile.update_password');


    Route::get('/forum',                            'forum\MessageController@index')->name('lecteur.forum.index');
    Route::post('/forum/create',                    'forum\MessageController@store')->name('lecteur.forum.store');
    Route::get('/forum/message/{message}',           'forum\MessageController@show')->name('lecteur.forum.show');
    Route::post('/forum/edit/{message}',            'forum\MessageController@update')->name('lecteur.forum.update');
    Route::get('/forum/delete/{message}',           'forum\MessageController@destroy')->name('lecteur.forum.delete');
    Route::get('/forum/retour',                      'forum\MessageController@return')->name('lecteur.forum.return');


    Route::post('/forum/commentaire/{message}',            'forum\CommentaireController@store')->name('forum.comment.store');
    Route::post('/forum/commentaire/repondre/{commentaire}','forum\CommentaireController@store_reponse')->name('forum.comment.store_reponse');

    Route::get('/forum/nouveau_notification/{message}/{notification}',   'forum\MessageController@show_notification')->name('lecteur.forum.show_notification');

});





