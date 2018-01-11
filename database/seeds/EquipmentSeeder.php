<?php

use Illuminate\Database\Seeder;
use App\Equipment;
class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Equipment::create( [
          'id'=>1,
          'code'=>'100',
          'name'=>'FOKKER 100 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>2,
          'code'=>'141',
          'name'=>'BRITISH AEROSPACE 146-100 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>3,
          'code'=>'142',
          'name'=>'BRITISH AEROSPACE 146-200 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>4,
          'code'=>'143',
          'name'=>'BRITISH AEROSPACE 146-300 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>5,
          'code'=>'146',
          'name'=>'BRITISH AEROSPACE 146-100/200/300 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>6,
          'code'=>'310',
          'name'=>'AIRBUS INDUSTRIE 310 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>7,
          'code'=>'312',
          'name'=>'AIRBUS INDUSTRIE A310-200 JET',
          'created_at'=>'2017-11-28 13:36:08',
          'updated_at'=>'2017-11-28 13:36:08'
      ] );

      Equipment::create( [
          'id'=>8,
          'code'=>'313',
          'name'=>'AIRBUS INDUSTRIE A310-300 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>9,
          'code'=>'318',
          'name'=>'AIRBUS INDUSTRIE A318 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>10,
          'code'=>'319',
          'name'=>'AIRBUS INDUSTRIE A319 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>11,
          'code'=>'320',
          'name'=>'AIRBUS INDUSTRIE A320-100/200 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>12,
          'code'=>'321',
          'name'=>'AIRBUS INDUSTRIE A321 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>13,
          'code'=>'32S',
          'name'=>'AIRBUS INDUSTRIE A318/A319/A320/A321 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>14,
          'code'=>'32B',
          'name'=>'AIRBUS INDUSTRIE A321 SHARKLETS JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>15,
          'code'=>'330',
          'name'=>'AIRBUS INDUSTRIE A330 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>16,
          'code'=>'332',
          'name'=>'AIRBUS INDUSTRIE A330-200 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>17,
          'code'=>'333',
          'name'=>'AIRBUS INDUSTRIE A330-300 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>18,
          'code'=>'340',
          'name'=>'AIRBUS INDUSTRIE A340 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>19,
          'code'=>'342',
          'name'=>'AIRBUS INDUSTRIE A340-200 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>20,
          'code'=>'343',
          'name'=>'AIRBUS INDUSTRIE A340-300 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>21,
          'code'=>'345',
          'name'=>'AIRBUS INDUSTRIE A340-500 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>22,
          'code'=>'346',
          'name'=>'AIRBUS INDUSTRIE A340-600 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>23,
          'code'=>'350',
          'name'=>'AIRBUS INDUSTRIE A350 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>24,
          'code'=>'351',
          'name'=>'AIRBUS INDUSTRIE A350-1000 JET',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>25,
          'code'=>'380',
          'name'=>'AIRBUS INDUSTRIE A380 JET 480-656',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>26,
          'code'=>'388',
          'name'=>'AIRBUS INDUSTRIE A380-800 JET 480-656',
          'created_at'=>'2017-11-28 13:36:09',
          'updated_at'=>'2017-11-28 13:36:09'
      ] );

      Equipment::create( [
          'id'=>27,
          'code'=>'707',
          'name'=>'BOEING 707/720B JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>28,
          'code'=>'70M',
          'name'=>'BOEING 707 MIXED CONFIG JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>29,
          'code'=>'717',
          'name'=>'BOEING 717 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>30,
          'code'=>'722',
          'name'=>'BOEING 727-200 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>31,
          'code'=>'727',
          'name'=>'BOEING 727-100/200/200 ADVANCED JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>32,
          'code'=>'72A',
          'name'=>'BOEING 727-200 ADVANCED JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>33,
          'code'=>'72M',
          'name'=>'BOEING 727-100 MIXED CONFIGURATION JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>34,
          'code'=>'72S',
          'name'=>'BOEING 727-200/200 ADVANCED JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>35,
          'code'=>'732',
          'name'=>'BOEING 737-200 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>36,
          'code'=>'733',
          'name'=>'BOEING 737-300 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>37,
          'code'=>'734',
          'name'=>'BOEING 737-400 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>38,
          'code'=>'735',
          'name'=>'BOEING 737-500 JET',
          'created_at'=>'2017-11-28 13:36:10',
          'updated_at'=>'2017-11-28 13:36:10'
      ] );

      Equipment::create( [
          'id'=>39,
          'code'=>'736',
          'name'=>'BOEING 737-600 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>40,
          'code'=>'737',
          'name'=>'BOEING 737 ALL SERIES PASSENGER JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>41,
          'code'=>'738',
          'name'=>'BOEING 737-800 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>42,
          'code'=>'739',
          'name'=>'BOEING 737-900 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>43,
          'code'=>'73A',
          'name'=>'BOEING 737-200 ADVANCED JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>44,
          'code'=>'73G',
          'name'=>'BOEING 737-700 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>45,
          'code'=>'73H',
          'name'=>'BOEING 737-800 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>46,
          'code'=>'73M',
          'name'=>'BOEING 737-200 MIXED CONFIGURATION JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>47,
          'code'=>'73S',
          'name'=>'BOEING 737-200/200 ADVANCED JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>48,
          'code'=>'73W',
          'name'=>'BOEING 737-700 JET',
          'created_at'=>'2017-11-28 13:36:11',
          'updated_at'=>'2017-11-28 13:36:11'
      ] );

      Equipment::create( [
          'id'=>49,
          'code'=>'741',
          'name'=>'BOEING 747-100 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>50,
          'code'=>'742',
          'name'=>'BOEING 747-200 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>51,
          'code'=>'743',
          'name'=>'BOEING 747-300 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>52,
          'code'=>'744',
          'name'=>'BOEING 747-400 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>53,
          'code'=>'747',
          'name'=>'BOEING 747 ALL SERIES PASSENGER JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>54,
          'code'=>'74D',
          'name'=>'BOEING 747-300 MIXED CONFIGURATION JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>55,
          'code'=>'74E',
          'name'=>'BOEING 747-400 MIXED CONFIGURATION JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>56,
          'code'=>'74L',
          'name'=>'BOEING 747SP JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>57,
          'code'=>'74M',
          'name'=>'BOEING 747-200/300/400 MIX CONFIG JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>58,
          'code'=>'752',
          'name'=>'BOEING 757-200 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>59,
          'code'=>'753',
          'name'=>'BOEING 757-300 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>60,
          'code'=>'757',
          'name'=>'BOEING 757-200/300 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>61,
          'code'=>'75W',
          'name'=>'BOEING 757-200 JET',
          'created_at'=>'2017-11-28 13:36:12',
          'updated_at'=>'2017-11-28 13:36:12'
      ] );

      Equipment::create( [
          'id'=>62,
          'code'=>'762',
          'name'=>'BOEING 767-200/200ER JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>63,
          'code'=>'763',
          'name'=>'BOEING 767-300/300ER JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>64,
          'code'=>'764',
          'name'=>'BOEING 767-400 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>65,
          'code'=>'767',
          'name'=>'BOEING 767-200/300 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>66,
          'code'=>'76W',
          'name'=>'BOEING 767-300 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>67,
          'code'=>'772',
          'name'=>'BOEING 777-200 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>68,
          'code'=>'773',
          'name'=>'BOEING 777-300 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>69,
          'code'=>'777',
          'name'=>'BOEING 777-200/300 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>70,
          'code'=>'77L',
          'name'=>'BOEING 777-200LR JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>71,
          'code'=>'77W',
          'name'=>'BOEING 777-300/300ER JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>72,
          'code'=>'787',
          'name'=>'787 BOEING 787 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>73,
          'code'=>'788',
          'name'=>'BOEING 787-8 DREAMLINER JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>74,
          'code'=>'789',
          'name'=>'BOEING 787-9 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>75,
          'code'=>'AB3',
          'name'=>'AIRBUS INDUSTRIE A300 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>76,
          'code'=>'AB4',
          'name'=>'AIRBUS INDUSTRIE A300-B2/B4/C4 JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>77,
          'code'=>'AB6',
          'name'=>'AIRBUS INDUSTRIE A300-600/600C JET',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>78,
          'code'=>'ACD',
          'name'=>'ROCKWELL AERO COMMANDER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>79,
          'code'=>'AGH',
          'name'=>'AGUSTA A 109A HELICOPTER',
          'created_at'=>'2017-11-28 13:36:13',
          'updated_at'=>'2017-11-28 13:36:13'
      ] );

      Equipment::create( [
          'id'=>80,
          'code'=>'AN4',
          'name'=>'ANTONOV AN-24 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>81,
          'code'=>'AN6',
          'name'=>'ANTONOV AN-26/30/32 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>82,
          'code'=>'AN6',
          'name'=>'ANTONOV AN-26/30/32 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>83,
          'code'=>'AN6',
          'name'=>'ANTONOV AN-26/30/32 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>84,
          'code'=>'AN7',
          'name'=>'ANTONOV AN-72/74 JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>85,
          'code'=>'AR1',
          'name'=>'AVRO RJ100 AVROLINER JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>86,
          'code'=>'AR7',
          'name'=>'AVRO RJ70 AVROLINER JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>87,
          'code'=>'AR8',
          'name'=>'AVRO RJ85 AVROLINER JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>88,
          'code'=>'ARJ',
          'name'=>'AVRO RJ AVROLINER RJ70/85/100 JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>89,
          'code'=>'AT4',
          'name'=>'AEROSPATIALE/ALENIA ATR 42-300/320 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>90,
          'code'=>'AT7',
          'name'=>'AEROSPATIALE/ALENIA ATR 72 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>91,
          'code'=>'ATP',
          'name'=>'BRITISH AEROSPACE ATP TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>92,
          'code'=>'ATR',
          'name'=>'AEROSPATIALE/ALENIA ATR42/72 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>93,
          'code'=>'B11',
          'name'=>'BRITISH AEROSPACE (BAC) 1-11 (ALL) JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>94,
          'code'=>'B14',
          'name'=>'BRITISH AEROSPACE (BAC) 1-11 400/475 JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>95,
          'code'=>'B15',
          'name'=>'BRITISH AEROSPACE (BAC) 1-11 500 JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>96,
          'code'=>'B72',
          'name'=>'BOEING 720/720B (707-020/020B) JET',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>97,
          'code'=>'BE1',
          'name'=>'BEECHCRAFT 1900/1900C/1900D TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>98,
          'code'=>'BE2',
          'name'=>'BEECHCRAFT PIST',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>99,
          'code'=>'BE9',
          'name'=>'BEECHCRAFT C99 AIRLINER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>100,
          'code'=>'BEC',
          'name'=>'BEECHCRAFT (LIGHT AIRCRAFT) TURBOPROP',
          'created_at'=>'2017-11-28 13:36:14',
          'updated_at'=>'2017-11-28 13:36:14'
      ] );

      Equipment::create( [
          'id'=>101,
          'code'=>'BEH',
          'name'=>'BEECHCRAFT 1900D TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>102,
          'code'=>'BES',
          'name'=>'BEECHCRAFT 1900/1900C TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>103,
          'code'=>'BH2',
          'name'=>'BELL HELICOPTERS HELICOPTER',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>104,
          'code'=>'BNI',
          'name'=>'PILATUS BRITTEN-NORMAN B ISLANDER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>105,
          'code'=>'BNT',
          'name'=>'PILATUS BRITTEN-NORMAN MK3 TRISLAN TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>106,
          'code'=>'CCJ',
          'name'=>'CANADAIR CHALLENGER JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>107,
          'code'=>'CD2',
          'name'=>'GOVERNMENT AIRCRAFT N22B/N24A TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>108,
          'code'=>'CHG',
          'name'=>'CHANGE OF GAUGE',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>109,
          'code'=>'CL4',
          'name'=>'CANADAIR CL-44 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>110,
          'code'=>'CN2',
          'name'=>'CESSNA STATIONAIR 206 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>111,
          'code'=>'CNA',
          'name'=>'CESSNA (LIGHT AIRCRAFT) TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>112,
          'code'=>'CNJ',
          'name'=>'CESSNA CITATION JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>113,
          'code'=>'CNT',
          'name'=>'CESSNA STATIONAIR 20 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>114,
          'code'=>'CR1',
          'name'=>'CANADAIR REGIONAL JET 100/200 JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>115,
          'code'=>'CR2',
          'name'=>'CANADAIR REGIONAL JET 200 JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>116,
          'code'=>'CR7',
          'name'=>'CANADAIR REGIONAL JET 700 JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>117,
          'code'=>'CR9',
          'name'=>'CANADAIR REGIONAL JET 900 JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>118,
          'code'=>'CRJ',
          'name'=>'CANADAIR REGIONAL JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>119,
          'code'=>'CRV',
          'name'=>'AEROSPATIALE SE.210 CARAVELLE JET',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>120,
          'code'=>'CS2',
          'name'=>'CASA C-212/NC-212 AVIOCAR TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>121,
          'code'=>'CS5',
          'name'=>'CASA CN-235 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>122,
          'code'=>'CVR',
          'name'=>'CONVAIR 240-640 SERIES TURBOPROP',
          'created_at'=>'2017-11-28 13:36:15',
          'updated_at'=>'2017-11-28 13:36:15'
      ] );

      Equipment::create( [
          'id'=>123,
          'code'=>'CWC',
          'name'=>'CURTISS C-46 COMMANDO TURBOPROP',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>124,
          'code'=>'C09',
          'name'=>'MCDONNELL DOUGLAS D09 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>125,
          'code'=>'D10',
          'name'=>'MCDONNELL DOUGLAS DC-10 ALL SERIES JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>126,
          'code'=>'D1C',
          'name'=>'MC DONNELL DOUGLAS DC-10-30/40 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>127,
          'code'=>'D1M',
          'name'=>'MC DONNELL DOUGLAS DC-10 MIXED CONF JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>128,
          'code'=>'D28',
          'name'=>'FAIRCHILD DORNIER 228 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>129,
          'code'=>'D38',
          'name'=>'FAIRCHILD DORNIER 328 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>130,
          'code'=>'D8S',
          'name'=>'MC DONNELL DOUGLAS DC-8 60/70 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>131,
          'code'=>'D93',
          'name'=>'MC DONNELL DOUGLAS DC-9-30 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>132,
          'code'=>'D95',
          'name'=>'MC DONNELL DOUGLAS DC-9-50 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>133,
          'code'=>'D9S',
          'name'=>'MC DONNELL DOUGLAS DC-9 30/40/50 JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>134,
          'code'=>'DAM',
          'name'=>'DASSAULT-BREGUET MERCURE JET',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>135,
          'code'=>'DC3',
          'name'=>'MDC DOUGLAS DC-3 PIST',
          'created_at'=>'2017-11-28 13:36:16',
          'updated_at'=>'2017-11-28 13:36:16'
      ] );

      Equipment::create( [
          'id'=>136,
          'code'=>'DC6',
          'name'=>'MDC DOUGLAS DC-6A/B PIST',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>137,
          'code'=>'DC8',
          'name'=>'MCDONNELL DOUGLAS DC-8 ALL SERIES JET',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>138,
          'code'=>'DC9',
          'name'=>'MC DONNELL DOUGLAS DC-9 (ALL SERIES) JET',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>139,
          'code'=>'DF2',
          'name'=>'DASSAULT-BREGUET MYSTERE-FALCON 10/20 JET JET',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>140,
          'code'=>'DH1',
          'name'=>'DE HAVILLAND DHC-8 100 SERIES TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>141,
          'code'=>'DH2',
          'name'=>'DE HAVILLAND DHC-8 200 SERIES TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>142,
          'code'=>'DH3',
          'name'=>'DE HAVILLAND DHC-8 SERIES 300 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>143,
          'code'=>'DH4',
          'name'=>'DE HAVILLAND DHC-8 400 SERIES TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>144,
          'code'=>'DH7',
          'name'=>'DE HAVILLAND DHC-7 DASH 7 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>145,
          'code'=>'DH8',
          'name'=>'DE HAVILLAND DHC-8 DASH 8 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>146,
          'code'=>'DHB',
          'name'=>'DE HAVILLAND DHC-2 TURBO-BEAVER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>147,
          'code'=>'DHC',
          'name'=>'DE HAVILLAND DHC-4 CARIBOU TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>148,
          'code'=>'DHH',
          'name'=>'BRITISH AEROSPACE HERON TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>149,
          'code'=>'DHL',
          'name'=>'DE HAVILLAND DHC-3 TURBO OTTER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:17',
          'updated_at'=>'2017-11-28 13:36:17'
      ] );

      Equipment::create( [
          'id'=>150,
          'code'=>'DHM',
          'name'=>'DE HAVILLAND DHC-7 MIXED CONFIG TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>151,
          'code'=>'DHO',
          'name'=>'DE HAVILLAND DHC-3 OTTER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>152,
          'code'=>'DHP',
          'name'=>'DE HAVILLAND DHC-2 BEAVER PIST',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>153,
          'code'=>'DHT',
          'name'=>'DE HAVILLAND DHC-6 TWIN OTTER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>154,
          'code'=>'E70',
          'name'=>'EMBRAER 170 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>155,
          'code'=>'E75',
          'name'=>'EMBRAER 175 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>156,
          'code'=>'E90',
          'name'=>'EMBRAER 190 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>157,
          'code'=>'EM2',
          'name'=>'EMBRAER EMB-120 BRASILIA TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>158,
          'code'=>'EMB',
          'name'=>'EMBRAER EMB-110 BANDEIRANTE TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>159,
          'code'=>'EQV',
          'name'=>'CHANGE OF EQUIPMENT - ALL CODES N/A ',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>160,
          'code'=>'ER3',
          'name'=>'EMBRAER RJ135 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>161,
          'code'=>'ER4',
          'name'=>'EMBRAER RJ145 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>162,
          'code'=>'ERD',
          'name'=>'EMBRAER RJ140 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>163,
          'code'=>'ERJ',
          'name'=>'EMBRAER RJ135/140/145 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>164,
          'code'=>'E95',
          'name'=>'EMBRAER 195 JET 106-116',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>165,
          'code'=>'EMJ',
          'name'=>'EMBRAER RJ170/190 JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>166,
          'code'=>'F24',
          'name'=>'FOKKER F28-4000 FELLOWSHIP JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>167,
          'code'=>'F27',
          'name'=>'FOKKER F27 FRIENDSHIP/FAIRCHILD TURBOPROP',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>168,
          'code'=>'F28',
          'name'=>'FOKKER F28FELLOWSHIP ALL SERIES JET',
          'created_at'=>'2017-11-28 13:36:18',
          'updated_at'=>'2017-11-28 13:36:18'
      ] );

      Equipment::create( [
          'id'=>169,
          'code'=>'F50',
          'name'=>'FOKKER 50 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>170,
          'code'=>'F70',
          'name'=>'FOKKER 70 JET',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>171,
          'code'=>'FK7',
          'name'=>'FAIRCHILD INDUSTRIES FH-227 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>172,
          'code'=>'FRJ',
          'name'=>'FAIRCHILD 328JET JET',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>173,
          'code'=>'GRG',
          'name'=>'GRUMMAN G-21 GOOSE PIST',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>174,
          'code'=>'GRM',
          'name'=>'GRUMMAN G-73 MALLARD TURBOPROP',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>175,
          'code'=>'GRS',
          'name'=>'GULFSTREAM (GRUMMAN) G-159 G-I TURBOPROP',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>176,
          'code'=>'HOV',
          'name'=>'HOVERC 81 JET',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>177,
          'code'=>'HPH',
          'name'=>'BRITISH AERO(HANDLEY PAGE) HERALD TURBOPROP',
          'created_at'=>'2017-11-28 13:36:19',
          'updated_at'=>'2017-11-28 13:36:19'
      ] );

      Equipment::create( [
          'id'=>178,
          'code'=>'HS7',
          'name'=>'BRITISH AERO(HAWKER SIDDELEY) 748 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>179,
          'code'=>'ICE',
          'name'=>'INTER-CITY EXPRESS SURFACE',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>180,
          'code'=>'IL6',
          'name'=>'ILYUSHIN IL-62/62M/62MK JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>181,
          'code'=>'IL8',
          'name'=>'ILYUSHIN IL-18 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>182,
          'code'=>'IL9',
          'name'=>'ILYUSHIN IL-96 JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>183,
          'code'=>'ILW',
          'name'=>'ILYUSHIN IL-86 JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>184,
          'code'=>'J31',
          'name'=>'BRITISH AEROSPACE JETSTREAM 31 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>185,
          'code'=>'J32',
          'name'=>'BRITISH AEROSPACE JETSTREAM 32 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>186,
          'code'=>'J41',
          'name'=>'BRITISH AEROSPACE JETSTREAM 41 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>187,
          'code'=>'JET',
          'name'=>'UNDEFINED JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>188,
          'code'=>'L10',
          'name'=>'LOCKHEED L-1011 TRISTAR ALL SERIES JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>189,
          'code'=>'L15',
          'name'=>'LOCKHEED L-1011-500 TRISTAR JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>190,
          'code'=>'L4T',
          'name'=>'LET L410 TURBOLET TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>191,
          'code'=>'LOE',
          'name'=>'LOCKHEED L-188 ELECTRA TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>192,
          'code'=>'LOM',
          'name'=>'LOCKHEED L-188 MIXED CONFIG TURBOPROP',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>193,
          'code'=>'M11',
          'name'=>'MC DONNELL DOUGLAS MD-11 JET',
          'created_at'=>'2017-11-28 13:36:20',
          'updated_at'=>'2017-11-28 13:36:20'
      ] );

      Equipment::create( [
          'id'=>194,
          'code'=>'M1M',
          'name'=>'MCDONNELL DOUGLAS MD-11 MIXED CONF JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>195,
          'code'=>'M80',
          'name'=>'MCDONNELL DOUGLAS MD-80 ALL SERIES JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>196,
          'code'=>'M81',
          'name'=>'MC DONNELL DOUGLAS MD-81 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>197,
          'code'=>'M82',
          'name'=>'MC DONNELL DOUGLAS MD-82 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>198,
          'code'=>'M83',
          'name'=>'MC DONNELL DOUGLAS MD-83 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>199,
          'code'=>'M87',
          'name'=>'MC DONNELL DOUGLAS MD-87 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>200,
          'code'=>'M88',
          'name'=>'MC DONNELL DOUGLAS MD-88 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>201,
          'code'=>'M90',
          'name'=>'MC DONNELL DOUGLAS MD-90 JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>202,
          'code'=>'MD9',
          'name'=>'MCDONNELL DOUGLAS 900 EXPLORER HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>203,
          'code'=>'MIH',
          'name'=>'MIL MI-8 HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>204,
          'code'=>'MTL',
          'name'=>'METROLINER (TRAIN) TRAIN',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>205,
          'code'=>'MU2',
          'name'=>'MITSUBISHI MU-2/MARQUISE/SOLIT TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>206,
          'code'=>'NDC',
          'name'=>'AEROSPATIALE SN601 CORVETTE JET',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>207,
          'code'=>'NDE',
          'name'=>'AEROSPATIALE AS350/355 ECUREUIL HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>208,
          'code'=>'NDE',
          'name'=>'AEROSPATIALE AS350/355 ECUREUIL HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>209,
          'code'=>'NDH',
          'name'=>'AEROSPATIALE SA 365 DAUPHIN 2 HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>210,
          'code'=>'PA1',
          'name'=>'PIPER T-1020/1040 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>211,
          'code'=>'PA2',
          'name'=>'PIPER LIGHT AIRCRAFT PIST',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>212,
          'code'=>'PAG',
          'name'=>'PIPER (LIGHT AIRCRAFT) TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>213,
          'code'=>'PL2',
          'name'=>'PILATUS PC-12 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>214,
          'code'=>'PL6',
          'name'=>'PILATUS PC-6 TURBO-PORTER TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>215,
          'code'=>'PN6',
          'name'=>'PARTENAVIA P.68 VICTOR TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>216,
          'code'=>'S20',
          'name'=>'SAAB 2000 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>217,
          'code'=>'S58',
          'name'=>'SIKORSKY S-58T HELICOPTER',
          'created_at'=>'2017-11-28 13:36:21',
          'updated_at'=>'2017-11-28 13:36:21'
      ] );

      Equipment::create( [
          'id'=>218,
          'code'=>'S61',
          'name'=>'SIKORSKY S-61 HELICOPTER',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>219,
          'code'=>'S76',
          'name'=>'SIKORSKY S-76 HELICOPTER',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>220,
          'code'=>'S80',
          'name'=>'MC DONNELL DOUGLAS SUPER 80 JET',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>221,
          'code'=>'SF3',
          'name'=>'SAAB SF340A/340B TURBOPROP',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>222,
          'code'=>'SH3',
          'name'=>'SHORTS 330 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>223,
          'code'=>'SH6',
          'name'=>'SHORTS 360 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>224,
          'code'=>'SHS',
          'name'=>'SHORTS SKYVAN TURBOPROP',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>225,
          'code'=>'SSC',
          'name'=>'CONCORDE AEROSPATIALE/BRITISH AERO JET',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>226,
          'code'=>'SWM',
          'name'=>'FAIRCHILD(SWEARINGEN) METRO/MERLIN TURBOPROP',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>227,
          'code'=>'TAT',
          'name'=>'AUTO TRAIN FOR CARS',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>228,
          'code'=>'TCM',
          'name'=>'COMMUTER TRAIN TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>229,
          'code'=>'TEE',
          'name'=>'TRANS-EUROPE EXPRESS TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>230,
          'code'=>'TGV',
          'name'=>'TGV (HIGH SPEED TRAIN) TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>231,
          'code'=>'THS',
          'name'=>'HIGH SPEED TRAIN TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>232,
          'code'=>'THT',
          'name'=>'HOTEL TRAIN TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>233,
          'code'=>'TIC',
          'name'=>'INTERCITY TRAIN TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>234,
          'code'=>'TRD',
          'name'=>'BRITISH AERO(HAWKER SIDDELEY)TRIDENT JET',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>235,
          'code'=>'TRN',
          'name'=>'TRAIN SURFACE TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>236,
          'code'=>'TSL',
          'name'=>'SLEEPER TRAIN TRAIN',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>237,
          'code'=>'TU3',
          'name'=>'TUPOLEV TU-134 JET',
          'created_at'=>'2017-11-28 13:36:22',
          'updated_at'=>'2017-11-28 13:36:22'
      ] );

      Equipment::create( [
          'id'=>238,
          'code'=>'TU5',
          'name'=>'TUPOLEV TU-154 JET',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>239,
          'code'=>'VCV',
          'name'=>'BRITISH AERO(BAC-VICKERS)VISCOUNT TURBOPROP',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>240,
          'code'=>'WLH',
          'name'=>'WESTLAND 30 HELICOPTER',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>241,
          'code'=>'YK2',
          'name'=>'YAKOVLEV YAK-42 JET',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>242,
          'code'=>'YK4',
          'name'=>'YAKOVLEV YAK-40 JET',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>243,
          'code'=>'YS1',
          'name'=>'NAMC YS-11 TURBOPROP',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );

      Equipment::create( [
          'id'=>244,
          'code'=>'BUS',
          'name'=>'BUS',
          'created_at'=>'2017-11-28 13:36:23',
          'updated_at'=>'2017-11-28 13:36:23'
      ] );
    }
}
