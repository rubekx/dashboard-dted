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
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }

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
    <div class="py-12">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer"
                onclick="document.getElementById('myModal').showModal()"">
                <!--Metric Card-->
                <div class=" bg-white border rounded p-5 bg-ost-blue">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-blue"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Criado</h5>
                        <h3 class="font-bold text-4xl text-white">X</h3>
                    </div>

                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer"
            onclick="document.getElementById('myModal').showModal()">
            <!--Metric Card-->
            <div class="bg-white border rounded p-5 bg-ost-green">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-green"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Fechado</h5>
                        <h3 class="font-bold text-4xl text-white">X</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer"
            onclick="document.getElementById('myModal').showModal()">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-gray-400 p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-gray-400"><i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Reaberto</h5>
                        <h3 class="font-bold text-4xl text-white">X</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer"
            onclick="document.getElementById('myModal').showModal()">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-yelow p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-yelow"><i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Transferido</h5>
                        <h3 class="font-bold text-4xl text-white">X</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer"
            onclick="document.getElementById('myModal').showModal()">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-purple p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-purple"><i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Atrasado</h5>
                        <h3 class="font-bold text-4xl text-white">X</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>
    </div>


    <dialog id="myModal" class="h-auto w-11/12 md:w-1/1 p-5 bg-white rounded-md ">
        <div class="flex flex-col w-full h-auto">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Modal Header
                </div>
                <div onclick="document.getElementById('myModal').close();"
                    class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
                <!--Header End-->
            </div>
            @php $tickets = App\Http\Controllers\DashboardController::ticketCreated(); @endphp
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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
                    @foreach ( $tickets as $ticket )
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
                </tbody </table> </div> </dialog> <!-- jQuery -->
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <!--Datatables -->
                <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
                <script>
                    $(document).ready(function() {
			
			var table = $('#example').DataTable( {
					responsive: true
				} )
				.columns.adjust()
				.responsive.recalc();
		} );
                </script>
</x-app-layout>