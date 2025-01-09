<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}<br/>
                        <h2> Welcome {{auth()->user()->username}}</h2><br/>

                    <div style="border:solid 0px grey;display:flex;justify-content:space-evenly;gap:10px;flex-wrap:wrap" >
                    @if(auth()->user()->email == "kamsonganderson39@gmail.com")
                        <form method="get" action="{{route('dashboard.view')}}" >
                            <x-primary-button :active >View product list</x-primary-button>
                        </form>
                        <a href="{{route('dashboard.create')}}">
                            <x-primary-button>create a new product</x-primary-button>
                        </a>
                    @endif

                        <a href="{{route('order.view')}}">
                            <x-primary-button>View orders</x-primary-button>
                        </a>
                    </div>
                    <!-- <x-primary-button>test</x-primary-button> -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
