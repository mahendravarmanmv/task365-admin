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

        // Convert 1–12 keys to 0–11 for JS compatibility
        $monthlySalesZeroIndexed = [];
        foreach ($monthlySalesRaw as $month => $total) {
            $monthlySalesZeroIndexed[$month - 1] = $total;
        }

        // Ensure all 12 months exist from index 0 to 11
        $monthlySales = array_replace(array_fill(0, 12, 0), $monthlySalesZeroIndexed);

        // Contact enquiries (user support messages)
        $supportRequests = [
            'in_progress' => Contact::where('status', 'in_progress')->count(),
            'complete' => Contact::where('status', 'complete')->count(),
        ];

        $categoryUserData = Category::withCount('users')
    ->orderByDesc('users_count')
    ->get(['id', 'category_title']);

        return view('dashboard', compact(
    'usersCount',
    'leadsCount',
    'paymentsCount',
    'categoriesCount',
    'monthlySales',
    'supportRequests',
    'categoryUserData' // ✅ THIS MUST BE INCLUDED
));

    }
}
