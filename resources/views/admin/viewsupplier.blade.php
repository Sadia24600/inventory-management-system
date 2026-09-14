<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                         <h1 class="display-5 fw-bold">View Suppliers</h1>
                            <a href="/addsupplier" class="btn btn-sm btn-success">+ Add More Suppliers</a>
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
                                <th scope="col">Supplier ID</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Supplier Email</th>
                                <th scope="col">Supplier Contact</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->supplier_email }}</td>
                                <td>{{ $supplier->supplier_contact }}</td>
                                <td>
                                    <a href="{{route('admin.updatesupplier', $supplier->id)}}"
                                       class="btn btn-sm btn-warning">Update</a>
                                
                                    <a href="{{route('admin.deletesupplier', $supplier->id)}}"
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
