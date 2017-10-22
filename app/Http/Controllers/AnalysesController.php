<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Http\Requests;
use App\Laboratoire;
use App\Parametre;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AnalysesController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        $analy = new \stdclass();
        $analy->analyse = Analysis::all();
        $analy->parametres = Parametre::all();
        //dd($analy);
        return Response::json($analy, 200, [], JSON_NUMERIC_CHECK);
    }

    public function ajouter(Request $request){
        // $user = User::where('name', $request->user);
        // $labo = Laboratoire::where('nom', $request->labo);
        

        // $analyse->
    }

    public function store(Request $request){
        if ($request->type){
            if (!$request->description){
                $request->description = "Aucune description donnees...";
            }
            return Response::json(Analysis::create($request->all()), 200, [], JSON_NUMERIC_CHECK);
        }
        return Response::json(['error'=>'Type vide'], 401, [], JSON_NUMERIC_CHECK);
    }

    public function update(Request $request){
        try {
            $analyse = Analysis::findOrFail($request->id);
            $analyse->type = $request->type;
            $analyse->description = $request->description;
            return Response::json($analyse, 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['error'=>'Ce type d\' Annalyse n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function show($id){
        try {
            $type = Analysis::findOrFail($id);
            $type->parametre = Parametre::all()->where('idtype','=',$type->id);
            return Response::json($type, 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['error'=>'Cette Annalyse n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function destroy($id){
        try {
            return Response::json(Analysis::destroy($id), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['error'=>'Cette Annalyse n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function edit($id){

    }


    public function analyse(Request $request){
        
        $lab = $request[3];
        $labo = DB::select("select * from Laboratoires where nom = '$lab' limit 1");
        // dd($labo);
        //ne pas avoir deux pace

       
        // $labo = Laboratoire::where('nom', '$lab');

        for($i=0; $i<3; $i++ ){
            $echan = $request[4];
            $param_id = $request[$i]['id'];
            $laboratoire = $labo[0]->id;
            $value = $request[$i]['value'];

             $res = DB::insert("insert into echantillon_parametre(echantillon_id, parametre_id,laboratoire_id,valeur)
                        values($echan, $param_id, $laboratoire, $value)");
        }


        return Response::json($res);

    }

    
} 

















    // @foreach($menus as $menu)
    //     @if(!$menu->fils)
    //         <li class="nav-item" ><a href="javascript:;" class="nav-link nav-toggle"><i class="fa {{$menu->icone}}"></i>
    //          <span class="title">{{$menu->libelle}}</span>
    //         <span class="selected"></span>
    //         <span class="arrow open"></span>
    //           </a>
    //             <ul class="sub-menu" >
    //                 @foreach($sous_menus as $sous_menu)
    //                     @if($menu->id == $sous_menu->mere_id)
    //                         <li class="nav-item start " ><a href="{{url($sous_menu->lien)}}"> {{$sous_menu->libelle}}</a></li>
    //                     @endif
    //                 @endforeach
    //             </ul>
    //         </li>
    //     @endif
    // @endforeach