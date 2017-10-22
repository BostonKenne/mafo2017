<?php

namespace App\Http\Controllers;

use DB;
use App\Analysis;
use App\Parametre;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class ParametresController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index(){
        return Response::json(Parametre::all(), 200, [], JSON_NUMERIC_CHECK); 
    }

    public function create(){

    }

    public function store(Request $request){
        try{
            Analysis::findOrFail($request->idtype);
            return Response::json(Parametre::create($request->all()), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['error'=>'Le site de ce parametre n\'existe pas!!'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function update(Request $request){
        try{
            $parametre = Parametre::findOrFail($request->id);
            $parametre->nom = $request->nom;
            $parametre->idtype = $request->idtype;
            return Response::json($parametre, 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['error'=>'Impossible de trouver ce parametre !!'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function show($id){
        try{
            return Response::json(Parametre::findOrFail($id), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['error'=>'Impossible de trouver ce parametre !!'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function destroy($id){
        try{
            return Response::json(Parametre::destroy($id), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['error'=>'Impossible de trouver ce parametre !!'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function edit($id){

    }



    public function chercher_parametre($id){
      
        // $analyse = Analysis::all()->where('type','=',$id); faux
        $analyse = DB::table('analyses')->where('type', $id)->first();
        $params = Parametre::where('idtype', $analyse->id)->get();
        // dd($params->toJson());
        foreach ($params as $param) {
            $param->value = 0;
        }
        return Response::json($params);
    }




}
