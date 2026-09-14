<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('view categories') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                         <h1 class="display-5 fw-bold">View Categories</h1>
                            <a href="/addcategory" class="btn btn-sm btn-success">+ Add More Categories</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                         {{ session('success') }}
                           <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-white">
                            <tr>
                                <th scope="col">Category ID</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <a href="{{route('admin.updatecategory', $category->id)}}"
                                       class="btn btn-sm btn-warning">Update</a>
                                
                                    <a href="{{route('admin.deletecategory', $category->id)}}"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
