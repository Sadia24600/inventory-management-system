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
                   <div class="container mt-4">
                    <div class="row">
                        {{-- Left Side Order / Balance --}}
                        <div class="col-md-6">
                           <div class="card-shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Order Summary</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->product_name}}</td>
                                            <td>
                                                <form action="{{route('admin.updatequantity',$order->id)}}" method="post">
                                                    @csrf
                                                <input type="number" name="product_quantity"
                                                 class="form-control form-control-sm" 
                                                 value="{{$order->product_quantity}}" min="1">
                                                <input type="submit" class="btn btn-sm btn-primary" value="Update" name="submit">
                                                </form>
                                            </td>
                                            <td>{{$order->product_price}}</td>
                                            @php 
                                              $grand_total=0;
                                              $total_price=$order->product_quantity * $order->product_price;
                                              $grand_total+=$total_price;
                                            @endphp
                                            <td>{{$total_price}}</td>
                                            <td>
                                                <a href="{{route('admin.removeorder' , $order->id)}}" 
                                                    class="btn btn-danger" 
                                                    onclick="alert('Do you want to remove this?')">Remove
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between mt-3">
                                    <h5>Total Balance:</h5>
                                    <h5 class="text-success">{{$grand_total}}</h5>
                                </div>
                                <button class="btn btn-primary w-100 mt-3"
                                 onclick="alert('Do you want to print this order?')">Print Order</button>
                            </div>
                           </div>
                        </div>
                        {{-- Right Side: Prodcut cards --}}
                        <div class="col-md-6">
                            <div class="row row-cols-2 g-3">
                                @foreach($products as $product)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <a href="{{route('admin.postorder', $product->id)}}">
                                            <img src="{{asset('db_img/' . $product->product_image)}}" 
                                            alt="{{$product->product_image}}" 
                                            class="card-img-top p-2" style="cursor:pointer;">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                   </div>

                </div> 
           </div>
        </div>
    </div>               
</x-app-layout>