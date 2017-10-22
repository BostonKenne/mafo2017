<?php

namespace App\Http\Controllers;

use App\Fonction;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class FonctionsController extends Controller
{
    //
    public function index(){
        return Response::json(Fonction::all(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function create(){
    }

    public function store(array $data){
        return Response::json(Fonction::create($data), 200, [], JSON_NUMERIC_CHECK);
    }

    public function update(array $data){
        $fonction = Fonction::findOrFail($data['id']);
        $fonction->libelle = $data['libelle'];
        $fonction->description = $data['description'];
        $fonction->save();
        return Response::json($fonction, 200, [], JSON_NUMERIC_CHECK);
    }

    public function show($id){
        return Response::json(Fonction::findOrFail($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function destroy($id){
        return Response::json(Fonction::destroy($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function edit($id){

    }
}
