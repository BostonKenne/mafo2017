<?php

namespace App\Http\Controllers;

use App\CoordonneesSite;
use App\Image;
use App\Puit;
use App\Site;
use App\Base64ToJpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

use App\Http\Requests;

class SitesController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        return Response::json(Site::paginate(6), 200, [], JSON_NUMERIC_CHECK);
    }

    public function create(){

    }

    public function store(Request $data){
        //dd(time());

        if(is_array($data->all()) && isset($data->all()['nom'])){
            $site = Site::create([
                'nom' => $data->nom,
                'description' => $data->description
            ]);
            //dd($site->id);

            if(is_array($data->coordonnees)&& count($data->coordonnees) >= 3){
                foreach ($data->coordonnees as $coordonnee){
                    $coordonnee['idsite'] = $site->id;
                    $coordonnee['alt'] = 0;
                    //dd($coordonnee);
                    CoordonneesSite::create($coordonnee);
                }
                foreach ($data->images as $image){
                    $image_name = 'img'.$site->id.'_'.time().'.'.$image['ext'];
                    $lien = Base64ToJpeg::base64_to_jpeg($image['lien'], 'images/'.$image_name);
                    Image::create([
                        'lien'=> $lien,
                        'idsite'=> $site->id,
                        'idechantillon'=> null
                    ]);
                }
                return Response::json($site->id, 200, [], JSON_NUMERIC_CHECK);
            }
            Site::destroy($site->id);
            return Response::json(['message' => 'les coordonnees doivent etre plus de trois'], 401, [], JSON_NUMERIC_CHECK);
        }
        return Response::json(['message' => 'impossible de cree un site vide'], 401, [], JSON_NUMERIC_CHECK);
    }

    public function update(Request $data){
        try{
            $site = Site::findOrFail($data->id);
            $site->nom = $data->nom;
            $site->description = $data->description;
            $site->save();
            return Response::json($site, 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['message'=> ' ce site n\'existe pas!!'],  401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function show($id){
        try {
            $site = new \stdClass();
            $site->attr = Site::findOrFail($id);
            $site->coordonnees = CoordonneesSite::all()->where('idsite','=',$site->attr->id);
            $site->images = Image::all()->where('idsite', '=', $site->attr->id);
            $site->puits = Puit::all()->where('idsite', '=', $site->attr->id);
            return Response::json($site, 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex) {
            return Response::json(['message'=> ' ce site n\'existe pas!!'],  401, [], JSON_NUMERIC_CHECK);
        }
    }
    public function showMe($id){
        try{
            $site = new \stdClass();
            $site->attr = Site::findOrFail($id);
            $site->coordonnees = CoordonneesSite::all()->where('idsite','=',$site->attr->id);
            $site->images = Image::all()->where('idsite', '=', $site->attr->id);
            $site->puits = Puit::all()->where('idsite', '=', $site->attr->id);
            return $site;
        } catch (ModelNotFoundException $ex){
            return Response::json(['message'=> 'Ce puit n\' existe pas!!'],  401, [], JSON_NUMERIC_CHECK);
        }

    }
    public function destroy($id){
        try{
            return Response::json(Site::destroy($id), 200, [], JSON_NUMERIC_CHECK);
        } catch (ModelNotFoundException $ex){
            return Response::json(['message'=> 'Ce puit n\' existe pas!!'],  401, [], JSON_NUMERIC_CHECK);
        }
    }

    public function edit($id){

    }


    public function all(){
        $sitesTab = [];
        $sites = DB::table('sites')->get();
        foreach ($sites as $site) {
            $sit = new \stdClass();
             $sit->site = $site;
             $coord = DB::table('coordonnees_sites')
                                     ->where('idsite',$site->id)
                                     ->get(['lat', 'lng'])
                                     ->toArray();
                $coordTab =[];
                foreach ($coord as $coor) {
                    $co = new \stdClass();
                    $co->lat = floatval($coor->lat);
                    $co->lng = floatval($coor->lng);
                    array_push($coordTab, $co);
                }
             $sit->coord = $coordTab;
             array_push($sitesTab, $sit);
            // $sit->coord = $site->coordonnees(); 
            
             }
                // dd($sites->coordonnees());
            // dd($sitesTab);
            return Response::json($sitesTab);
            }
}
