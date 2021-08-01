<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de chamados da central de atendimento do DTED') }}
        </h2>
    </x-slot>
    <x-partials.dashboard.cards 
    :ticketsCreated="$ticketsCreated" 
    :ticketsClosed="$ticketsClosed"
    :ticketsReopened="$ticketsReopened" 
    :ticketsTransferred="$ticketsTransferred" 
    :ticketsOpened="$ticketsOpened"
    :ticketsOverdue="$ticketsOverdue" />
    <x-partials.dashboard.modals />
    <x-partials.dashboard.script />
</x-app-layout>