<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Files;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (!is_dir('temp')) {
            mkdir('temp', 0777);
        }
        $path = 'temp/'.uniqid().'.png';

        $background = '#'.dechex(rand(0x000000, 0xFFFFFF));
        $img = new \LasseRafn\InitialAvatarGenerator\InitialAvatar();
        $image = $img->name($data['name'])->size(120)->background($background)->generate();
        $image->save($path);
        if (file_exists($path)) {
            $avatar = Files::upload_url(asset($path), 'users', 'avatar-'.$user->id);
            if ($avatar) {
                $user->avatar = $avatar;
                $user->save();
            }
            unlink($path);
        }

        return $user;
    }
}
