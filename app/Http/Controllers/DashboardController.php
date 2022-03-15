<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libraries\Repositories\DashboardRepository;
use App\Libraries\Repositories\MonthsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;

class DashboardController extends AppBaseController
{

    public $dashboardRepository;
    public $monthsRepository;

    function __construct(DashboardRepository $dashboardRepo, MonthsRepository $monthsRepository)
    {
        $this->dashboardRepository = $dashboardRepo;
        $this->monthsRepository = $monthsRepository;
    }

    /*
     * Get all the stats and present the dashboard view
     */
    public function getIndex(Request $request) {

        $user = Auth::user();
        $months = $this->monthsRepository->getRange();

        $from = $request->get('from', date('Y-m', strtotime('-1 year')));
        $from = Carbon::createFromFormat('Y-m', $from)->startOfMonth()->toDateString();

        $to   = $request->get('to', date('Y-m'));
        $to   = Carbon::createFromFormat('Y-m', $to)->endOfMonth()->toDateString();

        $data = $this->dashboardRepository->getData($user, $from, $to);

        return view('dashboard.index')
            ->with('months', $months)
            ->with('data', $data)
            ->with('from', $from)
            ->with('to', $to);
    }

}
