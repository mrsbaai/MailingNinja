<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\user;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function updateInfo(Request $request){
        if (null !== Input::get('new_password_confirmation')){
           return $this->changePassword($request);
        }else{

            try {
                $user = user::where('id', '=', $request->id);

                $res = $user->update([
                    'name' => $request->name,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'skype' => $request->skype,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                    'paypal' => $request->paypal,
                    'merchant_id' => $request->merchant_id,
                    'website' => $request->website

                ]);


            } catch(\Illuminate\Database\QueryException $ex){
                flash($ex->getMessage())->error();
                return redirect()->back()->with('account_form_result', '- Error!')->with('account_form_color', 'text-danger');
            }

            flash("Info updated successfully!")->success();
            return redirect()->back();

        }

    }


    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            flash("Your current password does not matches with the password you provided. Please try again.")->error();
            return redirect()->back();
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            flash("New Password cannot be same as your current password. Please choose a different password.")->error();
            return redirect()->back();
        }
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->flat_password = $request->get('new_password');
        $user->save();
        flash("Password changed successfully!")->success();
        return redirect()->back();
    }


}
