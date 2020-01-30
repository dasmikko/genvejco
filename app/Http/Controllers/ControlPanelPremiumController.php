<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Route;
use Carbon\Carbon;

// Models
use App\Shortlink;
use App\ShortlinkView;

class ControlPanelPremiumController extends Controller
{
    public function viewShortlinkStats(Request $request, $id) {
    	$view = view("pages.controlpanel.premium.viewstats");

    	$shortlink = Shortlink::where('id', $id)->withCount('shortlinkViews')->first();
    	$refererlist = DB::table('shortlink_views')
    	                 ->select('*', DB::raw('count(referer) as total'))
    	                 ->where('shortlink_id', $id)
    	                 ->groupBy('referer')
    	                 ->orderBy('total', 'desc')
    	                 ->get();


        $viewsList = DB::table('shortlink_views')
                         ->select('*')
                         ->where('shortlink_id', $id)
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

            
        

        // Get all views, grouped by month
        $viewsData = ShortlinkView::select('id', 'created_at')->where('shortlink_id', $id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('n'); // grouping by years
                //return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });


        // Iterate through all 12 months, and put it into a nice array for Chart library
        $dataArray = array();
        for ($i=1; $i < 13; $i++) {
            if($viewsData->get($i)) {
                $dataArray[$i] = $viewsData->get($i)->count();
            } else {
                $dataArray[$i] = 0;
            }
        }

        $view->viewsData = $dataArray;
    	$view->shortlink = $shortlink;
        $view->viewsList = $viewsList;
    	$view->refererlist = $refererlist;
    	$view->currentPath = Route::getCurrentRoute()->uri();

    	return $view;
    }
}
