<style>
    .order_list{
        border:1;
        margin:0px auto;
    }
    .order_list tr{
        border:solid 1px grey;
        padding:10px;
    }
    .order_list tr:nth-child(even){
        background-color:rgba(0,0,0,0.1);
    }
    .order_list tr td ,.order_list tr th{
        border:solid 1px grey;
        padding:10px
    }

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard View Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2>View order list</h2><br/>

                    <div>
                        <table class="order_list">
                            <tr style="color:white;background-color:rgb(50,50,50)">
                                <th>Order_date</th>
                                <th>User_name</th>
                                <th>User_email</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                            @foreach($orders as $order)
                                <tr >
                                    <td>{{ $order['order_date'] }}</td>
                                    <td>{{ $order['user']->username }}</td>
                                    <td>{{ $order['user']->email }}</td>
                                    <td>{{ $order['status'] }}</td>

                                    <td style="display:flex;gap:10px" >
                                       
                                        <form style="margin:0px; padding:0px;" method="post" 
                                        action="{{route('order.delete' ,$order['id'])}}">
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
