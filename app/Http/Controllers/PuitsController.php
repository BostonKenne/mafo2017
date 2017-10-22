<?php

namespace App\Http\Controllers;

use App\Puit;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class PuitsController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        return Response::json(Puit::all(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function puitsDeSite($idsite){
        return Response::json(Puit::all()->where('idsite', '=', $idsite), 200, [], JSON_NUMERIC_CHECK);
    }

    public function create(){

    }

    public function store(Request $data){
        return Response::json(Puit::create($data->all()), 200, [], JSON_NUMERIC_CHECK);
    }

    public function update(Request $data){
        $puit = Puit::finDorFail($data->id);
        $puit->code = $data->code;
        $puit->lat = $data->lat;
        $puit->lng = $data->lng;
        $puit->alt = $data->alt;
        $puit->idsite = $data->idsite;
        return Response::json($puit->save(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function show($id){
        return Response::json(Puit::findOrFail($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function destroy($id){
        return Response::json(Puit::destroy($id), 200, [], JSON_NUMERIC_CHECK);
    }

    public function edit($id){

    }
}
