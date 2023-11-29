<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card p-4">
                                <h2 class="mb-4">Add Category</h2>
                                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="category_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_image" class="form-label">Category Image</label>
                                        <input type="file" class="form-control" name="category_image" id="category_image" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <div class="card p-4">
                                <h2 class="mb-4">Categories</h2>
                         
                                <table class="table table-striped">
                                   
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>User ID</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Photo</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user_id }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>{{ $category->updated_at }}</td>
                                            <td><img src="{{ asset('img/' . $category->category_image) }}" style="max-width: 200px; max-height: 200px;" alt=""></td>
                                            <td>
                                                <a href="{{url('/all/editCategory/edit/'.$category->id)}}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('/all/category/delete/'.$category->id)}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="card p-4">
                                <h2 class="mb-4">Deleted Categories</h2>
                             
                                <table class="table table-striped">
                                  
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>User ID</th>
                                            <th>Deleted At</th>
                                            <th>Photo</th>
                                            <th>Restore</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                             
                                    <tbody>
                                        @foreach ($deletedCategories as $deletedCategory)
                                        <tr>
                                            <td>{{ $deletedCategory->id }}</td>
                                            <td>{{ $deletedCategory->category_name }}</td>
                                            <td>{{ $deletedCategory->user_id }}</td>
                                            <td>{{ $deletedCategory->created_at }}</td>
                                            <td><img src="{{ asset('img/' . $deletedCategory->category_image) }}" style="max-width: 200px; max-height: 200px;" alt=""></td>
                                            <td>
                                                <a href="{{ url('/all/category/restore/'.$deletedCategory->id) }}">
                                                    <i class="fas fa-trash-restore"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('/all/category/forceDelete/'.$deletedCategory->id)}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
