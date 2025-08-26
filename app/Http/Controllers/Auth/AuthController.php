<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login(Request $request) {   

        $user = User::query()->where('email', $request['email'])->first();

        if(is_null($user)){
            $response = [ "msg" => "User não encontrado !"];    
            return json_encode($response,401);
        }

        if(!Hash::check($request['password'],$user->password)){                            
            return response()->json(["message" => "Senha incorreta, tente novamente!"],401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return json_encode(['access_token' => $token, 'token_type' => 'Bearer'],200);  
    }


public function change_password(Request $request){
  
$fields = $request->validate([ 'email' => 'required', 'password' => 'required']);
       


// verify old password
$user = User::query()->where('email', $fields['email'])->first();


if(Hash::check($fields['password'], $user->password)){   
    $user->password = bcrypt($fields['password']);
    $user->save();
    return $user;

}else{   
    return response()->json(['message' => "A senha antiga não corresponte com a digitada, tente novamente!"], 400);
}

}

}
