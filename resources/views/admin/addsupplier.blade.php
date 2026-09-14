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
                    <form action="{{ route('admin.postaddsupplier') }}" method="post">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="supplier_name">Supplier Name:</label>
                            <input type="text" class="form-control" name="supplier_name" placeholder="Enter supplier name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="supplier_email">Supplier Email:</label>
                            <input type="email" class="form-control" name="supplier_email" placeholder="Enter supplier email" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="supplier_contact">Supplier Contact:</label>
                            <input type="number" class="form-control" name="supplier_contact" placeholder="Enter supplier contact info" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" value="Add Supplier">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
