<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard | Edit products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2>Edit product</h2><br/>

                <form 
                    method="post" 
                    action="{{route('dashboard.update' ,$product)}}" 
                    style="border:solid 0px grey;width:fit-content;margin:0px auto"
                >
                @csrf
                @method('post')

                    <div >
                        <x-input-label style="text-align:left" for="product_name" >Name</x-input-label>
                        <x-text-input id="product_name" type="text" name="name" value="{{$product->name}}" required />
                    </div>

                    <div>
                        <x-input-label for="product_price" >Price</x-input-label>
                        <x-text-input  id="product_price" type="number" name="price" value="{{$product->price}}" required />
                    </div>

                    <div>
                        <x-input-label for="product_description" >Description</x-input-label>
                        <x-text-input  id="product_description" type="text" name="description" value="{{$product->description}}" required />
                    </div>

                    <div>
                        <x-input-label for="product_qty" >Quantity</x-input-label>
                        <x-text-input id="product_qty" type="number" name="quantity" value="{{$product->stock}}" required />
                    </div>
                    
                    <!-- <div>
                        <x-input-label for="file" >Product image</x-input-label>
                        <x-text-input id="file" type="file" name="image" value="{{$product->name}}"  />
                    </div> -->

                    <br/>

                    <div>
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{route('dashboard')}}">
                            <x-secondary-button>Cancel</x-secondary-button>
                        </a>
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
