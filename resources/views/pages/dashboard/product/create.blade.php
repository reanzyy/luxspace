<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard.product.index') }}">Product</a> &raquo; Create
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

                <div class="shadow overflow-hidden sm-rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <form action="{{ route('dashboard.product.store') }}" class="w-full" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="block w-full px-3 mb-5">
                                    <label for="name"
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                                    <input type="text" id="name" value="{{ old('name') }}" name="name" placeholder="Name" autocomplete="off" 
                                        class="block w-full bg-gray-100 text-gray-700 rounded py-3 px-4 leading-tight border-none focus:outline-none focus:bg-white focus:border-gray-700">
                                </div>
                                <div class="block w-full px-3 mb-5">
                                    <label for="price"
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price</label>
                                    <input  type="number" id="price" value="{{ old('price') }}" name="price" placeholder="Price"
                                        class="block w-full bg-gray-100 text-gray-700 rounded py-3 px-4 leading-tight border-none focus:outline-none focus:bg-white focus:border-gray-700">
                                </div>
                                <div class="block w-full px-3 mb-5">
                                    <label for="description"
                                        class="block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                                    <textarea id="description" name="description" class="block w-full bg-gray-100 text-gray-700 rounded py-3 px-4 leading-tight border-none focus:outline-none focus:bg-white focus:border-gray-700">{!! old('description') !!}</textarea>
                                </div>
                                <div class="w-full px-3 mb-5"> 
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 text-white rounded shadow-xl">
                                        Save Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</x-app-layout>
