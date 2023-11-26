<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Providers\FortifyServiceProvider;

use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\Admin\OnlineBankController as AdminOnlineBankController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\TransferMethodController as AdminTransferMethodController;
use App\Http\Controllers\Admin\TransferController as AdminTransferController;
use App\Http\Controllers\Admin\TransferTrancheController as AdminTransferTrancheController;
use App\Http\Controllers\Admin\TransferTrancheInstanceController as AdminTransferTrancheInstanceController;
use App\Http\Controllers\Admin\ArchiveController as AdminArchiveController;
use App\Http\Controllers\Admin\ReceivePayMethodController as AdminReceivePayMethodController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferTrancheController;
use App\Http\Controllers\UserController;
use App\Models\Country;
use App\Models\Devise;
use App\Models\TransferMethod;

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
//General: cms
Route::get('/a-propos-de-nous', [CmsController::class,'about'])
       ->name("about");
Route::get('/foire-aux-questions', [CmsController::class,'faq'])
       ->name("faq");
Route::get('/actualites', [CmsController::class,'news'])
       ->name("news");
Route::get('/actualites/{slug?}', [CmsController::class,'news_detail'])
       ->where('slug','[a-z0-9\-]+')
       ->name("news.detail");
Route::get('/emploi', function(){ return view('emploi'); } )
       ->name("emploi");
Route::get('/comment-ca-marche', function(){ return view('how-work'); } )
       ->name("how.work");
Route::get('/politique-de-confidentialite', [CmsController::class,'privacy'])
       ->name("privacy");
Route::get('/mentions-legales', [CmsController::class,'terms'])
       ->name("terms");
Route::get('/conditions-d-utilisation', [CmsController::class,'conditions'])
       ->name("conditions");
Route::get('/nos-services', [CmsController::class,'services'])
       ->name("services");
Route::get('/securite', [CmsController::class,'security'])
       ->name("security");
Route::get('/contact', [CmsController::class,'contact_view'])
       ->name("contact");
Route::post('/contact-post', [CmsController::class,'contact_post'])
       ->name("contact.post");
Route::get('/emploi', [CmsController::class,'emploi'])
       ->name("emploi");
//
Route::get('/envoyer-de-l-argent', function () { return view('send_money_online');  })
->name('send.online');
Route::get('/envoyer-de-l-argent-depuis-agence', function () { return view('send_money_agence');  })
->name('send.agence');
Route::get('/envoyer-un-gros-montant', function () { return view('send_money_many');  })
->name('send.many');
Route::get('/recevoir-de-l-argent', function () { return view('receive_money');  })
->name('receive.money');
//end General CMS

Route::get('/', function () { 
    return view('acceuil',[
           'page_name'=>"dashboard",
           "devises"=>Devise::all(),
	   "countries"=>Country::orderBy('name')->get(),
           "transfertMethod"=>TransferMethod::all(),
       ]);  
})->name('home');
Route::get('/inscription-personnel', function () { 
       return view('auth.registerIndividual'); 
})->name('register.personnel');

//Pour les administrateurs
Route::get('/login-admin', function () { 
       return view('auth.adminLogin'); 
})->name('admin.login');

