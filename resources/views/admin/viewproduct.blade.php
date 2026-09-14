<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                         <h1 class="display-5 fw-bold">View Products</h1>
                            <a href="/addproduct" class="btn btn-sm btn-success">+ Add More Products</a>
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
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    @if($product->product_image)
                                        <img src="{{ asset('db_img/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="100%">
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->supplier_name }}</td>
                                <td>
                                    <a href="{{route('admin.updateproduct', $product->id)}}"
                                       class="btn btn-sm btn-warning">Update</a>
                                
                                    <a href="{{route('admin.deleteproduct', $product->id)}}"
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
