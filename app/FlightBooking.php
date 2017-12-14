<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    public static function store($data){
        $new_booking = new static();
        $new_booking->user_id = $data['user_id'];
        $new_booking->reference = $data['booking_reference'];
        $new_booking->pnr = $data['pnr_code'];
        $new_booking->itinerary_amount = $data['itinerary_amount'];
        $new_booking->admin_markup = $data['admin_markup'];
        $new_booking->airline_markdown = $data['airline_markdown'];
        $new_booking->vat = $data['vat'];
        $new_booking->agent_markup = $data['agent_markup'];
        $new_booking->total_amount = $data['total_amount'];
        $new_booking->ticket_time_limit = $data['ticket_time_limit'];
        $new_booking->pnr_status = $data['pnr_status'];
        $new_booking->pnr_request_response = $data['pnr_request_response'];
        $new_booking->save();
    }
}
