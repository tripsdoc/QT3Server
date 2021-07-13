<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;

class ExportController extends Controller
{
    function getTag() {
        $data = DB::table('HSC_InventoryPallet AS IP')
        ->join('HSC_Inventory AS I', 'I.InventoryID', '=', 'IP.InventoryID')
        ->join('ContainerInfo AS CI', 'CI.Dummy', '=', 'IP.ExpCntrID')
        ->where('IP.ExpCntrID', '>', 0)
        ->whereRaw("IP.Tag <> ''")
        //->whereRaw("ISNULL(CI.NTUnstuffingStatus, '') <> 'completed'")
        ->select('IP.Tag', 'I.HBL', 'I.TranshipmentRef')
        ->get();
        $response['status'] = (count($data) > 0)? TRUE : FALSE;
        $response['data'] = $data;
        return response($response);
    }
}
