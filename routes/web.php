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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use Facade\Ignition\Http\Controllers\ExecuteSolutionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\EnqueteController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\UserChangeController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EnregistrementController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


//Route::get('/execute-solution', [ExecuteSolutionController::class, 'someMethod']);

Route::get('/', [HomeController::class, 'index'])->name('welcome');   //home teo fa misy route mitovy aminy

// Route de la page de connexion (gérée par Laravel Auth)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route de déconnexion
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route pour afficher le formulaire d'inscription
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route pour gérer l'inscription
Route::post('register', [RegisterController::class, 'register']);

// Mot de passe oublié
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Auth::routes(['verify' => true]);

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Route pour le front office (Utilisateur classique)
    Route::get('front-office', [FrontOfficeController::class, 'index'])->name('front-office')->middleware('auth');
    
    // Route pour vérifier si l'utilisateur appartient à une direction et rediriger
    Route::get('direction', [DirectionController::class, 'index'])->name('direction.index')->middleware('auth');

    // Route pour afficher la page de la direction
    Route::get('/direction/{directionId}/{enqueteId}', [DirectionController::class, 'show'])->name('direction.show');

    // Afficher le formulaire de téléchargement
    Route::get('/direction/{directionId}/upload', [DirectionController::class, 'showUploadForm'])->name('direction.upload')->middleware('auth');
    Route::post('/direction/uploadFile', [DirectionController::class, 'uploadFile'])->name('direction.uploadFile')->middleware('auth');

    // Route pour le superadmin (accès total)
    Route::get('superadmin', [SuperadminController::class, 'index'])->name('superadmin')->middleware('auth');
    Route::get('superadmin', [SuperadminController::class, 'index'])->name('superadmin')->middleware('superadmin');

    //Route Recherche Listdownload  
    Route::get('/downloads/{file}/search', [DownloadController::class, 'search'])->name('downloads.search');
    Route::get('/downloads/{file}', [FrontOfficeController::class, 'frontsearch'])->name('frontsearch');
    
    // Upload and download file
    Route::middleware('auth')->group(function () {
        // Pour les utilisateurs qui peuvent uploader un fichier
        Route::get('files/upload', [FileController::class, 'create'])->name('files.create');
        Route::post('files/upload', [FileController::class, 'store'])->name('files.store');
        Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy'); 
        Route::get('/files/{file}/downloads', [FileController::class, 'showfiledownload'])->name('files.downloads');
        Route::post('/files/{id}/publish', [FileController::class, 'publish'])->name('files.publish');
        Route::post('/files/{id}/unpublish', [FileController::class, 'unpublish'])->name('files.unpublish');
        Route::get('files/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
        Route::put('files/{file}', [FileController::class, 'update'])->name('files.update');

        Route::patch('/downloads/{download}/valider', [DownloadController::class, 'valider'])->name('downloads.valider');
        Route::patch('/downloads/{download}/rejeter', [DownloadController::class, 'rejeter'])->name('downloads.rejeter');
        Route::post('/downloads/demande/{fileId}', [DownloadController::class, 'demande'])->name('downloads.demande');
        Route::post('/downloads/demandeEnquetes/{file}', [DownloadController::class, 'demandeEnquetes'])->name('downloads.demandeEnquetes');
        Route::post('/downloads/demandeThemes/{file}', [DownloadController::class, 'demandeThemes'])->name('downloads.demandeThemes');
        Route::get('/downloads-en-attente', [DownloadController::class, 'getDownloadsEnAttente']);
        Route::get('/historique', [DownloadController::class, 'validation'])->name('textes.index');

        Route::post('/rapports', [RapportController::class, 'store'])->name('downloads.uploadRapport');

        Route::get('/rapports/download/{rapport}', [RapportController::class, 'download'])
                ->name('rapports.download');
        Route::delete('/rapports/delete/{download}', [RapportController::class, 'destroy'])->name('rapports.delete');

        Route::post('/enquete/create', [EnqueteController::class, 'store'])->name('enquete.store');
        Route::get('/enquete/index', [EnqueteController::class, 'index'])->name('enquete.index');
        Route::delete('/enquetes/{id}', [EnqueteController::class, 'destroy'])->name('enquete.destroy');
        Route::get('/enquetes/{enqueteId}', [EnqueteController::class, 'showMicrodatas'])->name('enquete.show'); 
        Route::get('enquete/{id}/edit', [EnqueteController::class, 'edit'])->name('enquete.edit');
        Route::put('enquete/{id}', [EnqueteController::class, 'update'])->name('enquete.update');

        Route::post('/theme/create', [ThemeController::class, 'store'])->name('themes.store');
        Route::get('/theme/index', [ThemeController::class, 'index'])->name('themes.index');
        Route::delete('/themes/{id}', [ThemeController::class, 'destroy'])->name('themes.destroy');
        Route::get('themes/{theme}/edit', [ThemeController::class, 'edit'])->name('themes.edit');
        Route::put('themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');

        Route::get('files', [FileController::class, 'index'])->name('files.index');
        Route::get('files/{file}', [FileController::class, 'show'])->name('files.show');

        Route::get('/profile', [UserController::class, 'show'])->name('profile');
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

        Route::get('/historiques', [HistoriqueController::class, 'show'])->name('historiques.index');
        Route::get('/notifications', [HistoriqueController::class, 'notif'])->name('notifications.index');
        Route::get('/enquetes', [FrontOfficeController::class, 'showEnquetes'])->name('showEnquetes');
        Route::get('/enquetes/{enqueteId}', [FrontOfficeController::class, 'showFichiers'])->name('frontOffice.showFichiers');
        Route::post('/enquete/{enqueteId}/reset-new-data', [FrontOfficeController::class, 'resetHasNewData'])->name('enquete.resetHasNewData');
        Route::get('/historique', [FrontOfficeController::class, 'afficherHistorique'])->name('historique');
        Route::get('/enquetes/{id}', [FrontOfficeController::class, 'enqueteShow'])->name('enquetes.show.enquetes');
        Route::get('/themes/{themeId}', [FrontOfficeController::class, 'showFichiersParTheme'])->name('showTheme');
        Route::get('/themes/fichiers', [FileController::class, 'search'])->name('themes.fichiers');
    });

    //Route du téléchargement fichier sans passer par mail
    Route::post('/file/request/{file}', [FileController::class, 'requestDownload'])->name('file.request');

    //Route lien de telechargement fichier via mail
   // Route::get('/file/request-download/{file}', [FileController::class, 'requestDownload'])->name('file.request');
    Route::post('/file/send-download-link/{file}', [FileController::class, 'sendDownloadLink'])->name('file.send');
    Route::get('/file/download/{token}', [FileController::class, 'download'])->name('file.download');

    Route::middleware('auth', 'admin')->group(function () {
        // Pour l'admin qui valide ou rejette un fichier
        Route::patch('files/{file}/validate/{status}', [FileController::class, 'updateStatus'])->name('files.updateStatus');
    });
});

// stagiaire
Route::middleware('auth')->group(function () {
    Route::get('/gestion-utilisateur', [UserChangeController::class, 'index'])->name('users.index');
    Route::post('/gestion-utilisateur/{user}/changer-role', [UserChangeController::class, 'changerRole'])->name('users.changerRole');
});



Route::get('sauvegarder/create/{file_id}', [EnregistrementController::class, 'create'])->name('sauvegarder.create2');

Route::post('sauvegarder', [EnregistrementController::class, 'store'])->name('sauvegarder.store');
