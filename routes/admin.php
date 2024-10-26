<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EmailSendController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\VideoController;

//admin part start
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
    Route::get('dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard')->middleware('is_admin');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end
    //admin registration
    Route::get('register','App\Http\Controllers\Admin\AdminController@adminindex');
    Route::post('register','App\Http\Controllers\Admin\AdminController@adminstore');
    Route::get('register/{id}/edit','App\Http\Controllers\Admin\AdminController@adminedit');
    Route::put('register/{id}','App\Http\Controllers\Admin\AdminController@adminupdate');
    Route::get('register/{id}', 'App\Http\Controllers\Admin\AdminController@admindestroy');
    //admin registration end
    //agent registration
    Route::get('agent-register','App\Http\Controllers\Admin\AdminController@agentindex');
    Route::post('agent-register','App\Http\Controllers\Admin\AdminController@agentstore');
    Route::get('agent-register/{id}/edit','App\Http\Controllers\Admin\AdminController@agentedit');
    Route::put('agent-register/{id}','App\Http\Controllers\Admin\AdminController@agentupdate');
    Route::get('agent-register/{id}', 'App\Http\Controllers\Admin\AdminController@agentdestroy');
    //agent registration end
    //user registration
    Route::get('user-register','App\Http\Controllers\Admin\AdminController@userindex');
    Route::post('user-register','App\Http\Controllers\Admin\AdminController@userstore');
    Route::get('user-register/{id}/edit','App\Http\Controllers\Admin\AdminController@useredit');
    Route::put('user-register/{id}','App\Http\Controllers\Admin\AdminController@userupdate');
    Route::get('user-register/{id}', 'App\Http\Controllers\Admin\AdminController@userdestroy');
    //user registration end
    //code master 
    Route::resource('softcode','App\Http\Controllers\Admin\SoftcodeController');
    Route::resource('master','App\Http\Controllers\Admin\MasterController');
    //code master end
    //company details
    Route::resource('company-detail','App\Http\Controllers\Admin\CompanyDetailController');
    //company details end

    // all user show
    Route::get('/users', [UserController::class, 'userShow'])->name('admin.user.show');
    Route::post('/users', [UserController::class, 'userShow'])->name('admin.user.search');
    Route::post('/newuser', [UserController::class, 'userCreate'])->name('admin.user.create');
    Route::get('/newuser/{id}/edit', [UserController::class, 'userEdit'])->name('admin.user.edit');
    Route::post('/newuser/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
    Route::get('/newuser/{id}', [UserController::class, 'userDelete'])->name('admin.user.delete');
    Route::get('/user-status', [UserController::class, 'changeStatus'])->name('user.status');
    
    // refferal user
    Route::get('/refferal-users', [UserController::class, 'refferalUserShow'])->name('admin.refferaluser.show');
    Route::post('/refferal-users', [UserController::class, 'refferalUserShow'])->name('admin.referraluser.search');
    Route::get('/refferal-users/{id}', [UserController::class, 'refferalUserDetails'])->name('referraluser.view');
    Route::post('/refferal-users/{id}', [UserController::class, 'refferalUserDetails'])->name('referraluser.show');

    Route::resource('role','App\Http\Controllers\RoleController');
    Route::post('roleupdate','App\Http\Controllers\RoleController@roleUpdate');
    Route::resource('staff','App\Http\Controllers\StaffController');

    // quiz add
    Route::resource('quiz','App\Http\Controllers\QuizController');
    Route::get('/quiztype', [QuizController::class, 'quiztype'])->name('quiztype');
    Route::post('/quiztype', [QuizController::class, 'quiztypestore'])->name('quiztype.store');
    Route::get('/quiztype/{id}/edit', [QuizController::class, 'quiztypeedit'])->name('quiztype.edit');
    Route::put('/quiztype/{id}', [QuizController::class, 'quiztypeupdate'])->name('quiztype.update');
    Route::get('/quiztype/{id}', [QuizController::class, 'quiztypedestroy'])->name('quiztype.delete');
    Route::get('/quiz-status', [QuizController::class, 'changeStatus'])->name('quiz.status');

    //quiz participate part 
    Route::get('/question', [QuizController::class, 'question'])->name('question');
    Route::get('/quizparticipate', [QuizController::class, 'qParticipate'])->name('quiz.participate');
    Route::get('/quizparticipate/{id}', [QuizController::class, 'qParticipateDtl'])->name('quiz.participate.details');
    Route::get('/quizparticipates/{id}', [QuizController::class, 'qParticipateSoDtl'])->name('quiz.participate.short-details');
    Route::get('/quiznotparticipate', [QuizController::class, 'qNotParticipate'])->name('quiz.notparticipate');
    Route::get('/quiznotparticipate/{id}', [QuizController::class, 'qNotParticipateDtl'])->name('quiz.notparticipate.details');
    


    // add delete edit quistions
    Route::post('addquestion','App\Http\Controllers\QuizController@addQuestion');
    Route::post('updatequestion','App\Http\Controllers\QuizController@updateQuestion');
    Route::post('deleteqst','App\Http\Controllers\QuizController@deleteQst');
    Route::get('/question/{id}/edit', [QuizController::class, 'editQst']);
    
    // mail   
    Route::get('/mail', [MailController::class, 'mailindex'])->name('mail.index');
    Route::get('/mail/{id}/edit', [MailController::class, 'mailedit'])->name('mail.edit');
    Route::put('/mail/{id}', [MailController::class, 'mailupdate'])->name('mail.update');
    // mail 

    // adv image
    Route::resource('advertisement','App\Http\Controllers\AdvertisementController');

    //blog
    Route::resource('blog','App\Http\Controllers\BlogController');
    Route::get('/blog-category', [BlogController::class, 'blogCategory'])->name('blog.category');
    Route::post('/blog-category', [BlogController::class, 'blogCategoryStore'])->name('blog.category');
    Route::get('/blog-category/{id}/edit', [BlogController::class, 'blogCategoryEdit'])->name('blog.category.edit');
    Route::put('/blog-category/{id}', [BlogController::class, 'blogCategoryUpdate'])->name('blog.category.update');
    Route::get('/blog-category/{id}', [BlogController::class, 'blogCategoryDelete'])->name('blog.category.delete');

    //video blog
    Route::get('/video-blog-category', [BlogController::class, 'videoBlogCategory'])->name('videoblog.category');
    Route::post('/video-blog-category', [BlogController::class, 'videoBlogCategoryStore'])->name('videoblog.category');
    Route::get('/video-blog-category/{id}/edit', [BlogController::class, 'videoBlogCategoryEdit'])->name('videoblog.category.edit');
    Route::post('/video-blog-category/{id}', [BlogController::class, 'videoBlogCategoryUpdate'])->name('videoblog.category.update');
    Route::get('/video-blog-category/{id}', [BlogController::class, 'videoBlogCategoryDelete'])->name('videoblog.category.delete');
    Route::get('/video-blog', [BlogController::class, 'videoBlog'])->name('videoblog');
    Route::post('/video-blog', [BlogController::class, 'videoBlogStore'])->name('videoblog');
    Route::get('/video-blog/{id}/edit', [BlogController::class, 'videoBlogEdit'])->name('videoblog.edit');
    Route::post('/video-blog/{id}', [BlogController::class, 'videoBlogUpdate'])->name('videoblog.update');
    Route::get('/video-blog/{id}', [BlogController::class, 'videoBlogDelete'])->name('videoblog.delete');


    // Notification
    Route::get('/comment', [NotificationController::class, 'comment'])->name('notification.comment');
    Route::get('/comment/{id}', [NotificationController::class, 'destroy'])->name('notification.comment.destroy');
    Route::get('/comment-status', [NotificationController::class, 'changeStatus'])->name('notification.status');

    //reply
    Route::get('/reply', [NotificationController::class, 'reply'])->name('notification.reply');
    Route::get('/reply/{id}', [NotificationController::class, 'replydestroy'])->name('notification.reply.destroy');
    Route::get('/reply-status', [NotificationController::class, 'replychangeStatus'])->name('notification.reply.status');



    // sponsor
    Route::resource('sponsor','App\Http\Controllers\SponsorController');
    Route::get('/sponsor-status', [SponsorController::class, 'changeStatus'])->name('sponsor.status');
    Route::get('/sponsor-assign', [SponsorController::class, 'sponsorassign'])->name('sponsor.assign');
    Route::post('/sponsor-assign', [SponsorController::class, 'sponsorassignStore'])->name('sponsor.assign.store');
    Route::get('/sponsor-assign/{id}/edit', [SponsorController::class, 'sponsorassignEdit'])->name('sponsor.assign.edit');
    Route::put('/sponsor-assign/{id}', [SponsorController::class, 'sponsorassignUpdate'])->name('sponsor.assign.update');
    Route::get('/sponsor-assign/{id}', [SponsorController::class, 'sponsorassignDelete'])->name('sponsor.assign.delete');
    
    Route::get('/sponsor-report', [SponsorController::class, 'sponsorReport'])->name('sponsor.report');
    Route::get('/sponsor-details/{id}', [SponsorController::class, 'sponsorReportDetails']);

    //participate mail send
    Route::post('/email-alluser', [EmailSendController::class, 'userBulkmail']);
    Route::post('/email-allsend', [EmailSendController::class, 'pBulkmail']);
    Route::post('/email-send', [EmailSendController::class, 'pSinglemail']);

    // not participate mail send 
    Route::post('/npemail-allsend', [EmailSendController::class, 'npBulkmail']);
    Route::post('/npemail-send', [EmailSendController::class, 'npSinglemail']);

    //winner show
    Route::get('/winner', [WinnerController::class, 'index'])->name('winner');
    Route::post('/winner', [WinnerController::class, 'store']);
    Route::get('/winner/{id}', [WinnerController::class, 'destroy']);
    Route::get('/winner/{id}/edit', [WinnerController::class, 'edit']);
    Route::post('/winner/{id}', [WinnerController::class, 'update']);

    
    Route::get('/winner/select/{id}', [WinnerController::class, 'SelectWinner'])->name('winner.select');

    //about-us
    Route::resource('about','App\Http\Controllers\AboutController');

    Route::get('/about-title', [AboutController::class, 'aboutTitle'])->name('about.title');
    Route::post('/about-title', [AboutController::class, 'aboutTitleStore'])->name('about.title');
    Route::get('/about-title/{id}/edit', [AboutController::class, 'aboutTitleEdit'])->name('about.title.edit');
    Route::put('/about-title/{id}', [AboutController::class, 'aboutTitleUpdate'])->name('about.title.update');
    Route::get('/about-title/{id}', [AboutController::class, 'aboutTitleDelete'])->name('about.title.delete');

    
    Route::get('/terms', [AboutController::class, 'terms'])->name('terms');
    Route::get('/terms/{id}/edit', [AboutController::class, 'termsEdit'])->name('terms.edit');
    Route::put('/terms/{id}', [AboutController::class, 'termsUpdate'])->name('terms.update');

    Route::get('/privacy', [AboutController::class, 'privacy'])->name('privacy');
    Route::get('/privacy/{id}/edit', [AboutController::class, 'privacyEdit'])->name('privacy.edit');
    Route::put('/privacy/{id}', [AboutController::class, 'privacyUpdate'])->name('privacy.update');

    //contact msg show
    Route::get('/contact-message', [NotificationController::class, 'contactShow'])->name('contact.show');

    // video 
    // Route::resource('video','App\Http\Controllers\VideoController');
    Route::get('/video', [VideoController::class, 'index'])->name('video.index');
    Route::post('/video', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/{id}', [VideoController::class, 'destroy'])->name('video.destroy');

    //email and phone check
    Route::post('/phone_available/check', [UserController::class, 'phonecheck'])->name('phone_available.check');
    Route::post('/email/check', [UserController::class, 'emailcheck'])->name('email.check');



});
//admin part end