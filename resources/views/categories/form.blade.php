@csrf
<div class="mb-3">
    <label class="form-label">Category Title</label>
    <input type="text" name="category_title" placeholder="Enter Category Title" value="{{ old('category_title', $category->category_title ?? '') }}" class="form-control">
    @error('category_title') <span style="color: red;">{{ $message }}</span> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category Description</label>
    <textarea name="category_description" placeholder="Enter Category Description" class="form-control">{{ old('category_description', $category->category_description ?? '') }}</textarea>
    @error('category_description') <span style="color: red;">{{ $message }}</span> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category Image</label>
    <input type="file" name="category_image" class="form-control">
    @error('category_image') <span style="color: red;">{{ $message }}</span> @enderror
    @if(isset($category) && $category->category_image)
        <img src="{{ asset('storage/' . $category->category_image) }}" width="100">
    @endif
</div>

<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
<a class="btn btn-secondary" href="{{ route('categories.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
