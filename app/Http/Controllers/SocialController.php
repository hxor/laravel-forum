<?php

namespace App\Http\Controllers;

use SocialAuth;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function auth($provider)
    {
        return SocialAuth::authorize($provider);
    }

    public function authRedirect($provider)
    {
        SocialAuth::login($provider, function ($user, $detail) {
            $user->avatar = $detail->avatar;
            $user->email = $detail->email;
            $user->name = $detail->full_name;
            $user->save();
        });

        return redirect('/home');
    }
}
