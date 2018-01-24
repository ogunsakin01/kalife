<?php

namespace App\Http\Controllers;

use App\CabinType;
use App\PackageCategory;
use App\TravelPackage;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{

    public function packageCreate(){
        $package_categories = PackageCategory::all();
        $cabin_types = CabinType::all();
        return view('backend.travel-packages.new_package', compact('package_categories','cabin_types'));
    }

    public function create(Request $r){

       $options = explode(',',$r->options);
       $flight = 0;
       $hotel = 0;
       $attraction = 0;
        foreach($options as $option){
            if($option === 'flight'){
                $flight = 1;
            }
            if($option === 'hotel'){
                $hotel = 1;
            }
            if($option === 'attraction'){
                $attraction = 1;
            }
        }
        $info = [
            'flight'      => $flight,
            'hotel'       => $hotel,
            'attraction' => $attraction,
            'default'     => $r
        ];
        TravelPackage::store($info);
        return json_encode($info,true);
    }

    public function createFlightDeal(Request $r){

    }

}
