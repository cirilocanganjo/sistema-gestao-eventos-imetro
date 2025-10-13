  @props(['eventCounter' => [], 'eventMonths' => [] ])
   <div class='col-12 d-flex gap-2 align-items-center'>
           <div class="col-6">
                    <div class="card">

                               <div class="filter">
                                 <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                   <li class="dropdown-header text-start">
                                     <h6></h6>
                                   </li>

                                 </ul>
                               </div>

                               <div class="card-body">
                               <h5  id='card-title-bar-events' class="card-title"></h5>                      
                                 <div id="barChart"></div>
                               </div>

                    </div>
           </div>

            <div class="col-6">
                    <div class="card">

                               <div class="filter">
                                 <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                   <li class="dropdown-header text-start">
                                     <h6></h6>
                                   </li>

                                 </ul>
                               </div>

                               <div class="card-body">
                               <h5 id='card-title-line-events' class="card-title"></h5>                      
                                 <div id="lineChart"></div>
                               </div>

                    </div>
            </div>
   </div>


@push('scripts')
<script>
    let barChart; // variável global para guardar o gráfico
    let lineChart;

    function initChart() {
        const cardTitleOfBarEvents = document.getElementById('card-title-bar-events').textContent = 'Gráfico de Barras';
        const cardTitleOfLineEvents = document.getElementById('card-title-line-events').textContent = 'Gráfico de Linha';
        const barChartName = 'Gráfico de Barras de todos Eventos';
        const lineChartName = 'Gráfico de Linhas de todos Eventos';
        const barEl = document.querySelector("#barChart");
        const lineEl = document.querySelector("#lineChart");

        if (!barEl) return;        

        if (barChart) {
            barChart.destroy(); // Se já existe um gráfico anterior, destrói-o
        }
      
        barChart = new ApexCharts(barEl, {
            series: [{
                name: `${barChartName}`,
                data: @json($eventCounter ?? [])
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: { show: false },
                zoom: { enabled: true }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '90%',
                    endingShape: 'rounded'
                    },
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'straight' },
            grid: {
                row: {
                    colors: ['#f3f3f5', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($eventMonths ?? []),
            }
        });

        barChart.render();

        if (!lineEl) return;        

        if (lineChart) {
            lineChart.destroy();
        }
       
        lineChart = new ApexCharts(lineEl, {
            series: [{
                name: `${lineChartName}`,
                data: @json($eventCounter ?? [])
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: { show: false },
                zoom: { enabled: true }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '90%',
                    endingShape: 'rounded'
                    },
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'straight' },
            grid: {
                row: {
                    colors: ['#f3f3f5', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($eventMonths ?? []),
            }
        });

        lineChart.render();
    }

    
    document.addEventListener("DOMContentLoaded", initChart); // Se a página for carregada direto (sem navegação Livewire), já renderiza
    document.addEventListener("livewire:navigated", () => {
        if (typeof initChart === "function") {
            initChart();
        }
    });
</script>
@endpush