   <div class="col-12">
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
                       <h5 class="card-title">Eventos</h5>

                      
                         <div id="lineChart"></div>                      

                       </div>

                     </div>
                   </div>


@push('scripts')
<script>
    let chart; // variável global para guardar o gráfico

    function initChart() {
        const el = document.querySelector("#lineChart");
        if (!el) return;

        // Se já existe um gráfico anterior, destrói-o
        if (chart) {
            chart.destroy();
        }

        // Cria novo gráfico
        chart = new ApexCharts(el, {
            series: [{
                name: "Eventos",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'straight' },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        });

        chart.render();
    }

    // Se a página for carregada direto (sem navegação Livewire), já renderiza
    document.addEventListener("DOMContentLoaded", initChart);
</script>
@endpush