<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Category;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('category')->get();
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
        'lead_email' => 'nullable|email|unique:leads,lead_email',
        'lead_phone' => 'nullable|string|max:20',
        'lead_notes' => 'nullable|string',
        'location' => 'nullable|string|max:255',
        'business_name' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'website_type' => 'nullable|string|max:255',
        'features_needed' => 'nullable|string',
        'reference_website' => 'nullable|string|max:255',
        'budget_min' => 'nullable|integer|min:0',
        'budget_max' => 'nullable|integer|min:0|gte:budget_min',
        'service_timeframe' => 'nullable|string|max:255',
    ]);

    Lead::create([
        'category_id' => $request->category_id,
        'lead_name' => $request->lead_name,
        'lead_email' => $request->lead_email,
        'lead_phone' => $request->lead_phone,
        'lead_notes' => $request->lead_notes,
        'location' => $request->location,
        'business_name' => $request->business_name,
        'industry' => $request->industry,
        'website_type' => $request->website_type,
        'features_needed' => $request->features_needed,
        'reference_website' => $request->reference_website,
        'budget_min' => $request->budget_min,
        'budget_max' => $request->budget_max,
        'service_timeframe' => $request->service_timeframe,
    ]);

    return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
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
        'lead_email' => 'nullable|email|unique:leads,lead_email,' . $lead->id,
        'lead_phone' => 'nullable|string|max:20',
        'lead_notes' => 'nullable|string',
        'location' => 'nullable|string|max:255',
        'business_name' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'website_type' => 'nullable|string|max:255',
        'features_needed' => 'nullable|string',
        'reference_website' => 'nullable|string|max:255',
        'budget_min' => 'nullable|integer|min:0',
        'budget_max' => 'nullable|integer|min:0|gte:budget_min',
        'service_timeframe' => 'nullable|string|max:255',
    ]);

    $lead->update($validatedData);

    return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
}




    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
