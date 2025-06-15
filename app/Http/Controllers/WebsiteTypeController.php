<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\WebsiteType;

class WebsiteTypeController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
$types = WebsiteType::with('category')->latest()->get();
return view('website_types.index', compact('types'));
}

public function create()
{
$categories = Category::all();
return view('website_types.create', compact('categories'));
}

public function store(Request $request)
{
$request->validate([
	'category_id' => 'required|exists:categories,id',
	'type_title' => 'required|string|max:255',
]);

WebsiteType::create($request->only('category_id', 'type_title'));

return redirect()->route('website-types.index')->with('success', 'Website Type created.');
}

public function edit(WebsiteType $websiteType)
{
$categories = Category::all();
return view('website_types.edit', compact('websiteType', 'categories'));
}

public function update(Request $request, WebsiteType $websiteType)
{
$request->validate([
	'category_id' => 'required|exists:categories,id',
	'type_title' => 'required|string|max:255',
]);

$websiteType->update($request->only('category_id', 'type_title'));

return redirect()->route('website-types.index')->with('success', 'Updated successfully.');
}

public function destroy(WebsiteType $websiteType)
{
$websiteType->delete();
return redirect()->route('website-types.index')->with('success', 'Deleted successfully.');
}
public function getByCategory($category_id)
{
    $types = WebsiteType::where('category_id', $category_id)->get(['id', 'type_title']);
    return response()->json($types);
}

}
