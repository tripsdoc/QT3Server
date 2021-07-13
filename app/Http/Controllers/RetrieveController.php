<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;

class RetrieveController extends Controller
{
    function getTag() {
        $data = DB::table('HSC_InventoryPallet AS IP')
        ->join('HSC_Inventory AS I', 'I.InventoryID', '=', 'IP.InventoryID')
        ->join('HSC_DeliveryInfo AS DI', 'IP.DeliveryID', '=', 'DI.DeliveryID')
        //->leftJoin('Transporter AS T', 'T.ID', '=', 'DI.TransportedID')
        ->where('IP.DeliveryID', '>', 0)
        ->whereRaw("IP.Tag <> ''")
        ->select('IP.Tag', 'I.HBL', 'I.TranshipmentRef')
        ->get();
        $response['status'] = (count($data) > 0)? TRUE : FALSE;
        $response['data'] = $data;
        return response($response);
    }
}
