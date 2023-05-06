<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UserTrait;

use App\Models\User;
use DB; 
use Carbon\Carbon;
use App\Mail\ForgotPassword;

class ForgotPasswordController extends BaseController
{
    use UserTrait;

    protected function sendResetLinkResponse(Request $request)
    {
        $input = $request->only('email');

        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $email = $request->email;

        $user = User::where('email', $email)->get();

        if ($user->count() == 0) {
            return $this->sendError('USER_NOT_FOUND', null, 404);
        }

        // $token = Str::random(64);
        $randomPasswordString = generateRandomString();

        if($user){
            Mail::to($email)->send(new ForgotPassword($email, $randomPasswordString));

            if(Mail::failures())  return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => "Email fails",
                    'status_code' => 422,
                ], 200
            );

            // addLog("edit"," Collector [".auth()->user()->email."] reset password via email","application");


            User::where('email', $email)->update(['password' => Hash::make($randomPasswordString)]);

            return new JsonResponse(
                [
                    'status' => 'success',
                    'message' => "Password reset mail successfully sent !!",
                    'status_code' => 200,
                ], 200
            );
        } else {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => "The provided email is not in our records, please try again.",
                    'status_code' => 422,
                ], 200
            );
        }
    }
}
