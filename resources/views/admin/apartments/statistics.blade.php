@extends('layouts.app')

@section('title', 'Statistics')

@section('main')

<div class="container my-5">
  <div class="row">
    <!--Month Views-->
    <div class="col-6">
    <canvas id="month-views" data-statistics="{{ implode($month_views)}}"></canvas>
    </div>
    <!--Month Messages-->
    <div class="col-6">
    <canvas id="month-messages" data-statistics="{{ implode($month_messages)}}"></canvas>
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
  //Year Views
  const yearData = <?php echo json_encode($year_views) ?>;
  const yearLabel = Object.keys(yearData);
  const yearView = Object.values(yearData);

  //Year Messages
  const yearDataMessages = <?php echo json_encode($year_messages) ?>;
  const yearLabelMessages = Object.keys(yearDataMessages);
  const yearMessages = Object.values(yearDataMessages);

  //Month Views & Messages
  const month = document.getElementById('month-views');
  const monthMessages = document.getElementById('month-messages');

  //Month Views Graph
  new Chart(month, {
    type: 'bar',
    data: {
      labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre' ,'Dicembre'],
      datasets: [{
        label: 'Visualizzazioni per mese',
        data: month.dataset.statistics,
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

  //Month Messages Graph
  new Chart(monthMessages, {
    type: 'bar',
    data: {
      labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre' ,'Dicembre'],
      datasets: [{
        label: 'Messaggi per mese',
        data: monthMessages.dataset.statistics,
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

  //Year Views Graph
  const year = document.getElementById('year-views');

new Chart(year, {
  type: 'bar',
  data: {
    labels: yearLabel,
    datasets: [{
      label: 'Visualizzazioni per anno',
      data: yearView,
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

 //Year Messages Graph
 const yearMessagesGraph = document.getElementById('year-messages');

new Chart(yearMessagesGraph, {
  type: 'bar',
  data: {
    labels: yearLabelMessages,
    datasets: [{
      label: 'Messaggi per anno',
      data: yearMessages,
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
</script>

@endsection