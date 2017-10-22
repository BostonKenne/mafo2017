<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Echantillon;
use App\Http\Requests;
use App\Image;
use App\Laboratoire;
use App\Parametre;
use App\Puit;
use App\echantillon_parametre;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EchantillonsController extends Controller
{

    private $idpuit = ""; 


    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }
	
    public function index(){
        
		
    }

    public function create(){


    }

    public function store(Request $request){
         // Echantillon::create($request->all());
        // dd('lol');
        // $datas = $request::all();
        $echan = new Echantillon();
        $echan->code             = $request->code;
        $echan->couleur          = $request->couleur;
        $echan->date_prelevement = $request->date_prelevement;
        $echan->idpuit           = $request->idpuit;
        $echan->pfd_debut          = $request->pfd_debut;
        $echan->pfd_fin          = $request->pfd_fin;
        $echan->autre_info       = $request->autre_info;
        $echan->structure        = $request->structure;
        $echan->texture          = $request->texture;
        $echan->save();

        $data = [];
        $data['echan'] = $echan;
        $data['puit'] = $echan->puit()->get();



        return Response::json($data);
    }

    // public function update($id, Request $request){
    //     $echan = Echantillon::findOrFail($id);
    //     $echan->code             = $request->code;
    //     $echan->couleur          = $request->couleur;
    //     $echan->date_prelevement = $request->date_prelevement;
    //     $echan->idpuit           = $request->idpuit;
    //     $echan->pfd_debut          = $request->pfd_debut;
    //     $echan->pfd_fin          = $request->pfd_fin;
    //     $echan->autre_info       = $request->autre_info;
    //     $echan->structure        = $request->structure;
    //     $echan->texture          = $request->texture;
    //     $echan->save();
    //     return Response::json($data)
    // }

    public function show($id){
        try {

            $echantillon = Echantillon::findOrFail($id);
            // $echantillon->puit = Puit::all()->where('id','=',$echantillon->idpuit);
            return Response::json($echantillon);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['error'=>'Cette echantillon n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function destroy($id){
        try {
            return Response::json(Echantillon::destroy($id), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['error'=>'Cette Echantillon n\'existe pas...'], 401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function update(Request $req, $id){
             $echan = Echantillon::findOrFail($id);
             $echan->idpuit =$req->idpuit;
             $echan->code =$req->code;
             $echan->date_prelevement =$req->date_prelevement;
             $echan->couleur =$req->couleur;
             $echan->texture =$req->texture;
             $echan->structure =$req->structure;
             $echan->pfd_debut =$req->pfd_debut;
             $echan->pfd_fin =$req->pfd_fin;
             $echan->autre_info =$req->autre_info;
             $echan->save();   

             return Response::json($id);
    }

    public function result(Request $req){
        $p = implode( ',' , $req->params);
        $params = DB::select("SELECT * FROM echantillon_parametre WHERE parametre_id in ($p)");
            $e = DB::select("SELECT echantillon_id , SUM(valeur) as valeur FROM echantillon_parametre WHERE parametre_id in ($p) GROUP BY echantillon_id");
            $res = [];
            $resp = [];
            $r = [];
            foreach ($e as $val) {
                $echan = new \stdClass();
                $i = 0;
                foreach ($params as $param) {
                    if( $val->echantillon_id == $param->echantillon_id && $val->valeur == 100){
                        if($i==0) $echan->a = $param->valeur;
                        if($i==1) $echan->b = $param->valeur;
                        if($i==2) $echan->c = $param->valeur;
                        $i++;
                    }
                }
                $res[] = $echan;
            }
            foreach ($params as $param) {
                if(isset($e[0])){
                    $obj = new \stdClass();
                    $pr = DB::select("SELECT nom FROM parametres WHERE id = $param->parametre_id");
                    $obj->nom = $pr[0]->nom;
                    $resp[] = $obj;
                }
            }
            $r[0] = $res;
            $r[1] = $resp;
            //dd($r);
            return Response::json($r);
        }


    public function delete($id){
         $echan = Echantillon::findOrFail($id);
         $echan->delete();
        return Response::json($id);
    }


    public function getEchantillonsPuit($id){
        $echans = Echantillon::where('idpuit', $id)->orderBy('pfd_debut', 'desc')->get();
            // $p = $echanans[0]->puit();
            $data = [];
            $puit = Puit::find($id);  
            $data['echans'] = $echans;
            $data['puit'] = $puit;
        return Response::json($data);
    }
}
