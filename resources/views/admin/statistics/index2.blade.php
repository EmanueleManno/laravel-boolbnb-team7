<div class="container my-5">
    <canvas id="myChart"
    data-statistics="{{ implode($views)}}"
    ></canvas>
</div>
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre' ,'Dicembre'],
        datasets: [{
          label: 'Visualizzazioni',
          data: myChart.dataset.statistics,
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
  