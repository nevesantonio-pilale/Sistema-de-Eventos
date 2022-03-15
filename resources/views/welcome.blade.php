@extends('layouts.main')

@section('title', 'HDC Eventos')
 
@section('content')
     
    <div id="search-container" class="col-md-12">
        <h1> Busque um evento </h1>
        <form action="/" Method= "GET">
            <input type="text" name="search" id="search" class= "form-control" placeholder = "Procurar...">
        </form>
    </div>
    
    <div id="events-container" class= "col-md-12">

    @if($search)
            <h2> Resultado relacionado a sua pesquisa de: {{ $search }} </h2>
        @else
            <h2> Proximos Eventos </h2>
            <p class= "subtitle"> Veja os eventos dos proximos dias </p>
        @endif

            <div id="cards-container" class="row">

                @foreach ($events as $event)
                    <div class="card col-md-3">
                        <img src="/img/events/{{ $event-> image }} " alt=" {{ $event -> title }} ">

                        <div class="card-body">
                            <div class="card-date"> {{ Date ( 'd/m/Y' , strtotime($event->date)) }} </div>
                            <h5 class="card-title"> {{ $event -> title }} </h5>
                            <p class="card-participants"> {{count($event->users)}} participantes </p>
                            <a href="/events/ {{ $event -> id }} " class="btn btn-primary"> Saber mais </a>
                        </div>
                    </div>
                @endforeach

                @if(count($events) == 0 && $search)

                    <p  class= "no-events"> Não foi possivél encontrar um evento com o nome: {{ $search }}! <a href="/"> Ver todos Eventos agendados </a> </p>
                @elseif(count($events) == 0)
                @endif

            </div>
        </div>
            
@endsection
