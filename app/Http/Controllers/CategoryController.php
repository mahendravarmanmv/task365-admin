<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate request data with unique category title
        $validated = $request->validate([
            'category_title' => 'required|string|max:255|unique:categories,category_title',
            'category_description' => 'required|string|max:500',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('category_images', 'public');
            $validated['category_image'] = $imagePath;
        }

        // Create category
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate request data with unique category title (ignore current category's ID)
        $validated = $request->validate([
            'category_title' => 'required|string|max:255|unique:categories,category_title,' . $category->id,
            'category_description' => 'required|string|max:500',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('category_image')) {
            // Delete old image
            if ($category->category_image) {
                Storage::disk('public')->delete($category->category_image);
            }

            // Store new image
            $imagePath = $request->file('category_image')->store('category_images', 'public');
            $validated['category_image'] = $imagePath;
        }

        // Update category
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
