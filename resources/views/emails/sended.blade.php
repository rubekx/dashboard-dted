<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de chamados da central de atendimento do DTED') }}
        </h2>
    </x-slot>
    <main>
        <div class="alert alert-success" role="alert">Total de emails enviados: {{count($emails)}}</div>
        <div class="alert alert-danger" role="alert">Total de emails enviados: {{$total}}</div>
        <div class="alert alert-danger" role="alert">Total de emails enviados:
                @foreach ( $os_ticket as $os)
                    {{print_r($os)}}
                @endforeach
        </div>
    </main>
</x-app-layout>