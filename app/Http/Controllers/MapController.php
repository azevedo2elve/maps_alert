<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public float $lat = 0;
    public float $lng = 0;
    public $data = [];
   
    public function index(): View
    {
        $lat = $this->lat;
        $lng = $this->lng;

        return view('map', compact('lat', 'lng'));
    }

    public function alert(Request $request): View
    {
        $lat = request()->lat;
        $lng = request()->lng;

        $points = $this->generateParams($lat, $lng);
        
        $response = file_get_contents('https://www.waze.com/live-map/api/georss?top='. $points['top'] .'&bottom='. $points['bottom'] .'&left='. $points['left'] .'&right='. $points['right'] .'&env=row&types=alerts');

        $data = json_decode($response, true);

        //dd($data);

        $data_type = [];
        if (array_key_exists("alerts", $data)) {

            foreach ($data['alerts'] as $key => $value){
                array_push($data_type, $value['subtype']);
            }

            //dd($data_type);

            $police = [];
            $hazard = [];
            $roadClosed = [];
            $jam = [];
            
            foreach ($data['alerts'] as $key => $value){
                if ($value['type'] == 'POLICE')
                {
                    array_push($police, $value);
                } elseif ($value['type'] == 'HAZARD')
                {
                    array_push($hazard, $value);
                } elseif ($value['type'] == 'ROAD_CLOSED')
                {
                    array_push($roadClosed, $value);
                } elseif ($value['type'] == 'JAM')
                {
                    array_push($jam, $value);
                }
            }
        } else {
            $police = '';
            $hazard = '';
            $roadClosed = '';
            $jam = '';
        }
        //dd($hazard);

        return view('map', compact('data', 'police', 'hazard', 'roadClosed', 'jam'));
    }

    public function generateParams($lat, $lng)
    {
        $lat = floatval($lat);
        $lng = floatval($lng);

        $distancia = 5000;

        $pointO = $this->generatePoint($lat, $lng, $distancia, 270);
        $pointS = $this->generatePoint($lat, $lng, $distancia, 180);
        $pointL = $this->generatePoint($lat, $lng, $distancia, 90);
        $pointN = $this->generatePoint($lat, $lng, $distancia, 0);

        $pointO = $pointO['lng'];
        $pointS = $pointS['lat'];
        $pointL = $pointL['lng'];
        $pointN = $pointN['lat'];

        $points = [
            'bottom' => $pointS,
            'left' => $pointO,
            'right' => $pointL,
            'top' => $pointN
        ];

        return $points;
    }

    public function generatePoint($lat, $lng, $distancia, $azimute){
        $raioTerra = 6371000;
        
        $lat = deg2rad($lat);
        $lng = deg2rad($lng);
        $azimute = deg2rad($azimute);

        $angularDistancia = $distancia / $raioTerra;

        $latB = asin(sin($lat) * cos($angularDistancia) + cos($lat) * sin($angularDistancia) * cos($azimute));
        $lngB = $lng + atan2(sin($azimute) * sin($angularDistancia) * cos($lat), cos($angularDistancia) - sin($lat) * sin($latB));

        $latB = rad2deg($latB);
        $lngB = rad2deg($lngB);

        $razLat = $latB > 0 ? 6 : 7;
        $razLng = $lngB > 0 ? 6 : 7;

        $formatLat = substr($latB, 0, $razLat);
        $formatLng = substr($lngB, 0, $razLng);

        $latB = floatval($formatLat);
        $lngB = floatval($formatLng);

        return ['lat' => $latB, 'lng' => $lngB];
    }
}
