<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('updated_product'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session('updated_product') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <form action="{{route('admin.postupdateproduct', $product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group mt-3">
                            <label for="old_image">Old Image:</label>
                            <img src="{{ asset('db_img/' . $product->product_image) }}" alt="{{ $product->product_name }}" style="max-width: 200px;">
                        </div>
                         <div class="form-group mt-3">
                            <label for="product_image">Upload New Image:</label>
                            <input type="file" class="form-control" name="product_image" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="product_name">Product Name:</label>
                            <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="product_description">Product Description:</label>
                            <textarea class="form-control" name="product_description" required>{{$product->product_description}}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="product_quantity">Product Quantity:</label>
                            <input type="number" class="form-control" min="1" name="product_quantity" value="{{$product->product_quantity}}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="product_price">Product Price:</label>
                            <input type="number" class="form-control" min="0" name="product_price" value="{{$product->product_price}}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="category_name">Category:</label>
                            <select name="category_name">
                                <option value="{{$product->category_name}}">
                                    {{$product->category_name}}
                                </option>
                                @foreach($categories as $category)
                                <option value="{{$category->category_name}}">
                                    {{$category->category_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group mt-3">
                            <label for="supplier_name">Suppliers:</label>
                            <select name="supplier_name">
                                <option value="{{$product->supplier_name}}">
                                    {{$product->supplier_name}}
                                </option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->supplier_name}}">
                                    {{$supplier->supplier_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" value="Update Product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
