@php $ticketCreated = App\Http\Controllers\DashboardController::ticketCreated(); @endphp
@php $ticketsClosed = App\Http\Controllers\DashboardController::ticketsClosed(); @endphp
@php $ticketsReopened = App\Http\Controllers\DashboardController::ticketsReopened(); @endphp
@php $ticketsTransferred = App\Http\Controllers\DashboardController::ticketsTransferred(); @endphp
@php $ticketsOverdue = App\Http\Controllers\DashboardController::ticketsOverdue(); @endphp

<x-app-layout>
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style>
        /*Overrides for Tailwind CSS */

        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }
    </style>
    <style>
        /* dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        } */

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

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

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ticketCreated">
        {{-- <div class="relative w-auto my-6 mx-auto max-w-6xl"> --}}
            <div class="relative w-100 my-6 mx-auto ">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-3xl font-semibold">
                Chamados Criados
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('ticketCreated')">
                <span class="text-black text-2xl">
                x
                </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <table id="example2" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Chamado</th>
                            <th data-priority="2">Ticket</th>
                            <th data-priority="3">Usuário</th>
                            <th data-priority="4">Assunto</th>
                            <th data-priority="5">Status do evento</th>
                            <th data-priority="6">Status do chamado</th>
                            <th data-priority="7">Última atualização</th>
                            <th data-priority="8">Data do Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $ticketCreated as $ticket )
                        <tr>
                            <td>{{ $ticket->chamado}}</td>
                            <td>{{ $ticket->ticket_id}}</td>
                            <td>{{ $ticket->usuario}}</td>
                            <td>{{ $ticket->assunto}}</td>
                            <td>{{ $ticket->status_evento}}</td>
                            <td>{{ $ticket->status_chamado}}</td>
                            <td>{{ $ticket->ultima_atualizacao}}</td>
                            <td>{{ $ticket->envio}}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('ticketCreated')">
                Fechar
                </button>
            </div>
            </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ticketsClosed">
        {{-- <div class="relative w-auto my-6 mx-auto max-w-6xl"> --}}
            <div class="relative w-auto my-6 mx-auto ">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-3xl font-semibold">
                    Chamados Fechados
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('ticketsClosed')">
                <span class="text-black text-2xl">
                x
                </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <table id="example2" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Chamado</th>
                            <th data-priority="2">Ticket</th>
                            <th data-priority="3">Usuário</th>
                            <th data-priority="4">Assunto</th>
                            <th data-priority="5">Status do evento</th>
                            <th data-priority="6">Status do chamado</th>
                            <th data-priority="7">Última atualização</th>
                            <th data-priority="8">Data do Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $ticketsClosed as $ticket )
                        <tr>
                            <td>{{ $ticket->chamado}}</td>
                            <td>{{ $ticket->ticket_id}}</td>
                            <td>{{ $ticket->usuario}}</td>
                            <td>{{ $ticket->assunto}}</td>
                            <td>{{ $ticket->status_evento}}</td>
                            <td>{{ $ticket->status_chamado}}</td>
                            <td>{{ $ticket->ultima_atualizacao}}</td>
                            <td>{{ $ticket->envio}}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('ticketsClosed')">
                Fechar
                </button>
            </div>
            </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ticketsReopened">
        {{-- <div class="relative w-auto my-6 mx-auto max-w-6xl"> --}}
            <div class="relative w-auto my-6 mx-auto ">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-3xl font-semibold">
                    Chamados Reabertos
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('ticketsReopened')">
                <span class="text-black text-2xl">
                x
                </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <table id="example2" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Chamado</th>
                            <th data-priority="2">Ticket</th>
                            <th data-priority="3">Usuário</th>
                            <th data-priority="4">Assunto</th>
                            <th data-priority="5">Status do evento</th>
                            <th data-priority="6">Status do chamado</th>
                            <th data-priority="7">Última atualização</th>
                            <th data-priority="8">Data do Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $ticketsReopened as $ticket )
                        <tr>
                            <td>{{ $ticket->chamado}}</td>
                            <td>{{ $ticket->ticket_id}}</td>
                            <td>{{ $ticket->usuario}}</td>
                            <td>{{ $ticket->assunto}}</td>
                            <td>{{ $ticket->status_evento}}</td>
                            <td>{{ $ticket->status_chamado}}</td>
                            <td>{{ $ticket->ultima_atualizacao}}</td>
                            <td>{{ $ticket->envio}}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('ticketsReopened')">
                Fechar
                </button>
            </div>
            </div>
        </div>
    </div>
    
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ticketsTransferred">
        {{-- <div class="relative w-auto my-6 mx-auto max-w-6xl"> --}}
            <div class="relative w-auto my-6 mx-auto ">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-3xl font-semibold">
                    Chamados Transferidos
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('ticketsTransferred')">
                <span class="text-black text-2xl">
                x
                </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <table id="example2" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Chamado</th>
                            <th data-priority="2">Ticket</th>
                            <th data-priority="3">Usuário</th>
                            <th data-priority="4">Assunto</th>
                            <th data-priority="5">Status do evento</th>
                            <th data-priority="6">Status do chamado</th>
                            <th data-priority="7">Última atualização</th>
                            <th data-priority="8">Data do Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $ticketsTransferred as $ticket )
                        <tr>
                            <td>{{ $ticket->chamado}}</td>
                            <td>{{ $ticket->ticket_id}}</td>
                            <td>{{ $ticket->usuario}}</td>
                            <td>{{ $ticket->assunto}}</td>
                            <td>{{ $ticket->status_evento}}</td>
                            <td>{{ $ticket->status_chamado}}</td>
                            <td>{{ $ticket->ultima_atualizacao}}</td>
                            <td>{{ $ticket->envio}}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('ticketsTransferred')">
                Fechar
                </button>
            </div>
            </div>
        </div>
    </div>
    
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ticketsOverdue">
        {{-- <div class="relative w-auto my-6 mx-auto max-w-6xl"> --}}
            <div class="relative w-auto my-6 mx-auto ">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-3xl font-semibold">
                    Chamados Atrasados
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('ticketsOverdue')">
                <span class="text-black text-2xl">
                x
                </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <table id="example2" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Chamado</th>
                            <th data-priority="2">Ticket</th>
                            <th data-priority="3">Usuário</th>
                            <th data-priority="4">Assunto</th>
                            <th data-priority="5">Status do evento</th>
                            <th data-priority="6">Status do chamado</th>
                            <th data-priority="7">Última atualização</th>
                            <th data-priority="8">Data do Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $ticketsOverdue as $ticket )
                        <tr>
                            <td>{{ $ticket->chamado}}</td>
                            <td>{{ $ticket->ticket_id}}</td>
                            <td>{{ $ticket->usuario}}</td>
                            <td>{{ $ticket->assunto}}</td>
                            <td>{{ $ticket->status_evento}}</td>
                            <td>{{ $ticket->status_chamado}}</td>
                            <td>{{ $ticket->ultima_atualizacao}}</td>
                            <td>{{ $ticket->envio}}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('ticketsOverdue')">
                Fechar
                </button>
            </div>
            </div>
        </div>
    </div>

    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="ticketCreated-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="ticketsClosed-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="ticketsReopened-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="ticketsTransferred-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="ticketsOverdue-backdrop"></div>

<script type="text/javascript">
function toggleModal(modalID){
    console.log(modalID)
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");
}
</script>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
var table = $('#example1,#example2,#example3,#example4,#example5').DataTable( {
    responsive: true
    } )
    .columns.adjust()
    .responsive.recalc();
    } );
</script>
</x-app-layout>