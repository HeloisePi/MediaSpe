@extends('base')


@section('title', 'Result')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection
@section('content')

    <div class="back-bar">
        <form action="{{ url()->previous() }}"
              method="get">
            <x-button
                size="large"
                color="primary"
                kind="outlined"
                iconEnd="fa-solid fa-arrow-left"
            />
        </form>
        <div class="contenaireInformationVote">
            <div class="bulb {{ $answer == 1 ? 'info-bulb' : 'intox-bulb' }}">
                @if( $poll->is_intox == 1)

                    <img src="{{ asset('images/icon-circle-bulb.svg') }}" alt="Info">
                    <h1>INFO</h1>
                @else
                    <img src="{{ asset('images/cross.svg') }}" alt="Intox">
                    <h1>INTOX</h1>
                @endif
            </div>
        </div>
    </div>



    @if($poll->is_intox == 1)
        <style>
            .bulb {
                background: var(--app-secondary-500);
            }
        </style>

    @else
        <style>
            .bulb {
                background: var(--app-primary-700);:
            }
        </style>
    @endif



    <div class="contenaireGraph">
        <div class="cadreFigure">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>
        <div class="textContenaire">
            <p><strong>{{$intoxCount}}</strong> personnes pensenet que c'est une intox</p>
            <p>Sur {{$intoxCount + $infoCount}} votants</p>
        </div>
        <form action="{{ route('comments.show', ['poll' => $poll]) }}" method="get">
            @csrf
            <x-button
                size="large"
                color="primary"
                kind="filled"
                iconEnd="fa-solid fa-chevron-right"
                label="Voir les commentaires">
            </x-button>
        </form>
    </div>
    <div>
        <i class="fa-solid fa-book-open"></i>
        <h3>Contexte</h3>
    </div>
    <p>{{ $poll->context }}</p>
    <div></div>
    <div>
        <i class="fa-solid fa-magnifying-glass"></i>
        <h3>Analyse</h3>
    </div>
    <p>{{ $poll->analysis }}</p>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="module" src="/src/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var intoxCount = {{ $intoxCount }};
            var infoCount = {{ $infoCount }};
            var totalVotes = intoxCount + infoCount;

            Highcharts.chart('container', {
                chart: {
                    type: 'pie',
                    backgroundColor: 'transparent', // Supprime le fond blanc
                },
                title: {
                    text: null
                },


                plotOptions: {
                    pie: {
                        allowPointSelect: false,
                        cursor: 'pointer',
                        innerSize: '90%',
                        dataLabels: {
                            enabled: false
                        }

                    }
                },

                series: [{
                    name: 'Votes',
                    colorByPoint: false,
                    data: [{
                        name: 'Intox',
                        y: {{ $intoxCount }},
                        color: 'var(--app-primary-500)'
                    }, {
                        name: 'Info',
                        y: {{ $infoCount }},
                        color: 'var(--app-secondary-500)'
                    }]
                }]
            });
        });
    </script>
    <x-nav-bar/>
@endsection
