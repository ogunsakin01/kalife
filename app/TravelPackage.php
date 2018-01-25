<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TravelPackage extends Model
{

    const
        ACTIVATED = 1,
        DEACTIVATED = 0;


    public static function store($data){
        $table = new static();
        $table->category_id  = $data['default']->category;
        $table->name         = $data['default']->name;
        $table->flight       = $data['flight'];
        $table->hotel        = $data['hotel'];
        $table->attraction   = $data['attraction'];
        $table->phone_number = $data['default']->contact_number;
        $table->information  = $data['default']->information;
        $table->adult_price  = $data['default']->adult_price;
        $table->child_price  = $data['default']->child_price;
        $table->infant_price = $data['default']->infant_price;
        $table->status = 0;
        $table->save();

        return $table;
    }

    public static function isDeactivated($id)
    {
        $package = static::find($id);
        if ($package)
        {
            if ($package->status == static::DEACTIVATED)
                return true;
        }
        return false;
    }

    public static function isActivated($id)
    {
        $package = static::find($id);
        if ($package)
        {
            if ($package->status == static::ACTIVATED)
                return true;
        }
        return false;
    }

    public static function activatePackage($id)
    {
        $package = static::find($id);
        $package->status = self::ACTIVATED;
        if ($package->update())
            return true;
        return false;
    }

    public static function deactivatePackage($id)
    {
        $package = static::find($id);
        $package->status = self::DEACTIVATED;
        if ($package->update())
            return true;
        return false;
    }

    public static function deletePackage($package_id){
        $delete_package = static::where('id', $package_id)->delete();
        $delete_gallery = Gallery::where('package_id', $package_id)->delete();

            flash('Package deleted successfully')->success();
            return redirect(url('backend/travel-packages/'));

    }

    public static function getAllPackagesDesc(){

        return DB::table('travel_packages')
            ->orderBy('id','desc')
            ->get();
    }


}
