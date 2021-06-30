@php $ticketCreated = App\Http\Controllers\DashboardController::ticketCreated(); @endphp
@php $ticketsClosed = App\Http\Controllers\DashboardController::ticketsClosed(); @endphp
@php $ticketsReopened = App\Http\Controllers\DashboardController::ticketsReopened(); @endphp
@php $ticketsTransferred = App\Http\Controllers\DashboardController::ticketsTransferred(); @endphp
@php $ticketsOverdue = App\Http\Controllers\DashboardController::ticketsOverdue(); @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketCreated')">
            <div class=" bg-white border rounded p-5 bg-ost-blue">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-blue">
                            <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Criados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketCreated)}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsClosed')">
            <!--Metric Card-->
            <div class="bg-white border rounded p-5 bg-ost-green">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-green"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Fechados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsClosed)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsReopened')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-gray-400 p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-gray-400"><i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Reabertos</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsReopened)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsTransferred')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-yelow p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-yelow"><i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Transferidos</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsTransferred)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsOverdue')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-purple p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-purple"><i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Atrasados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsOverdue)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>

</x-app-layout>