$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

function ajaxg(url, callback) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(data) {
            callback(data);
        },
        error: function(data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function(i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function truncateWithEllipses(text, max) {
    return text.substr(0, max - 1) + (text.length > max ? "..." : "");
}

$(window).on("load", function() {
    var ctx = $("#chart");
    var ctx2 = $("#chart2");
    var curso = $("#curso").val();

    var chart = new Chart(ctx, {
        type: "line",
        data: {
            datasets: [
                {
                    label: "Entregas por actividad",
                    backgroundColor: ["rgba(54, 162, 235, 0.2)"],
                    pointBackgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                ]
            }
        }
    });

    var chart2 = new Chart(ctx2, {
        type: "radar",
        data: {
            datasets: [
                {
                    label: "Aprovechamiento",
                    backgroundColor: ["rgba(155, 106, 86, 0.5)"],
                    pointBackgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    });

    function addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach(dataset => {
            dataset.data.push(data);
        });
        chart.update();
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach(dataset => {
            dataset.data.pop();
        });
        chart.update();
    }

    this.ajaxg("../informacionActividades/" + curso, function name(data) {
        data.forEach(element => {
            addData(
                chart,
                truncateWithEllipses(element["title"], 20),
                element["works"]
            );
        });
    });

    this.ajaxg("../informacionCursop/" + curso, function name(data) {
        let label = ["Alto", "Medio", "Bajo"];
        let datos = [0, 0, 0];
        data.forEach(element => {
            if (element["qualification"] > 90) {
                datos[0] += 1;
            } else if (element["qualification"] > 75) {
                datos[1] += 1;
            } else if (element["qualification"] > 69) {
                datos[2] += 1;
            }
        });

        addData(chart2, label[0], datos[0]);
        addData(chart2, label[1], datos[1]);
        addData(chart2, label[2], datos[2]);
    });
});
