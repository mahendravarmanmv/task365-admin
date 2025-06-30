<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\LeadNotificationToAdmin;
use App\Mail\LeadCreatedMailToUsers;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('category')->orderBy('id', 'desc')->get();
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('leads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'lead_name' => 'required|string|max:255',
            'lead_email' => 'required|email|unique:leads,lead_email',
            'lead_phone' => [
    'required',
    'regex:/^[6-9]\d{9}$/',
    'not_regex:/^(.)\1*$/', // Prevent repeated digits like 0000000000, 1111111111
],
            'lead_notes' => 'nullable|string', // Only this remains optional
            'location' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            /*'industry' => 'required|string|max:255',*/
            'website_type' => 'required|exists:website_types,id',
            'features_needed' => 'required|string',
            'reference_website' => 'required|string|max:255',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|min:0|gte:budget_min',
            'lead_cost' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'service_timeframe' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
        ]);

        // Generate lead_unique_id
        $lastLead = \App\Models\Lead::orderByDesc('id')->first();
        if ($lastLead && preg_match('/T365-(\d+)/', $lastLead->lead_unique_id, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        } else {
            $nextNumber = 17;
        }
        $leadUniqueId = 'T365-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $lead = Lead::create([
            'category_id' => $request->category_id,
            'lead_name' => $request->lead_name,
            'lead_email' => $request->lead_email,
            'lead_phone' => $request->lead_phone,
            'lead_notes' => $request->lead_notes,
            'location' => $request->location,
            'business_name' => $request->business_name,
            /*'industry' => $request->industry,*/
            'website_type' => $request->website_type,
            'features_needed' => $request->features_needed,
            'reference_website' => $request->reference_website,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'lead_cost' => $request->lead_cost,
            'stock' => $request->stock,
            'service_timeframe' => $request->service_timeframe,
            'button_text' => $request->button_text ?? 'Buy Now', // default if not provided
            'lead_unique_id' => $leadUniqueId,
        ]);
		
		// ✅ Send to Admin
    //Mail::to('task365.in@gmail.com')->send(new LeadNotificationToAdmin($lead));

    // ✅ Send to relevant Users
    $users = User::where('user_type', 'user')
                ->where('approved', 1)
                ->whereHas('categories', function ($query) use ($lead) {
                    $query->where('categories.id', $lead->category_id);
                })
                ->get();

    foreach ($users as $user) {
    Mail::to($user->email)->queue(new LeadCreatedMailToUsers($lead)); // ✅ Use queue or send
}

        return redirect()->route('leads.index')->with('success', '✅ Lead created successfully and emails sent to users.');
    }



    public function edit(Lead $lead)
    {
        $categories = Category::all();

        // No need to extract from budget_range string anymore
        $budgetMin = $lead->budget_min;
        $budgetMax = $lead->budget_max;

        return view('leads.edit', compact('lead', 'categories', 'budgetMin', 'budgetMax'));
    }



    public function update(Request $request, Lead $lead)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'lead_name' => 'required|string|max:255',
            'lead_email' => 'required|email|unique:leads,lead_email,' . $lead->id,
            'lead_phone' => [
                'required',
                'regex:/^[6-9]\d{9}$/',
                'not_regex:/^(.)\1*$/',
            ],
            'lead_notes' => 'nullable|string', // Only this is optional
            'location' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            /*'industry' => 'required|string|max:255',*/
            'website_type' => 'required|exists:website_types,id',
            'features_needed' => 'required|string',
            'reference_website' => 'required|string|max:255',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|min:0|gte:budget_min',
            'lead_cost' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'service_timeframe' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
        ]);

        // Ensure 'button_text' has a default if omitted
        $validatedData['button_text'] = $request->input('button_text', 'Buy Now');

        // Do not allow update of lead_unique_id
        unset($validatedData['lead_unique_id']);

        $lead->update($validatedData);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }




    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
