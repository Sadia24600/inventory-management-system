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
                    <form action="{{route('admin.postupdatesupplier', $supplier->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{$supplier->supplier_name}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier_email" class="form-label">Supplier Email</label>
                            <input type="email" class="form-control" id="supplier_email" name="supplier_email" value="{{$supplier->supplier_email}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier_contact" class="form-label">Supplier Contact</label>
                            <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" value="{{$supplier->supplier_contact}}" required>
                        </div> 
                        <button type="submit" class="btn btn-success">Update Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
