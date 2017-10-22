<?php

namespace App\Http\Controllers;

use App\Fonction;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        $fonction = Fonction::findOrFail(Auth::user()->idfonctions);
        $infouser = ['user'=>$user, 'fonction'=>$fonction];
        return json_encode($infouser);
    }

    public function getUsers(){
        $users = User::all();
         return Response::json($users);
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function update($id, Request $request){

    }

    public function show($id){

    }

    public function destroy($id){

    }

    public function edit($id){

    }
}
