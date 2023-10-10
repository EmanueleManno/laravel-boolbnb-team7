@extends('layouts.app')

@section('title', 'Statistics')

@section('main')

    <div id="statistics" class="container my-5">
        <div class="row row-cols-1 row-cols-md-2">

            <!-- Views Per Months -->
            <div class="col mb-4">
                <h5 class="mb-2">Visualizzazioni per mese</h5>
                <div class="border rounded p-2">
                    <canvas id="month-views"></canvas>
                </div>
            </div>

            <!-- Views Per Year -->
            <div class="col mb-4">
                <h5 class="mb-2">Visualizzazioni per anno</h5>
                <div class="border rounded p-2">
                    <canvas id="year-views"></canvas>
                </div>
            </div>

            <!-- Messages Per Months -->
            <div class="col mb-4">
                <h5 class="mb-2">Messaggi per mese</h5>
                <div class="border rounded p-2">
                    <canvas id="month-messages"></canvas>
                </div>
            </div>

            <!-- Messages Per Year -->
            <div class="col mb-4">
                <h5 class="mb-2">Messaggi per anno</h5>
                <div class="border rounded p-2">
                    <canvas id="year-messages"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!--Import cdn ChartJS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //*** FUNCTIONS ***//

        const initGraph = (elem, title, labels, data, backgroundColor) => {
            const graph = new Chart(elem, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: title,
                        data,
                        borderWidth: 1,
                        backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
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

        // Get Data From PHP
        const viewsPerMonthsData = <?php echo json_encode($month_views); ?>;
        const messagesPerMonthsData = <?php echo json_encode($month_messages); ?>;
        const viewsPerYearsData = <?php echo json_encode($year_views); ?>;
        const messagesPerYearsData = <?php echo json_encode($year_messages); ?>;

        // Vars
        const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre',
            'Ottobre', 'Novembre', 'Dicembre'
        ];


        //*** LOGIC ***//
        // Init All Views Graphs
        initGraph(viewsPerMonthsElem, 'Visualizzazioni per mese', months, Object.values(viewsPerMonthsData), '#dc3545');
        initGraph(viewsPerYearsElem, 'Visualizzazioni per anno', Object.keys(viewsPerYearsData), Object.values(
            viewsPerYearsData), '#dc3545');

        // Init All Messages Graphs
        initGraph(messagesPerMonthsElem, 'Messaggi per mese', months, Object.values(messagesPerMonthsData));
        initGraph(messagesPerYearsElem, 'Messaggi per anno', Object.keys(messagesPerYearsData), Object.values(
            messagesPerYearsData));
    </script>

@endsection
