<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\GoodToKnow;
use App\Language;
use App\Package;
use App\PackageAttraction;
use App\PackageFlight;
use App\PackageHotel;
use App\SightSeeing;
use App\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    public $package_id;

  public function __construct() {
//    $this->middleware('auth')->except(middlewareParams());
  }

  public function index()
  {
      $activities = Package::getActivities();
      return view('backend.activities.package-desc', compact('activities'));
  }

  public function packageCreate(){
    /*dd(cabin());*/
      $cabin = array('Economy'=>'Economy','Business'=>'Business','Premium'=>'Premium','First'=>'First Class');
      return view('backend.activities.package-info',compact('cabin'));
  }

  public function storePackageInfo(Request $r)
  {
      $package = Package::store($r);
      $response = [];
      if ($package)
      {
          $response['status']= 'success';
          $response['package_id'] = $this->package_id = $package->id;
          return response()->json($response);
      }
      $response['status'] = 'error';
      return response()->json($response);

  }

  public function storeFlightInfo(Request $r)
  {
      if ($r->isMethod('post')){
          PackageFlight::store($r);
          $response['status']= 'success';
          return response()->json($response);
      }
      $response['status'] = 'error';
      return response()->json($response);
  }

  public function storeHotelInfo(Request $r)
  {
      if ($r->isMethod('post')){
          PackageHotel::store($r);
          $response['status'] = 'success';
          return response()->json($response);
      }
      $response['status'] = 'error';
      return response()->json($response);
  }

  public function storeAttractionInfo(Request $r)
  {
      if ($r->isMethod('post')){
          $attraction = PackageAttraction::store($r);
          if ($attraction)
          {
              $response['status']= 'success';
              $response['attraction_id']= $attraction->id;
              return response()->json($response);
          }
      }
      $response['status'] = 'error';
      return response()->json($response);
  }

  public function storeSightSeeingInfo(Request $r)
  {
      if ($r->isMethod('post')){
          SightSeeing::store($r);
          $response['status']= 'success';
          return response()->json($response);
      }
      $response['status'] = 'error';
      return response()->json($response);
  }

  public function storeGoodToKnowInfo(Request $r)
  {
      if ($r->isMethod('post')){
          GoodToKnow::store($r);
          $response['status']= 'success';
          return response()->json($response);
      }
      $response['status'] = 'error';
      return response()->json($response);
  }

  public function storeGalleryInfo(Request $r)
  {
      $image = $r->file('file');
      $imageName = time().$image->getClientOriginalName();
      $image_path = 'images/gallery/packages/'.$imageName;
      $image->move(public_path('images/gallery/packages'),$imageName);
      $gallery = new Gallery();
      $gallery->package_id = $r->package_id;
      $gallery->image_type_id = $r->image_type_id;
      $gallery->parent_id = $r->parent_id;
      $gallery->image_path = $image_path;
      $gallery->save();
      return response()->json(['success'=>$imageName]);
  }

  public function activate($id)
  {
      $response = [
          'status'=>''
      ];

      if (Package::isActivated($id))
      {
          $response['status'] = 'activated';
          return response()->json($response);
      }else
      {
          if (Package::activatePackage($id))
          {
              $response['status'] = true;
              return response()->json($response);
          }
          else
          {
              $response['status'] = false;
              return response()->json($response);
          }
      }
  }

  public function deactivate($id)
  {
      $response = [
          'status'=>''
      ];

      if (Package::isDeactivated($id))
      {
          $response['status'] = 'deactivated';
          return response()->json($response);
      }else
      {
          if (Package::deactivatePackage($id))
          {
              $response['status'] = true;
              return response()->json($response);
          }
          else
          {
              $response['status'] = false;
              return response()->json($response);
          }
      }
  }

  public function saveActivity(Request $r){
    $this->validate($r, [
      'phone_number'=>'numeric',
      'sights_stops'=>'numeric',
      'photo_1'=>'mimes:bmp,png,jpg,jpeg,tif',
      'photo_2'=>'mimes:bmp,png,jpg,jpeg,tif',
      'photo_3'=>'mimes:bmp,png,jpg,jpeg,tif',
      'photo_4'=>'mimes:bmp,png,jpg,jpeg,tif',
      'photo_5'=>'mimes:bmp,png,jpg,jpeg,tif'
    ]);
    $package = new Package();
    $package->package_type_id = $r->package_type_id;
    $package->package_category_id = $r->package_category_id;
    $package->package_name = $r->package_name;
    $package->location = $r->location;
    $package->phone_number = $r->phone_number;
//    $package->sights_and_stops = $r->sights_and_stops;
    $package->time_length = $r->time_length;
    $package->duration_type = $r->duration_type;
    $package->transports = $r->transports;
    $package->language_spoken = $r->language_spoken;
    $package->adult_price = $r->adult_price;
    $package->kids_price = $r->kids_price;
    $package->save();

    if($package->save()){
      $good_to_know = new GoodToKnow();
      $good_to_know->package_id = $package->id;
      $good_to_know->check_in = $r->check_in;
      $good_to_know->check_out = $r->check_out;
      $good_to_know->cancellation_prepayment = $r->cancellation_prepayment;
      $good_to_know->children_beds = $r->children_beds;
      $good_to_know->internet = $r->internet;
      $good_to_know->pets = $r->pets;
      $good_to_know->groups = $r->groups;
      $good_to_know->save();
      if($good_to_know->save()){
        if(!is_null($r->photo_1) || !empty($r->photo_1)){
          $gallery = new Gallery();
          $gallery->package_id = $package->id;
          $photo_1 = $r->photo_1;
          $path = $photo_1->store('uploads/gallery/'.$package->id);
          $photo_1->move('uploads/gallery/'. $package->id, $path);
          $gallery->image_path = $path;
          $gallery->save();
        }
        if(!is_null($r->photo_2) || !empty($r->photo_2)){
          $gallery = new Gallery();
          $gallery->package_id = $package->id;
          $photo_2 = $r->photo_2;
          $path = $photo_2->store('uploads/gallery/'.$package->id);
          $photo_2->move('uploads/gallery/'. $package->id, $path);
          $gallery->image_path = $path;
          $gallery->save();
        }
        if(!is_null($r->photo_3) || !empty($r->photo_3)){
          $gallery = new Gallery();
          $gallery->package_id = $package->id;
          $photo_3 = $r->photo_3;
          $path = $photo_3->store('uploads/gallery/'.$package->id);
          $photo_3->move('uploads/gallery/'. $package->id, $path);
          $gallery->image_path = $path;
          $gallery->save();
        }
        if(!is_null($r->photo_4) || !empty($r->photo_4)){
          $gallery = new Gallery();
          $gallery->package_id = $package->id;
          $photo_4 = $r->photo_4;
          $path = $photo_4->store('uploads/gallery/'.$package->id);
          $photo_4->move('uploads/gallery/'. $package->id, $path);
          $gallery->image_path = $path;
          $gallery->save();
        }
        if(!is_null($r->photo_5) || !empty($r->photo_5)){
          $gallery = new Gallery();
          $gallery->package_id = $package->id;
          $photo_5 = $r->photo_5;
          $path = $photo_5->store('uploads/gallery/'.$package->id);
          $photo_5->move('uploads/gallery/'. $package->id, $path);
          $gallery->image_path = $path;
          $gallery->save();
        }
          flash('Package added successfully')->success();
          return redirect(url('activities'));
      }
    }
  }

  public function packageDescription()
  {

  }

  public function deleteActivities($id){
    return Package::deletePackage($id);
  }

  public function updateActivitiesView($activity_id){
    $good_to_knows = GoodToKnow::getGoodToKnowByPackageId($activity_id);
    $activities = Package::getPackageById($activity_id);
    $pictures = Gallery::getGalleryByPackageId($activity_id);
    $sight_seeing = SightSeeing::getSightseeingByPackageId($activity_id);
    return view('backend.activities.activities-update', compact('good_to_knows', 'activities', 'pictures', 'sight_seeing'));
  }

  public function deletePicture($id){
    return Gallery::deletePicture($id);
  }

  public function updateActivityInformation(Request $r, $activity_id){
    $activity = Package::where('id', $activity_id)->first();
    $activity->package_type_id = $r->package_type_id;
    $activity->package_category_id = $r->package_category_id;
    $activity->package_name = $r->package_name;
    $activity->location = $r->location;
    $activity->phone_number = $r->phone_number;
//    $activity->sights_and_stops = $r->sights_and_stops;
    $activity->time_length = $r->time_length;
    $activity->duration_type = $r->duration_type;
    $activity->transports = $r->transports;
    $activity->language_spoken = $r->language_spoken;
    $activity->adult_price = $r->adulty_price;
    $activity->kids_price = $r->kids_price;
    $activity->update();

    if($activity->update()){
      flash('Activity updated successfully')->success();
      return back();
    }
  }

  public function updateTimeSchedule(Request $r, $activity_id){
    $activity = Package::where('id', $activity_id)->first();
    $activity->trip_schedule = $r->trip_schedule;
    $activity->update();

    if($activity->update()){
      flash('Activity updated successfully')->success();
      return back();
    }
  }

  public function updateGoodToKnow(Request $r, $activity_id){
    $good_to_know = GoodToKnow::where('package_id', $activity_id)->first();
    $good_to_know->check_in = $r->check_in;
    $good_to_know->check_out = $r->check_out;
    $good_to_know->cancellation_prepayment = $r->cancellation_prepayment;
    $good_to_know->children_beds = $r->children_beds;
    $good_to_know->internet = $r->internet;
    $good_to_know->pets = $r->pets;
    $good_to_know->groups = $r->groups;
    $good_to_know->update();

    if($good_to_know->update()){
      flash('Activity updated successfully')->success();
      return back();
    }
  }

  public function updateGallery(Request $r, $activity_id){
    $this->validate($r, [
       'photo_1'=>'required|mimes:bmp,png,jpg,jpeg,tif'
    ]);

    $gallery = new Gallery();
    $gallery->package_id = $activity_id;
    $photo_1 = $r->photo_1;
    $path = $photo_1->store('uploads/gallery/'.$activity_id);
    $photo_1->move('uploads/gallery/'. $activity_id, $path);
    $gallery->image_path = $path;
    $gallery->save();

    if($gallery->save()){
      flash('activity updated successfully')->success();
      return back();
    }
  }

  public function saveSightSeeing(Request $r){
    $this->validate($r, [
       'title' => 'required',
       'description' => 'required'
    ]);

    $sight_seeing = new SightSeeing();
    $sight_seeing->package_id = $r->package_id;
    $sight_seeing->title = $r->title;
    $sight_seeing->description = $r->description;
    $sight_seeing->save();

    if($sight_seeing->save()){
      flash('Sight seeing added successfully')->success();
      return redirect(url('activities'));
    }
  }

  public function updateSightSeeing(Request $r){
    $this->validate($r, [
        'title' => 'required',
        'description' => 'required'
    ]);

    $sight_seeing = SightSeeing::where('id', $r->sight_id)->first();
    $sight_seeing->title = $r->title;
    $sight_seeing->description = $r->description;
    $sight_seeing->update();

    if($sight_seeing->update()){
      flash('Sight seeing updated successfully')->success();
      return back();
    }
  }

  public function deleteSight($id){
    return SightSeeing::deleteSight($id);
  }
}
