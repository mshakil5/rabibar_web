<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });


//agent part start
Route::group(['prefix' =>'agent/', 'middleware' => ['auth', 'is_agent']], function(){
    Route::get('dashboard', [HomeController::class, 'agentHome'])->name('agent.dashboard')->middleware('is_agent');
    //profile
    Route::get('/profile', [AgentController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AgentController::class, 'agentProfileUpdate']);
    Route::post('changepassword', [AgentController::class, 'changeAgentPassword']);
    Route::put('image/{id}', [AgentController::class, 'agentImageUpload']);
    //profile end
});
//agent part end

//user part start
Route::group(['middleware' => ['auth', 'is_user']], function(){
    Route::get('user/dashboard', [HomeController::class, 'userHome'])->name('user.dashboard')->middleware('is_user');
    //profile
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('user/profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::post('user/profile/{id}', [UserController::class, 'userProfileUpdate']);
    Route::get('user/password/edit', [UserController::class, 'passwordEdit'])->name('profile.pwdedit');
    Route::post('user/changepassword', [UserController::class, 'changeUserPassword']);
    Route::put('user/image/{id}', [UserController::class, 'userImageUpload']);
    //profile end

    //comment post
    Route::post('/user/blog-comment', [App\Http\Controllers\BlogController::class, 'blogPost'])->name('blog.comment');
    Route::post('/user/blog-reply', [App\Http\Controllers\BlogController::class, 'blogReplyPost'])->name('blog.reply');

    //quiz edit
    Route::get('user/quiz-edit', [QuizController::class, 'quizedit'])->name('quiz.edit');
    Route::get('user/quiz/edit/{id}', [QuizController::class, 'editquiz']);
    Route::post('user/quiz-update/{id}', [QuizController::class, 'quizupdate']);

    Route::get('user/quiz-result', [QuizController::class, 'quizResult'])->name('quiz.result');
    Route::get('user/quiz-winner', [QuizController::class, 'quizWinner'])->name('quiz.winner');
    Route::get('user/quiz-winner/{id}', [QuizController::class, 'quizWinnerDetails'])->name('user.winnershow');

    //referal
    Route::get('user/referal', [UserController::class, 'qreferral'])->name('user.referal');
    Route::get('user/referal-friend', [UserController::class, 'qreferralFriend'])->name('user.referal.friend');
    Route::post('user/referal-mail-send', [UserController::class, 'qreferralMailSend']);




});
//user part end
Route::get('/user/varify/{id}', [IndexController::class, 'varify_user'])->name('varify_user');
Route::post('/user/varified', [IndexController::class, 'varifiedconfirm'])->name('user.varified');


Auth::routes();

//user registration
Route::post('user/register', [RegisterController::class, 'userRegistration']);

// Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('mainhome');
Route::get('/', [App\Http\Controllers\BlogController::class, 'videoblogShow'])->name('mainhome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'blogShow'])->name('blog');
Route::get('/blog-details/{id}', [App\Http\Controllers\BlogController::class, 'blogdetails'])->name('blog.details');

Route::get('/aboutus', [App\Http\Controllers\IndexController::class, 'aboutus'])->name('frontend.about');
Route::get('/terms-&-conditions', [App\Http\Controllers\IndexController::class, 'terms'])->name('frontend.terms');
Route::get('/privacy-&-policy', [App\Http\Controllers\IndexController::class, 'privacy'])->name('frontend.privacy');
Route::get('/contact', [App\Http\Controllers\IndexController::class, 'contact'])->name('frontend.contact');
Route::post('/contact', [App\Http\Controllers\IndexController::class, 'contactCreate']);
Route::get('/spinner', [App\Http\Controllers\IndexController::class, 'spinner'])->name('frontend.spinner');
// video blog show
Route::get('/video-blog', [App\Http\Controllers\BlogController::class, 'videoblogShow'])->name('frontend.videoblog');


//quiz insert
Route::post('/quiz-answer', [App\Http\Controllers\IndexController::class, 'registeredQuiz']);

//facebook login

Route::get('auth/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirect']);
Route::get('auth/facebook/callback',  [App\Http\Controllers\Auth\LoginController::class, 'callback']);

//home page redirect
Route::get('user-login', [App\Http\Controllers\Auth\LoginController::class, 'redirecthome'])->name('loginredirect');

// password reset
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// password reset Mobile otp
Route::get('forget-password/{phone}', [ForgotPasswordController::class, 'varify_otp'])->name('varify_otp');
Route::post('forget-password/verify', [ForgotPasswordController::class, 'varify_code'])->name('otp.verify');
Route::get('forget-password/verify/{phone}', [ForgotPasswordController::class, 'shwotpfrom'])->name('otp.varified');
Route::post('forget-password/verify/sucess', [ForgotPasswordController::class, 'varified'])->name('reset.password.otp');

