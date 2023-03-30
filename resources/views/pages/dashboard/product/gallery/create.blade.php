<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard.product.index') }}">Product</a> &raquo; {{ $product->name }} &raquo; Create
            &raquo; Upload Photos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-blod rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                            <ul>
                                @foreach (errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif

                <div class="overflow-hidden sm-rounded-md">
                    <div class="px-4 py-5 sm:p-6">
                        <form action="{{ route('dashboard.product.gallery.store', $product->id) }}" class="w-full"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="block w-full px-3 mb-5">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                                    <input type="file" name="files[]" multiple accept="image/*"
                                        class="block w-full bg-gray-100 text-gray-700 rounded py-3 px-4 leading-tight border-none focus:outline-none focus:bg-white focus:border-gray-700">
                                </div>
                                <div class="w-full px-3 mb-5">
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 px-4 py-2 text-white rounded shadow-xl">
                                        Save Gallery
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
