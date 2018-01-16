<?php

namespace App\Http\Controllers;

use App\PackageCategory;
use App\PackageType;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
  public function __construct() {
    $this->middleware('auth')->except(middlewareParams());
  }
  public function viewPackageTypes(){
    $package_types = PackageType::getPackageTypeList();
    return view('backend.packages.types', compact('package_types'));
  }
  public function savePackageTypes(Request $r){
    $this->validate($r, [
       'package_type'=>'required'
    ]);
    $package_type = new PackageType();
    $package_type->type = $r->package_type;
    $package_type->save();
    if($package_type->save()){
      flash('Package type added successfully')->success();
      return redirect(url('package/types'));
    }
  }
  public function updatePackageTypes(Request $r, $id){
    $this->validate($r, [
        'package_type'=>'required'
    ]);
    $package_type = PackageType::where('id', $id)->first();
    $package_type->type = $r->package_type;
    $package_type->update();
    if($package_type->update()){
      flash('Package type updated successfully')->success();
      return redirect(url('package/types'));
    }
  }
  public function deletePackageTypes(Request $r, $id){
    return PackageType::deletePackageType($id);
  }


  public function viewPackageCategories(){
    $package_categories = PackageCategory::getPackageCategoryList();
    return view('backend.packages.categories', compact('package_categories'));
  }

  public function savePackageCategories(Request $r){
    $this->validate($r, [
       'package_categories'=>'required'
    ]);

    $package_category = new PackageCategory();
    $package_category->category = $r->package_categories;
    $package_category->save();

    if($package_category->save()){
      flash('Package category added successfully')->success();
      return redirect(url('package/categories'));
    }
  }
  public function updatePackageCategories(Request $r, $id){
    $this->validate($r, [
        'package_categories'=>'required'
    ]);

    $package_category = PackageCategory::where('id', $id)->first();
    $package_category->category = $r->package_categories;
    $package_category->update();

    if($package_category->update()){
      flash('Package category updated successfully')->success();
      return redirect(url('package/categories'));
    }
  }
  public function deletePackageCategories(Request $r, $id){
    return PackageCategory::deletePackageCategory($id);
  }
}
