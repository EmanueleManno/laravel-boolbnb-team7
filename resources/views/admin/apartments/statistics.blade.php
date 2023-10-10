@extends('layouts.app')

@section('title', 'Statistics')

@section('main')

    <div class="container my-5">
        <div class="row">
            <!--Month Views-->
            <div class="col-6">
                <canvas id="month-views" data-statistics="{{ implode($month_views) }}"></canvas>
            </div>
            <!--Month Messages-->
            <div class="col-6">
                <canvas id="month-messages" data-statistics="{{ implode($month_messages) }}"></canvas>
            </div>
            <!--Year Views-->
            <div class="col-6">
                <canvas id="year-views"></canvas>
            </div>
            <!--Year Messages-->
            <div class="col-6">
                <canvas id="year-messages"></canvas>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!--Import cdn ChartJS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //*** FUNCTIONS ***//

        const initGraph = (elem, title, labels, data) => {
            const graph = new Chart(elem, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: title,
                        data,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            return graph;
        }

        //*** INIT ***//
        // Get DOM Elems
        const viewsPerMonthsElem = document.getElementById('month-views');
        const messagesPerMonthsElem = document.getElementById('month-messages');
        const viewsPerYearsElem = document.getElementById('year-views');
        const messagesPerYearsElem = document.getElementById('year-messages');

        // Get Data
        const yearData = <?php echo json_encode($year_views); ?>;
        const yearLabel = Object.keys(yearData);
        const yearView = Object.values(yearData);

        const yearDataMessages = <?php echo json_encode($year_messages); ?>;
        const yearLabelMessages = Object.keys(yearDataMessages);
        const yearMessages = Object.values(yearDataMessages);

        // Vars
        const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre',
            'Ottobre', 'Novembre', 'Dicembre'
        ];


        //*** LOGIC ***//
        // Init All Months Graphs
        initGraph(viewsPerMonthsElem, 'Visualizzazioni per mese', months, viewsPerMonthsElem.dataset.statistics);
        initGraph(messagesPerMonthsElem, 'Messaggi per mese', months, messagesPerMonthsElem.dataset.statistics);

        // Init All Years Graphs
        initGraph(viewsPerYearsElem, 'Visualizzazioni per anno', yearLabel, yearView);
        initGraph(messagesPerYearsElem, 'Messaggi per anno', yearLabelMessages, yearMessages);
    </script>

@endsection
