<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\LeadNotificationToAdmin;
use App\Mail\LeadCreatedMailToUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
                'not_regex:/^(.)\1*$/',
            ],
            'lead_notes' => 'nullable|string',
            'location' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'website_type' => 'required|exists:website_types,id',
            'features_needed' => 'required|string',
            'reference_website' => 'required|string|max:255',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|min:0|gte:budget_min',
            'lead_cost' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'service_timeframe' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'lead_file' => 'required|file|mimes:jpg,jpeg|max:2048',
        ]);

        // Generate lead_unique_id
        $lastLead = Lead::orderByDesc('id')->first();
        $nextNumber = ($lastLead && preg_match('/T365-(\d+)/', $lastLead->lead_unique_id, $matches))
            ? (int)$matches[1] + 1
            : 17;
        $leadUniqueId = 'T365-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Handle file upload
        $filePath = $request->hasFile('lead_file')
            ? $request->file('lead_file')->store('leads', 'public')
            : null;

        // Create lead
        $lead = Lead::create([
            'category_id' => $request->category_id,
            'lead_name' => $request->lead_name,
            'lead_email' => $request->lead_email,
            'lead_phone' => $request->lead_phone,
            'lead_notes' => $request->lead_notes,
            'location' => $request->location,
            'business_name' => $request->business_name,
            'website_type' => $request->website_type,
            'features_needed' => $request->features_needed,
            'reference_website' => $request->reference_website,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'lead_cost' => $request->lead_cost,
            'stock' => $request->stock,
            'service_timeframe' => $request->service_timeframe,
            'button_text' => $request->button_text ?? 'Buy Now',
            'lead_unique_id' => $leadUniqueId,
            'lead_file' => $filePath,
        ]);

        // ✅ Send to Admin
        /*Mail::to('task365.in@gmail.com')->send(new LeadNotificationToAdmin($lead));*/

        // Fetch relevant users
        $users = User::where('user_type', 'user')
            ->where('approved', 1)
            ->whereHas('categories', function ($query) use ($lead) {
                $query->where('categories.id', $lead->category_id);
            })
            ->get();

        $phoneNumbers = [];

        foreach ($users as $user) {
            // ✅ Send email
            Mail::to($user->email)->queue(new LeadCreatedMailToUsers($lead, $user));

            // 📲 Collect phone numbers
            if ($user->phone) {
                $phoneNumbers[] = $user->phone;
            }
        }

        // ✅ Send bulk SMS if numbers exist
        if (count($phoneNumbers)) {
            $encodedId = encode_id($lead->id); // e.g., "dxE"
            $leadUrl = 'task365.in/l/' . $encodedId;
            $this->sendBulkSMS($phoneNumbers, $leadUrl);
        }

        return redirect()->route('leads.index')->with('success', '✅ Lead created successfully, emails and SMS sent.');
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
            'lead_notes' => 'nullable|string',
            'location' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            // 'industry' => 'required|string|max:255',
            'website_type' => 'required|exists:website_types,id',
            'features_needed' => 'required|string',
            'reference_website' => 'required|string|max:255',
            'budget_min' => 'required|integer|min:0',
            'budget_max' => 'required|integer|min:0|gte:budget_min',
            'lead_cost' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'service_timeframe' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'lead_file' => 'nullable|file|mimes:jpg,jpeg|max:2048', // optional on update
        ]);

        // Ensure default value for button_text
        $validatedData['button_text'] = $request->input('button_text', 'Buy Now');

        // Handle file upload if new file is uploaded
        if ($request->hasFile('lead_file')) {
            if ($lead->lead_file && Storage::disk('public')->exists($lead->lead_file)) {
                Storage::disk('public')->delete($lead->lead_file);
            }

            $filePath = $request->file('lead_file')->store('leads', 'public');
            $validatedData['lead_file'] = $filePath;
        }


        // Do not allow updating lead_unique_id
        unset($validatedData['lead_unique_id']);

        $lead->update($validatedData);

        return redirect()->route('leads.index')->with('success', '✅ Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        // Delete associated lead file if it exists
        if ($lead->lead_file && Storage::exists('public/leads/' . $lead->lead_file)) {
            Storage::delete('public/leads/' . $lead->lead_file);
        }

        // Delete the lead record
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

    public function sendBulkSMS(array $phoneNumbers, $leadUrl)
    {
        $username = env('SMS_USERNAME');
        $password = env('SMS_PASSWORD');
        $from = env('SMS_SENDER_ID');
        $messagetype = 1;
        $dnd_check = 0;

        $message = "Task365: Dear sds , New lead generated for your asdas . View details: dasd .
     Thank you for choosing Task365 ( A product of LORHAN SPOT EARN Private Limited).";
        $messageEncoded = urlencode($message);

        // Convert array to comma-separated string
        $numbers = implode(',', $phoneNumbers);   

        $request = [
            'username' => $username,
            'password' => $password,
            'from' => $from,
            'to' => $numbers,
            'msg' => $messageEncoded,
            'type' => $messagetype,
            'dnd_check' => $dnd_check,
        ];

        $url = "https://www.smsstriker.com/API/sms.php";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        \Log::info("Bulk SMS Sent to: $numbers. Result: $result");
    }
    
}
