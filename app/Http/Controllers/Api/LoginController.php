<?php

namespace App\Http\Controllers\Api;

use App\Model\Customer;
use App\Model\UserToken;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{

    // Hàm xác thực jwt token
    public function authendicationJwt($token)
    {
        $userToken = UserToken::where('token', '=', $token)->first();
        $user = null;
        if ($userToken) {
            $user = Customer::find($userToken->user_id);
        }
        return $user;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20',
            'name'  => 'required|string|max:191'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '400', 'errors' => $validator->errors()->getMessages()], 400);
        }
        $phone = $request->get('phone');

        $user = Customer::where('phone', $phone)->first();

        if (!$user) {
//            return response()->json(['status' => 401, 'error' => 'invalid credentials'], 401);
            $user = new Customer();
            $user->phone = $phone;
        }
        //update name of user
        $user->name = $request->get('name');
        $user->save();

        $token = md5($phone);

        if ($token) {

            $this->checkUserToken($token,$user->id);

            return response()->json(['status' => 200, 'user' => $user, 'token' => $token], 200);
        }
        return response()->json(['status' => 401, 'error' => 'Login false'], 401);
    }
    // Login funtion
    // Input: $request:
    //           email
    //           password
    public function loginV2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '400', 'errors' => $validator->errors()->getMessages()], 400);
        }

        $user = Customer::where('email', '=', $request->email)->first();
        if (!$user) {
            return response()->json(['status' => 401, 'error' => 'invalid credentials'], 401);
        }
        // Save password
        if ($user->prepared_password && $request->password == $user->prepared_password) {
            $user->password = bcrypt($request->password);
            $user->prepared_password = null;
            $user->save();
        }

        $credentials = $request->only('email', 'password');
        $check_pass = Hash::check($request->get('password'),$user->password);
        if (!$check_pass){
            return response()->json(['status' => '400', 'errors' => 'Wrong password'], 400);
        }
        $token = auth('api')->attempt($credentials);
        if ($token) {

            $this->checkUserToken($token,$user->id);

            return response()->json(['status' => 200, 'user' => $user, 'token' => $token], 200);
        }
        return response()->json(['status' => 401, 'error' => 'Login false'], 401);
    }
    public function checkUserToken($token, $user_id){
        $userToken = UserToken::where('user_id', $user_id)->first();
        if (!$userToken) {
            $userToken = new UserToken();
            $userToken->user_id = $user_id;
        }
        $userToken->token = $token;
        $userToken->save();

        return $userToken;
    }
    // Lấy ra thông tin user khi phiên làm việc trên local vẫn có
    public function autoLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '400', 'errors' => $validator->errors()->getMessages() ], 400);
        }

        $user = Customer::find($request->user_id);

        $token = UserToken::where('user_id', $request->user_id)->first();

        if ($user && $token) {

            return response()->json(['status' => 200, 'user' => $user, 'token' => $token->token], 200);
        }

        return response()->json(['status' => 401, 'error' => 'invalid_credentials'], 401);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '400', 'errors' => "validate_fail"], 400);
        }

        $user = Users::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 404, 'error' => 'Email invalid', 'email' => $request->email], 404);
        }
        if ($user->is_lock == 1 || $user->is_blocked == 1) {
            return response()->json(['status' => 404, 'error' => 'User blocked', 'email' => $request->email], 404);
        }
        $user->prepared_password = str_random(6);
        $user->save();

        Mail::send(new ForgotPassword($user));

        return response()->json(['status' => 200], 200);
    }

}