Route::group( [ 'middleware'=> ['authGroup', 'adminAcces'] , 'prefix'=>'admin' ],function(){

    Route::name("admin.")->group(function(){
        // home
        Route::get('/home', [AdminHomeController::class,'home'])->name("home");
        Route::name('profile.')->group(function(){
           Route::prefix('/profile')->group(function(){
              Route::get('/',[AdminProfileController::class,'index'])->name('home');

              Route::post('/update-login',[AdminProfileController::class,'updateLogin'])->name('update_login');
              Route::post('/update-password',[AdminProfileController::class,'updatePassword'])->name('update_password');
              Route::post('/update-name',[AdminProfileController::class,'updateName'])->name('update_name');
              Route::post('/update-photo',[AdminProfileController::class,'updateProfileImage'])->name('update_photo');
              Route::get('/delete-photo',[AdminProfileController::class,'DeletePhotoProfil'])->name('delete_photo');
           });
        });
        //user
        Route::name("user.")->group(function(){

            Route::prefix("/user")->group(function(){

                Route::post('/role-by-admin/{id}',[AdminUserController::class,'adminGiveRole'])
                      ->name("role.admin")
                      ->where("id","[0-9]+");

                Route::get("/list",[AdminUserController::class,'list'])->name('home');
                Route::get("/list-admin",[AdminUserController::class,'list_admin'])->name('home.admin');
                Route::get("/profile/{id?}",[AdminUserController::class,'profile'])
                       ->name('profile')
                       ->where("id","[0-9]+");
                Route::get("/profile/{id?}/deposit",[AdminUserController::class,'deposit_view'])
                        ->name('deposit')
                        ->where("id","[0-9]+");
                Route::post("/profile/{id?}/deposit",[AdminUserController::class,'deposit'])
                        ->name('deposit.post')
                        ->where("id","[0-9]+");
                Route::get("/profile/{id?}/withdraw",[AdminUserController::class,'withdraw_view'])
                       ->name('withdraw')
                       ->where("id","[0-9]+");
                Route::post("/profile/{id?}/withdraw",[AdminUserController::class,'withdraw'])
                       ->name('withdraw.post')
                       ->where("id","[0-9]+");
                Route::get("/block-account/{id?}",[AdminUserController::class,'blockAccount'])
                       ->name('block')
                       ->where("id","[0-9]+");
                Route::get("/unblock-account/{id?}",[AdminUserController::class,'unblockAccount'])
                       ->name('unblock')
                       ->where("id","[0-9]+");
                Route::get("/assign-role-admin/{id?}",[AdminUserController::class,'assignRoleAdmin'])
                       ->name('grant_admin')
                       ->where("id","[0-9]+");
                Route::get("/revoke-admin/{id?}",[AdminUserController::class,'revokeAdmin'])
                       ->name('revoke_admin')
                       ->where("id","[0-9]+");

            });
        });
        //news
        Route::name("news.")->group(function(){
            Route::prefix("/news")->group(function(){

                Route::get("/list",[AdminNewsController::class,'list'])->name('home');
                Route::get("/create",[AdminNewsController::class,'create_view'])
                       ->name('new');
                Route::post("/create",[AdminNewsController::class,'create'])
                       ->name('new.post');
                Route::get("/edit/{id?}",[AdminNewsController::class,'edit_view'])
                       ->name('edit')
                       ->where("id","[0-9]+");
                Route::post("/edit/{id?}",[AdminNewsController::class,'edit'])
                       ->name('edit.post')
                       ->where("id","[0-9]+");
                Route::post("/delete/{id?}",[AdminNewsController::class,'delete'])
                       ->name('delete')
                       ->where("id","[0-9]+");
                Route::get("/show/{id?}",[AdminNewsController::class,'show'])
                       ->name('show')
                       ->where("id","[0-9]+");
            });

        });
        //cuurency // devises
        Route::name("currency.")->group(function(){
              Route::prefix("/currency")->group(function(){

                  Route::get("/list",[AdminCurrencyController::class,'list'])->name('home');
                  Route::get("/create",[AdminCurrencyController::class,'create_view'])
                         ->name('new');
                  Route::post("/create",[AdminCurrencyController::class,'create'])
                         ->name('new.post');
                  Route::get("/edit/{id?}",[AdminCurrencyController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminCurrencyController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+");
                  Route::post("/delete/{id?}",[AdminCurrencyController::class,'delete'])
                         ->name('delete')
                         ->where("id","[0-9]+");
              });

       });
       // Receive method paymement
       Route::name("receive_pay_method.")->group(function(){
              Route::prefix("/receive-payment-method")->group(function(){

                  Route::get("/list",[AdminReceivePayMethodController::class,'list'])->name('home');
                  Route::get("/create",[AdminReceivePayMethodController::class,'create_view'])
                         ->name('new');
                  Route::post("/create",[AdminReceivePayMethodController::class,'create'])
                         ->name('new.post');
                  Route::get("/edit/{id?}",[AdminReceivePayMethodController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminReceivePayMethodController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+");
                  Route::post("/delete/{id?}",[AdminReceivePayMethodController::class,'delete'])
                         ->name('delete')
                         ->where("id","[0-9]+");
              });

       });
       //PAYS
       Route::name("country.")->group(function(){
              Route::prefix("/country")->group(function(){

                  Route::get("/list",[AdminCountryController::class,'list'])
                  ->name('home');
                  Route::get("/create",[AdminCountryController::class,'create_view'])
                         ->name('new');
                  Route::post("/create",[AdminCountryController::class,'create'])
                         ->name('new.post');
                  Route::get("/edit/{id?}",[AdminCountryController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminCountryController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+");
                  Route::post("/delete/{id?}",[AdminCountryController::class,'delete'])
                         ->name('delete')
                         ->where("id","[0-9]+");
              });

          });
       //bank
       Route::name("bank.")->group(function(){
              Route::prefix("/bank")->group(function(){

                  Route::get("/list",[AdminOnlineBankController::class,'list'])->name('home');
                  Route::get("/create",[AdminOnlineBankController::class,'create_view'])
                         ->name('new');
                  Route::post("/create",[AdminOnlineBankController::class,'create'])
                         ->name('new.post');
                  Route::get("/edit/{id?}",[AdminOnlineBankController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminOnlineBankController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+");
                  Route::post("/delete/{id?}",[AdminOnlineBankController::class,'delete'])
                         ->name('delete')
                         ->where("id","[0-9]+");
              });

       });
      
       // transfer
       Route::name("transfer.")->group(function(){
              Route::prefix("/transfer")->group(function(){
                  Route::get("/list",[AdminTransferController::class,'list'])->name('home');
                  Route::post("/mark-progress/{id?}",[AdminTransferController::class,'markProgress'])
                         ->name('inprogress')->where("id","[0-9]+");
                  Route::post("/confirm/{id?}",[AdminTransferController::class,'confirm'])
                         ->name('confirm')->where("id","[0-9]+");
                  Route::get("/rejet-v/{id?}",[AdminTransferController::class,'reject_view'])
                         ->name('reject')
                         ->where("id","[0-9]+");
                  Route::post("/rejet/{id?}",[AdminTransferController::class,'reject'])
                         ->name('reject.post')
                         ->where("id","[0-9]+");
                  Route::get("/detail/{id?}",[AdminTransferController::class,'detail'])
                         ->name('detail')
                         ->where("id","[0-9]+");
    
              });
           });

       // transfert méthode
       Route::name("transfer.method.")->group(function(){
              Route::prefix("/transfer/method")->group(function(){
                  Route::get("/list",[AdminTransferMethodController::class,'list'])
                         ->name('home');
                  Route::get("/edit/{id?}",[AdminTransferMethodController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminTransferMethodController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+");
    
              });
       });

       // transfert tranche
       Route::name("transfer.tranche.")->group(function(){
              Route::prefix("/transfer/tranche")->group(function(){
                  Route::get("/list",[AdminTransferTrancheController::class,'list'])
                         ->name('home');

                  Route::get("/create/{id?}",[AdminTransferTrancheController::class,'create_view'])
                         ->name('new')
                         ->where('id','[0-9]+');
                  Route::post("/create/{id?}",[AdminTransferTrancheController::class,'create'])
                         ->name('new.post')
                         ->where('id','[0-9]+');

                 

                  Route::get("/edit/{id?}",[AdminTransferTrancheController::class,'edit_view'])
                         ->name('edit')
                         ->where("id","[0-9]+");
                  Route::post("/edit/{id?}",[AdminTransferTrancheController::class,'edit'])
                         ->name('edit.post')
                         ->where("id","[0-9]+")
                         ;
                        
                  Route::post("/delete/{id?}",[AdminTransferTrancheController::class,'delete'])
                         ->name('delete')
                         ->where("id","[0-9]+");
                  Route::get("/detail/{id?}",[AdminTransferTrancheController::class,'detail'])
                         ->name('detail')
                         ->where("id","[0-9]+");
                  # *******
                  Route::get("/detail-envoi/{id?}",[AdminTransferTrancheController::class,'detail_envoi'])
                         ->name('detail.envoi')
                         ->where("id","[0-9]+");
                  Route::get("/detail-reception/{id?}",[AdminTransferTrancheController::class,'detail_reception'])
                         ->name('detail.reception')
                         ->where("id","[0-9]+");
              
                  // instance
                  Route::get("/load-recipient-info/{recipient_id?}/{method_id?}",[AdminTransferTrancheInstanceController::class,'loadRecipientInfo'])
                               ->name('load.recipient.info')
                               ->where('recipient_id','[0-9]+')
                               ->where('method_id','[0-9]+');
                  //
                  Route::name("instance.")->group(function(){
                     Route::prefix("/instance/{id}")->group(function(){
                        Route::get("/new",[AdminTransferTrancheInstanceController::class,'create_view'])
                               ->name('new')
                               ->where('id','[0-9]+');
                        Route::post("/new",[AdminTransferTrancheInstanceController::class,'create'])
                               ->name('new.post')
                               ->where('id','[0-9]+');

                        Route::get("/new-reception",[AdminTransferTrancheInstanceController::class,'create_envoi_view'])
                               ->name('new.envoi')
                               ->where('id','[0-9]+');
                        Route::post("/new-env-post",[AdminTransferTrancheInstanceController::class,'create_envoi'])
                               ->name('new.envoi.post')
                               ->where('id','[0-9]+');
                        

                        Route::get("/confirm-g/{instance_id}",[AdminTransferTrancheInstanceController::class,'confirm_view'])
                               ->name('confirm_reception')
                               ->where('id','[0-9]+')
                               ->where('instance_id','[0-9]+');
                        Route::post("/confirm/{instance_id}",[AdminTransferTrancheInstanceController::class,'confirm'])
                               ->name('confirm_reception.post')
                               ->where('id','[0-9]+')
                               ->where('instance_id','[0-9]+');

                        Route::get("/detail/{instance_id}",[AdminTransferTrancheInstanceController::class,'detail'])
                               ->name('detail')
                               ->where('id','[0-9]+')
                               ->where('instance_id','[0-9]+');
                     });
                  });
    
              });
       });

       // Archives

       Route::name("archive.transfer.")->group(function(){
              Route::prefix("/archive/transfer")->group(function(){
                  Route::get("/list",[AdminArchiveController::class,'transferSimpleArchive'])
                         ->name('home');
                 Route::get("/tranche/list",[AdminArchiveController::class,'transferTrancheArchive'])
                         ->name('tranche.home');
                 // operation
                  Route::post("/operate/{id?}",[AdminArchiveController::class,'manageTransferArchive'])
                         ->name('operate')
                         ->where('id','[0-9]+');

                  Route::post("/tranche/operate/{id?}",[AdminArchiveController::class,'manageTransferTrancheArchive'])
                         ->name('tranche.operate')
                         ->where('id','[0-9]+');
    
              });
       });

       // CMS
       Route::name("cms.")->group(function(){
          Route::prefix("/cms")->group(function(){
              Route::get("/home",[AdminCmsController::class,'index_all'])->name('home');
              Route::get("/edit/{id}",[AdminCmsController::class,'edit_view'])
                     ->name('edit')->where("id","[0-9]+");
              Route::post("/edit/{id}",[AdminCmsController::class,'edit'])
                     ->name('edit.post')->where("id","[0-9]+");
              Route::get("/create",[AdminCmsController::class,'create_view'])
                     ->name('create');
              Route::post("/create",[AdminCmsController::class,'create'])
                     ->name('create.post');
              Route::get("/show/{id}",[AdminCmsController::class,'show'])
                     ->name('show')->where("id","[0-9]+");
              Route::post("/delete/{id}",[AdminCmsController::class,'delete'])
                     ->name('delete')->where("id","[0-9]+");

              Route::name('faq.')->group(function(){

                 Route::prefix('/faq')->group(function(){

                     Route::get("/",[AdminCmsController::class,'list_faq'])
                            ->name('home')
                            ;
                            Route::get("/create",[AdminCmsController::class,'create_faq_view'])
                            ->name('new');
                            Route::post("/create",[AdminCmsController::class,'create_faq'])
                                   ->name('new.post');
                            Route::get("/edit/{id?}",[AdminCmsController::class,'edit_faq_view'])
                                   ->name('edit')
                                   ->where("id","[0-9]+");
                            Route::post("/edit/{id?}",[AdminCmsController::class,'edit_faq'])
                                   ->name('edit.post')
                                   ->where("id","[0-9]+");
                            Route::post("/delete/{id?}",[AdminCmsController::class,'delete_faq'])
                                   ->name('delete')
                                   ->where("id","[0-9]+");

                 });

              });

          });
       });
    });

});


//Pour les utilisateurs
Route::group(['middleware'=>[ 'userAcces', 'authGroup', 'verifiedGroup'] ],function(){

    Route::name('u.')->group(function(){
       Route::get('/home', [UserController::class, 'dashboard' ])->name('dashboard');
        Route::get('/profile', [UserController::class, 'profil' ])->name('profil');
        Route::get('/update-profile', [UserController::class, 'Updateprofil' ])->name('update.profil');
        Route::post('/update-profile', [UserController::class, 'SaveProfil' ])->name('profil.save');
        Route::post('/update-account', [UserController::class, 'SavePassword' ])->name('profil.passwordEdit');
        Route::post('/edit-profil-picture',[UserController::class, 'PhotoProfil' ] )->name('pp.save');
        Route::get('/delete-profil-picture',[UserController::class, 'DeletePhotoProfil' ] )->name('pp.delete');

        Route::get('/transactions-history', [TransactionController::class, 'History'])->name('transaction');

        Route::get('/settings', [UserController::class, 'Setting' ] )->name('setting');
        Route::post('/settings-account', [UserController::class, 'SaveSetting' ])->name('save.setting');

        Route::post('/block-account', [UserController::class, 'Inactif' ])->name('desactive.account');

       // Recipient
       Route::name('recipient.')->group(function(){
          Route::prefix('/recipient')->group(function(){
              Route::get('/new',[RecipientController::class,'create_view'])
                     ->name('new');
              Route::post('/new',[RecipientController::class,'create'])
                     ->name('new.post');
              Route::get('/edit/{id}',[RecipientController::class,'edit_view'])
                     ->name('edit')->where("id","[0-9]+");
              Route::post('/edit/{id}',[RecipientController::class,'edit'])
                     ->name('edit.post')->where("id","[0-9]+");
              Route::get('/delete/{id}',[RecipientController::class,'delete'])
                     ->name('delete')->where("id","[0-9]+");
              Route::get('/',[RecipientController::class,'list'])
                     ->name('home');
              // method
              Route::name('method.')->group(function(){

                  Route::prefix("/method/{id}")->group(function(){

                     Route::get('/list',[RecipientController::class,'methods_index'])
                            ->name('list')
                            ->where("id","[0-9]+");
                     Route::get('/new',[RecipientController::class,'create_method_view'])
                            ->name('new')
                            ->where("id","[0-9]+");
                      Route::post('/new-post',[RecipientController::class,'create_method'])
                            ->name('new.post')
                            ->where("id","[0-9]+");
                     Route::get('/edit/{meth_id}',[RecipientController::class,'edit_method_view'])
                            ->name('edit')
                            ->where("id","[0-9]+")
                            ->where("meth_id","[0-9]+");
                     Route::post('/edit/{meth_id}',[RecipientController::class,'edit_method'])
                            ->name('edit.post')
                            ->where("id","[0-9]+")
                            ->where("meth_id","[0-9]+");
                     Route::get('/delete/{meth_id}',[RecipientController::class,'delete_method'])
                            ->name('delete')
                            ->where("id","[0-9]+")
                            ->where("meth_id","[0-9]+");
                  });

              });
          });
       });

       // Transfert
       Route::name('transfer.')->group(function(){
              Route::prefix('/transfer')->group(function(){
                  Route::get('/new-state-1',[TransferController::class,'state1'])
                         ->name('state1');
                  Route::get('/new-method',[TransferController::class,'method1'])
                         ->name('method');
                  Route::post('/new-state-2',[TransferController::class,'state2'])
                         ->name('state2');
                  Route::post('/new-state-end',[TransferController::class,'state3'])
                         ->name('state3');
                  
                  Route::get('/success/{id}',[TransferController::class,'success'])
                         ->name('success')
                         ->where('id','[0-9]+');
                  Route::get('/',[TransferController::class,'list'])
                         ->name('home');
                  Route::get('/detail/{id}',[TransferController::class,'detail'])
                         ->name('show');
              });
       });

       Route::name('transfer.tranche.')->group(function(){
         Route::prefix('/transfer/tranche')->group(function(){
           Route::get('/home',[TransferTrancheController::class,'list'])
                 ->name("home");
           Route::get("/{id}/detail",[TransferTrancheController::class,'detail'])
                 ->name('detail')
                 ->where('id','[0-9]+');
           //
           Route::get("/{id}/detail-envoyes-a-tu",[TransferTrancheController::class,'sendtu'])
                 ->name('detail.send.tu')
                 ->where('id','[0-9]+');
          Route::get("/{id}/detail-envoyes-au-dest",[TransferTrancheController::class,'senddes'])
                 ->name('detail.send.des')
                 ->where('id','[0-9]+');
         });
       });
       
    });


});
