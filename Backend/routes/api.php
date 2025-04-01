<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrdersController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Email;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/books/most-viewed',[BookController::class,'MostviewedBooks'],200);
Route::get('/books/oldest-books',[BookController::class,'oldestBooks'],200);
Route::get('/books/newest-books',[BookController::class,'newestBooks'],200);
Route::get('/books/most-liked',[BookController::class,'MostLikedBooks'],200);
Route::get('/books/most-commented',[BookController::class,'MostCommentedBooks'],200);
Route::get('/books/search/{search}',[BookController::class,'searchBooks'],200);
Route::post('/books/{id}/view',[BookController::class,'incrementViews'],200);
Route::get('/books/author/{author}',[BookController::class,'getBooksByAuthor'],200);
Route::apiResource('/books',BookController::class);


Route::middleware([EnsureFrontendRequestsAreStateful::class])->get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
Route::middleware('api')->get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('/users', [AuthController::class, 'users'])->middleware('auth:sanctum');
Route::put('/users/{id}/role', [AuthController::class, 'userRoleUpdate'])->middleware('auth:sanctum','can:view-admin');
Route::put('/users/{id}',[AuthController::class,'update'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('/categories',CategoryController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/orders',[OrdersController::class,'index']);
    Route::post('/orders',[OrdersController::class,'store'])->middleware('verified');
    Route::delete('/orders/{id}',[OrdersController::class,'destroy'])->middleware('can:view-admin','verified');
});

Route::get('/rating',[RatingController::class,'index']);
Route::middleware('auth:sanctum','verified')->group(function(){
    Route::post('/rating',[RatingController::class,'store']);
    Route::get('/rating/{id}',[RatingController::class,'show']);
    Route::put('/rating/{id}',[RatingController::class,'update']);
    Route::delete('/rating/{id}',[RatingController::class,'destroy']);
});


Route::get('/email/verify',function(){
    return response()->json(['message' => 'Email megerősítési link elküldve!']);
})->middleware('auth:sanctum')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}',function(Request $request,$id, $hash){
   $user=User::findOrFail($id);

   if(!hash_equals((string) $hash, sha1($user->getEmailForVerification()))){
       return response()->json(['message' => 'Hibás link'], 400);
   }

   if($user->hasVerifiedEmail()){
    return redirect()->away('http://localhost:3000/login?verified=true&already=true');
   }
   $user->markEmailAsVerified();

    return redirect()->away('http://localhost:3000/login?verified=true');

})->middleware(['signed'])->name('verification.verify');



Route::post('/email/verification-notification', function(Request $request) {
    $user = User::where('email', $request->email)->first();

    if(!$user){
        return response()->json(['message' => 'Felhasználó nem található'], 404);
    }

    if ($user->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email már megerősítve'], 200);
    }

    $user->sendEmailVerificationNotification();
    return response()->json(['message' => 'Email megerősítés elküldve!'], 200);
})->name('verification.send');





 Route::get('/forget-password',function(){
    return response()->json([
        'title' => 'Elfelejtett jelszó',
        'message' => 'Kérjük, adja meg e-mail-címét, hogy a jelszó módosításához szükséges információkat elküldhessük Önnek.'
    ]);
})->middleware('guest')->name('password.request');


 Route::post('/forget-password',function(Request $request){
             $request->validate(['email'=>'required|email']);
          $status=Password::sendResetLink($request->only('email'));

         return $status===Password::ResetLinkSent
         ? response()->json(['status' => 'success', 'message' => __($status)])
         : response()->json(['status' => 'error', 'message' => __($status)], 422);
 })->middleware('guest')->name('password.email');



 Route::get('/reset-password/{token}',function($token,Request $request){
    return response()->json([
        'token' => $token,
        'email' => $request->email
    ]);
})->middleware('guest')->name('password.reset');




Route::post('/reset-password',function(Request $request){
    $request->validate([
        'token'=>'required',
        'email'=>'required|email',
        'password'=>'required|min:8|confirmed'
    ]);

    $status=Password::reset(
        $request->only('email','password','password_confirmation','token'),
        function(User $user,string $password){
            $user->forceFill([
                'password'=>Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status===Password::PasswordReset
    ? response()->json(['status' => 'success', 'message' => __($status)])
    : response()->json(['status' => 'error', 'message' => __($status)], 422);
})->middleware('guest')->name('password.update');



Route::apiResource('/comments',CommentController::class)->middleware('auth:sanctum','verified');
