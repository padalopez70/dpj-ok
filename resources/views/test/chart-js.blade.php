<x-app-layout>

    <div class="flex flex-col lg:flex-row lg:pt-20 lg:px-10 w-full">
        <div class="mx-10 lg:w-5/12 border-4 bg-gray-50">
            <canvas id="chart1"></canvas>
        </div>
        <div class="p-10 lg:w-5/12 right-0 border-4 bg-gray-50">
            <canvas id="chart2"></canvas>
        </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script>
        $(function () {
        primerGraf();
        segundoGraf();


        function primerGraf() {
            //get the pie chart canvas
            var cData = JSON.parse(`<?php echo $chart_data; ?>`);
            var ctx = $("#chart1");

            //pie chart data
            var data = {
                labels: cData.label,
                datasets: [{
                    label: "Users Count",
                    data: cData.data,
                    backgroundColor: [
                        "#ffb0c1",
                        "#ffcf9f",
                        "#ffe6aa",
                        "#a2e0e0",
                        "#98d0f6",
                        "#ccb2ff",
                        "#e3e4e6",
                    ],
                    borderColor: [
                        "#686868",
                        "#686868",
                        "#686868",
                        "#686868",
                        "#686868",
                        "#686868",
                        "#686868",
                    ],
                    borderWidth: [1, 1, 1, 1, 1, 1, 1]
                }]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Cantidad de usuarios Administradores",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create Pie Chart class object
            var chart1 = new Chart(ctx, {
                type: "pie",
                data: data,
                options: options
            });

        }

        function segundoGraf() {
            //get the pie chart canvas
            var cData = JSON.parse(`<?php echo $chart_data2; ?>`);

            var ctx = $("#chart2");

            //pie chart data
            var data = {
                labels: cData.label,
                datasets: [{
                    label: "Users Count",
                    data: cData.data,
                    backgroundColor: [
                        "#DEB887",
                        "#A9A9A9",
                        "#DC143C",
                        "#F4A460",
                        "#2E8B57",
                        "#1D7A46",
                        "#CDA776",
                    ],
                    borderColor: [
                        "#CDA776",
                        "#989898",
                        "#CB252B",
                        "#E39371",
                        "#1D7A46",
                        "#F4A460",
                        "#CDA776",
                    ],
                    borderWidth: [1, 1, 1, 1, 1, 1, 1]
                }]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Cantidad de usuarios Administradores",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create Pie Chart class object
            var chart1 = new Chart(ctx, {
                type: "bar",
                data: data,
                options: options
            });

        }
    });
    </script>
    </div>
</x-app-layout>
