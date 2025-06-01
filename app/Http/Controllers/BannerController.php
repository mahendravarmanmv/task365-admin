<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function edit()
    {
        $banner = Banner::first(); // Assumes one record
        return view('banner.edit', compact('banner'));
    }

    public function update(Request $request)
{
    $validated = $request->validate([
        'welcome_text' => 'required|string',
        'banner_title' => 'required|string',
        'banner_description' => 'nullable|string',
    ]);

    // Update or Create Banner (assuming you're using one record only)
    Banner::updateOrCreate(
        ['id' => 1], // Or use appropriate ID
        $validated
    );

    return redirect()->back()->with('success', 'Banner updated successfully!');
}

}

