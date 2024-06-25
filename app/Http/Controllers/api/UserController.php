<?php


namespace App\Http\Controllers\api;
use App\Http\Requests\UsereRequest;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index()
    {
$user=User::all();
return response()->json(["status"=>"done","data"=>$user]);

       
    }
    public function store(UsereRequest $request)
    {
        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),

        ]);
        $token=$user->createToken("token")->plainTextToken;
        return response()->json(["status"=>"done","data"=>["token"=>$token]],201);

    }
    
    public function show(string $id)
    {
        $user=User::find($id);
        if($user){
            return response()->json(["status"=>"done","data"=>$user]);
        }else{
            return response()->json(["status"=>"error","message"=>"User not found"]);
        }
    }

    
    public function update(UsereRequest $request, string $id)
    {
        $user=User::find($id);
        if($user){
            $user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
               
            ]);
            return response()->json(["status"=>"done","message"=>"User updated successfully"]);
        } else{
            return response()->json(["status"=>"error","message"=>"User not found"]);
        }
    }

    public function destroy(string $id)
    {
        $user=User::find($id);
        if($user){
            $user->delete();
            return response()->json(["status"=>"done","message"=>"User deleted successfully"]);
        } else{
            return response()->json(["status"=>"error","message"=>"User not found"]);
    
    }}
}
