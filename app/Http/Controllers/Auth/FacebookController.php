<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;
 
class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
        ->scopes(['instagram_basic', 'instagram_manage_comments', 'instagram_manage_insights', 'instagram_public_content'])
        ->redirect();
    }
 
    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($user);
        
        // Chỗ này để check xem nó có chạy hay không
        // dd($user);
 
        Auth::login($authUser, true);
 
        return redirect()->route('home');
    }
 
    private function findOrCreateUser($facebookUser){
        $authUser = User::where('provider_id', $facebookUser->id)->first();
 
        if($authUser){
            return $authUser;
        }
 
        return User::create([
            'name' => $facebookUser->name,
            'password' => $facebookUser->token,
            'email' => $facebookUser->email,
            'provider_id' => $facebookUser->id,
            'provider' => $facebookUser->id,
        ]);
    }
}
