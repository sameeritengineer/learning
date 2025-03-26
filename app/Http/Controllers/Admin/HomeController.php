<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TalentPool;
use App\Models\RetentionDetail;
use App\Models\Testimonial;
use App\Models\PastWork;
use App\Models\OperatedDomain;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $talentPool = TalentPool::first();
        $retention = RetentionDetail::first();
        $testimonials = Testimonial::orderBy('id', 'DESC')->get();
        $pastwork = PastWork::orderBy('id', 'DESC')->get();
        $op_domain = OperatedDomain::orderBy('id', 'DESC')->get();

        return view('admin.home.index', compact('talentPool', 'retention','testimonials','pastwork','op_domain'));
    }

    public function updateTalentPool(Request $request)
    {
        $request->validate([
            'numeric_talent' => 'required|integer',
            'pool_value' => 'required|numeric',
        ]);

        TalentPool::updateOrCreate([], $request->only('numeric_talent', 'pool_value'));

        return back()->with('success', 'Talent Pool updated successfully!');
    }

    public function updateRetention(Request $request)
    {
        $request->validate([
            'percentage_rate' => 'required|numeric',
            'time_period' => 'required|string',
        ]);

        RetentionDetail::updateOrCreate([], $request->only('percentage_rate', 'time_period'));

        return back()->with('success', 'Retention Details updated successfully!');
    }
}
