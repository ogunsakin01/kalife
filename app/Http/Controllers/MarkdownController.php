<?php

namespace App\Http\Controllers;

use App\Airline;
use App\Markdown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    public function index(){
        $markdowns = Markdown::all();
        return view('backend.additions.markdown',compact('markdowns'));
    }

    public function createOrUpdate(Request $r){
           $airlineCode = Airline::getAirlineCodeByName($r->airline);
           if(is_null($airlineCode->IATA)){
               return 0;
           }
           $r->airlineCode = $airlineCode->IATA;

          return Markdown::store($r);
    }

    public function getMarkdownById($id){

        $markdown = Markdown::getMarkdownWithId($id);
        $airlineName = Airline::getAirline($markdown->airline_code);

        $markdown->airline_name = $airlineName;
        return $markdown;
    }
}
