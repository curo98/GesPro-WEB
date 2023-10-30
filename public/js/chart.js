// chart colors
        var colors = ['#007bff', '#28a745', '#444444', '#c3e6cb', '#dc3545', '#6c757d'];

        var chBar = document.getElementById("chBar");
        var chartData = {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            datasets: [{
                    data: [589, 445, 483, 503, 689, 692, 634],
                    backgroundColor: colors[0]
                },
                {
                    data: [209, 245, 383, 403, 589, 692, 580],
                    backgroundColor: colors[1]
                },
                {
                    data: [489, 135, 483, 290, 189, 603, 600],
                    backgroundColor: colors[2]
                },
                {
                    data: [639, 465, 493, 478, 589, 632, 674],
                    backgroundColor: colors[4]
                }
            ]
        };

        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            categoryPercentage: 0.5
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
