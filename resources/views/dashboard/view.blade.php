<style>
    .product_list{
        border:1;
        margin:0px auto;
    }
    .product_list tr{
        border:solid 1px grey;
        padding:10px;
    }
    .product_list tr:nth-child(even){
        background-color:rgba(0,0,0,0.1);
    }
    .product_list tr td ,.product_list tr th{
        border:solid 1px grey;
        padding:10px
    }

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard View products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2>View product list</h2><br/>

                    <div>
                        <table class="product_list">
                            <tr style="color:white;background-color:rgb(50,50,50)">
                                <th>Product_name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Action</th>

                            </tr>

                            @foreach($products as $product)
                                <tr >
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['price'] }}</td>
                                    <td>{{ $product['description'] }}</td>
                                    <td>{{ $product['stock'] }}</td>
                                    <td style="display:flex;gap:10px" >
                                        <a href="{{route('dashboard.edit' ,$product )}}">
                                            <x-secondary-button style="padding:5px;font-size:xx-small">update</x-secondary-button>
                                        </a>
                                        <form style="margin:0px; padding:0px;" method="post" action="{{route('dashboard.destroy' ,$product)}}" >
                                            @csrf
                                            @method('delete')
                                            <x-danger-button style="padding:5px;font-size:xx-small">delete</x-danger-button> 
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
