<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminEmployeeController extends Controller
{

    public function index(){
        if (Auth::user()->cannot('ViewAny',User::class)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        $employees = User::where('is_admin',0)->paginate(10);
        return EmployeeResource::collection($employees);
    }
    public function store(Request $request){
        if (Auth::user()->cannot('create',User::class)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        $request['password'] = Hash::make($request['password']);
        $Employee = User::create($request->all());
        return new EmployeeResource($Employee);
    }
    public function update(Request $request,User $user){
        if (Auth::user()->cannot('update',$user)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        $request->has('password') ?  $request['password'] = Hash::make($request['password']) : '';
        $user->update($request->all());
        return new EmployeeResource($user);
    }
    public function show(Request $request,User $user){
        if (Auth::user()->cannot('view',$user)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        return new EmployeeResource($user);
    }
    public function destroy(User $user){
        if (Auth::user()->cannot('delete',$user)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        $user->delete();
        return response(['Message'=>'Deleted Successfully'],200);
    }
}
