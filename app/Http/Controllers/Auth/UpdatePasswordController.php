<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    /*
     * Ensure the user is signed in to access this page
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public static function update(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword) || $hashedPassword === null) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $request->session()->flash('success', 'Your password has been changed.');

            return back();
        }

        $request->session()->flash('failure', 'Your password has not been changed.');

        return back();
    }

    public function showPasswordUpdateForm()
    {
        return view('auth.passwords.update');
    }
}
