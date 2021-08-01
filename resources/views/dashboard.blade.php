<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.validate.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.dataTables.min.css') }}">
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    
    
    <script src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('js/jszip.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('js/pdfmake.min.js') }}"></script> --}}
    <script src="{{ URL::asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('js/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('js/buttons.print.min.js') }}"></script> --}}


    <x-partials.dashboard.cards 
    :ticketsCreated="$ticketsCreated" 
    :ticketsClosed="$ticketsClosed"
    :ticketsReopened="$ticketsReopened" 
    :ticketsTransferred="$ticketsTransferred" 
    :ticketsOpened="$ticketsOpened"
    :ticketsOverdue="$ticketsOverdue" 
        />

    <x-partials.dashboard.modals />
    <x-partials.dashboard.script />
 
</x-app-layout>