<?php

namespace App\Http\Controllers;

use App\Models\AssetFunction;
use App\Models\FirewallManagment;
use App\Models\Location;
use App\Models\InstalledSoftware;
use App\Models\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        Location::fixTree();
        $firewallManagment = FirewallManagment::where('condition', '=', 'temporary')->latest()->take(10)->get();
        $userId = UserId::where('condition', '=', 'temporary')->latest()->take(10)->get();
        $firmware = Location::groupBy('asset_firmware')->where('asset_firmware', '!=', '')->latest()->take(10)->get();
        $softwares = InstalledSoftware::latest()->take(10)->get();
        return view('dashboard.index')->with(['firewall' => $firewallManagment, 'userId' => $userId, 'firmware' => $firmware, 'softwares'=>$softwares]);;

    }

    public function scada(){
        return view('dashboard.skada.index');
    }
    public function smart(){
        return view('dashboard.smart.index');

    }
    public function information_security(){
        return view('dashboard.information_security.index');
    }

    public function complianceReport(Request $request)
    {

    }

}
