'use strict';
let chartType = 'line';

$(document).ready(function () {
    const today = moment()
    let start = today.clone().startOf('month')
    let end = today.clone().endOf('month')

    function cb (start, end) {
        $("#chartFilter").html(start + " - " + end);
    }

    $("#chartFilter").daterangepicker({
        startDate: start,
        endDate: end,
        dateFormat: "yy-mm-dd",
        ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [
                moment().subtract(1, "days"),
                moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(7, "days"), moment().subtract(1, "days")],
            "Last 30 Days": [moment().subtract(30, "days"), moment().subtract(1, "days")],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month")]
        },
    }, cb);

    cb(start, end);
let startDate
let endDate
    setTimeout(function () {
         startDate = start.format('DD-MM-YYYY');
         endDate = end.format('DD-MM-YYYY');
        setIncomeReport(startDate, endDate);
    }, 1000);
let startNewDate
let endNewDate
    $(document).on('change', '#chartFilter', function () {
        let date = $(this).val().split('-');
        startNewDate = moment(new Date(date[0])).format('DD-MM-YYYY');
        endNewDate = moment(new Date(date[1])).format('DD-MM-YYYY');
        setIncomeReport(startNewDate, endNewDate);
    });  
    $(document).on('click', '#changeChart', function () {
        if (chartType == 'line') {
            chartType = 'bar';
            $('.chart').removeClass('fa-chart-bar');
            $('.chart').addClass('fa-chart-line');
            if (!startNewDate) {
                setIncomeReport(startDate, endDate);
            } else {
                setIncomeReport(startNewDate, endNewDate);
            }
        } else {
            chartType = 'line';
            $('.chart').addClass('fa-chart-bar');
            $('.chart').removeClass('fa-chart-line');
            if (!startNewDate) {
                setIncomeReport(startDate, endDate);
            } else {
                setIncomeReport(startNewDate, endNewDate);
            }
        }
    });
  
    function setIncomeReport (startNewDate, endNewDate) {
        $.ajax({
            type: 'GET',
            url: route('super.admin.income.chart'),
            dataType: 'json',
            data: {
                start_date: startNewDate,
                end_date: endNewDate,
            },
            success: function (result) {
                if (result.success) {
                    $('#hospitalIncomeChart').empty();
                    $('#hospitalIncomeChart')
                        .append('<canvas id="revenueChart"></canvas>');
                    var ctx = document.getElementById("revenueChart");
                    var myChart = new Chart(ctx, {
                        type: chartType,
                        data: {
                            labels: result.data.days,
                            datasets: [result.data.income],
                        },
                        options: {
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.dataset.label ||
                                                '';

                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat(
                                                    'en-US', {
                                                        style: 'currency',
                                                        currency: 'INR'
                                                    }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                },
                                legend: {
                                    display: false,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stacked: true,
                                    ticks: {
                                        min: 50,
                                        // stepSize: 1000,
                                        callback: function (value) {
                                            return new Intl.NumberFormat(
                                                'en-US', {
                                                    style: 'currency',
                                                    currency: 'INR'
                                                }).format(value);
                                        },
                                    }
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: true,
                            responsiveAnimationDuration: 500,
                            legend: {display: false},
                        },
                    });
                }
            },
        });
    }
})
