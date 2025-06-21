<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        // Count of frontend registered users (vendors)
        $usersCount = User::where('user_type', 'user')->count();

        // Total leads
        $leadsCount = Lead::count();

        // Total payments
        $paymentsCount = Payment::count();

        // Total categories
        $categoriesCount = Category::count();

        // Monthly sales for line chart (amount per month)
        $monthlySalesRaw = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                                  ->groupBy('month')
                                  ->orderBy('month')
                                  ->pluck('total', 'month')
                                  ->toArray();

        // Ensure all 12 months exist in the array
        $monthlySales = array_replace(array_fill(1, 12, 0), $monthlySalesRaw);

        // Contact enquiries (user support messages)
        $supportRequests = [
            'in_progress' => Contact::where('status', 'in_progress')->count(),
            'complete' => Contact::where('status', 'complete')->count(),
        ];

        return view('dashboard', compact(
            'usersCount',
            'leadsCount',
            'paymentsCount',
            'categoriesCount',
            'monthlySales',
            'supportRequests'
        ));
    }
}
