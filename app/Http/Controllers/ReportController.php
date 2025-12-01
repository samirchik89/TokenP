<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Property;
use App\User;
use App\UserTokenTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function capital(Request $request)
    {
        $projects = $this->getProjects();
        $selectedProjectId = $request->get('project_id');

        $query = User::whereHas('investorShares',function($q){
            $q->whereRaw('(internal_wallet + external_wallet) > 0');
            })
            ->with(['investorShares' => function($q) use ($selectedProjectId){
                $q->whereHas('userContract', function($q) use ($selectedProjectId){
                    $q->where('property_id', $selectedProjectId ?? -1);
                });
            }, 'country', 'investorShares.userContract']);

        // Filter by project if selected
        if ($selectedProjectId) {
            $query->whereHas('investorShares.userContract', function($q) use ($selectedProjectId) {
                $q->where('property_id', $selectedProjectId);
            });
        }else{
            $query->where('id','=',-1);
        }

        // dd($query->toSql());
        $customersWithShares = $query->get();

        return view('report.cap', compact('customersWithShares', 'projects', 'selectedProjectId'));
    }

    public function investors(Request $request)
    {
        $projects = $this->getProjects();
        $selectedProjectId = $request->get('project_id');

        $query = User::where('user_type', 1)->with(['investorShares' => function($q) use ($selectedProjectId){
            $q->whereHas('userContract', function($q) use ($selectedProjectId){
                $q->where('property_id', $selectedProjectId ?? -1);
            });
        }, 'country', 'investorShares.userContract']);

        // Filter by project if selected
        if ($selectedProjectId) {
            $query->whereHas('investorShares.userContract', function($q) use ($selectedProjectId) {
                $q->where('property_id', $selectedProjectId);
            });
        }else{
            $query->where('id','=',-1);
        }

        $investors = $query->get();
        return view('report.investors', compact('investors', 'projects', 'selectedProjectId'));
    }

    public function getProjects(){
        return Property::where('user_id', auth()->user()->id)->get();
    }

    public function sales(Request $request)
    {
        $projects = $this->getProjects();
        $selectedProjectId = $request->get('project_id');
        $transactions = UserTokenTransaction::where('status', UserTokenTransaction::STATUS_SUCCESS)
            ->with(['user', 'usertoken'])
            ->whereHas('usertoken.usercontract', function($q) use ($projects, $selectedProjectId) {
                $q->whereIn('property_id', $projects->pluck('id'));
                if ($selectedProjectId) {
                    $q->where('property_id', $selectedProjectId);
                }
            })
            ->get();
        return view('report.sales', compact('transactions', 'projects', 'selectedProjectId'));
    }
}
