<!DOCTYPE html>
<html lang="en">

<x-app-layout>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body style="background-color: white;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Edit Category</h2>

                <form method="POST" action="{{ url('all/editCategory/update/'.$categories->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            value="{{ $categories->category_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image-preview" class="form-label">Category Image Preview</label>
                        <img id="image-preview" class="img-fluid" src="{{ asset('img/' . $categories->category_image) }}"
                            alt="Category Image Preview" style="max-width: 500px; max-height: 500px;">
                    </div>
                    <div class="mb-3">
                        <label for="category_image" class="form-label">Select a new Category Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*"
                            onchange="updateImagePreview(event)">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ url('/all/category') }}" class="btn btn-primary">Go Back</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateImagePreview(event) {
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</x-app-layout>

</html>
