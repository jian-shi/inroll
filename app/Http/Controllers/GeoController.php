<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($surveyId=null)
    {
        $meshblocks = $this->getMeshblocks($surveyId);

        return response()->json($meshblocks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
//    public function store()
//    {
//
//        $dir = new \DirectoryIterator(dirname('/Applications/MAMP/htdocs/inroll/geojson/geojson/..'));
//        foreach ($dir as $fileinfo) {
//            if (!$fileinfo->isDot()) {
//                $fileName = $fileinfo->getFilename();
//                echo "Processing file " . $fileName;
//                $str = file_get_contents('/Applications/MAMP/htdocs/inroll/geojson/epsom/'.$fileName.'geojson');
//
//                $json_output = json_decode($str, true);
//                $meshblock = $json_output['features'][0]['properties']['MB2014'];
//                $ua2014_name = $json_output['features'][0]['properties']['UA2014_NAM'];
//
//                if ($ua2014_name == 'Central Auckland Zone')
//
//                    $coordinates = $json_output['features'][0]['geometry']['coordinates'][0];
//                foreach ($coordinates as $coordinate) {
//                    try {
//                        $coordinate_str = implode(", ", $coordinate);
//                        DB::table('geo_data')->insert(['meshblock' => $meshblock, 'coordinate' => $coordinate_str]);
//                    } catch (Exception $e) {
//                        echo $e . "!!!!!!!!!!!!!!!!!! " . $fileName;
//                    }
//                }
//            }
//        }
//    }

    public function toGeojson(){
        $json = [ "type" => "FeatureCollection",
            "crs" => [
                "type"=>"name",
                "properties"=>["name" => "urn:ogc:def:crs:OGC:1.3:CRS84"]],
            "features" => []

        ];

        $geo_items_meshblock_ids = DB::table('geo_data')->select('geo_data.meshblock')->groupby('geo_data.meshblock')->get();
       //dd($geo_items_meshblocks);

        foreach ($geo_items_meshblock_ids as $geo_items_meshblock_id)
        {
            $output = ["type" => "Feature",
                    "properties" => [],"geometry"=>["type"=>"Polygon", "coordinates"=>[[]]

            ]];

            $geo_items = DB::table('geo_data')
                ->join('flag_prediction', 'geo_data.meshblock','=', 'flag_prediction.meshblock')
                ->select ('geo_data.*','flag_prediction.rate')
                ->where('geo_data.meshblock','=', $geo_items_meshblock_id['meshblock'])
                ->get();

            $coordinates = [];
            foreach ($geo_items as $geo){
               $long= floatval(explode( ",", $geo['coordinate'])[0]);
               $lat= floatval(explode( ",", $geo['coordinate'])[1]);
               $coordinate = [];
               array_push($coordinate, $long);
               array_push($coordinate, $lat);
               array_push($coordinates, $coordinate);
            }
            $output['properties']["meshblock"] = $geo_items_meshblock_id['meshblock'];
            $output['properties']["data"] = $geo_items[0]['rate'];
            $output['geometry']['coordinates'][0] = $coordinates;

            array_push($json['features'], $output);

        }
        echo json_encode($json);



    }
}
