<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratoire;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaboratoiresController extends Controller
{
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        return Response::json(Laboratoire::all(), 200, [], JSON_NUMERIC_CHECK);
    }
	
    public function create(){

    }

    public function store(Request $data){
        return Response::json(Laboratoire::create($data->all()), 200, [], JSON_NUMERIC_CHECK);
    }

    public function update(Request $data){
        try {
            $labo = Laboratoire::findOrFail($data->id);
            $labo->nom = $data->nom;
            $labo->ville = $data->ville;
            $labo->lng = $data->lng;
            $labo->lat = $data->lat;
            return Response::json($labo->save(), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $e) {
            return Response::json(['error'=>'Ce laboratoire n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function show($id){
        return Response::json(Laboratoire::findOrFail($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function destroy($id){
        return Response::json(Laboratoire::destroy($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function edit($id){

    }
}
