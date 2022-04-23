'use strict';

$(document).ready(function () {
    let timeRange = $('#time_range');
    const today = moment();
    let start = today.clone().startOf('week');
    let end = today.clone().endOf('week');
    let isPickerApply = false;
    $(window).on('load', function () {
        loadIncomeExpenseReport(start.format('YYYY-MM-D  H:mm:ss'),
            end.format('YYYY-MM-D  H:mm:ss'));
    });

    timeRange.on('apply.daterangepicker', function (ev, picker) {
        isPickerApply = true;
        start = picker.startDate.format('YYYY-MM-D  H:mm:ss');
        end = picker.endDate.format('YYYY-MM-D  H:mm:ss');
        loadIncomeExpenseReport(start, end);
    });

    window.cb = function (start, end) {
        timeRange.find('span').html(
            start.format('MMM D, YYYY') + ' - ' +
            end.format('MMM D, YYYY'));
    };

    cb(start, end);

    const lastMonth = moment().startOf('month').subtract(1, 'days');
    const thisMonthStart = moment().startOf('month');
    const thisMonthEnd = moment().endOf('month');

    timeRange.daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        showDropdowns: true,
        autoUpdateInput: false,
        ranges: {
            'Today': [moment(), moment()],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [
                moment().startOf('week').subtract(7, 'days'),
                moment().startOf('week').subtract(1, 'days')],
            'This Month': [thisMonthStart, thisMonthEnd],
            'Last Month': [
                lastMonth.clone().startOf('month'),
                lastMonth.clone().endOf('month')],
        },
    }, cb);

    window.loadIncomeExpenseReport = function (startDate, endDate) {
        $.ajax({
            type: 'GET',
            url: incomeExpenseReportUrl,
            dataType: 'json',
            data: {
                start_date: startDate,
                end_date: endDate,
            },
            cache: false,
        }).done(prepareReport);
    };

    // window.prepareReport = function (result) {
    //     $('#daily-work-report').html('');
    //     let data = result.data;
    //     let incomeTotal = 0;
    //     let expenseTotal = 0;
    //     $.each(result.data.incomeTotal, function () {
    //         incomeTotal += this;
    //     });
    //     $.each(result.data.expenseTotal, function () {
    //         expenseTotal += this;
    //     });
    //     if (expenseTotal === 0 && incomeTotal === 0) {
    //         $('#income-expense-report-container').html('');
    //         $('#income-expense-report-container').append(
    //             '<div align="center" class="no-record">No Records Found</div>');
    //         return true;
    //     } else {
    //         $('#income-expense-report-container').html('');
    //         $('#income-expense-report-container').append('<canvas id="daily-work-report"></canvas>');
    //     }
    //
    //     let barChartData = {
    //         labels: data.date,
    //         datasets: [
    //             {
    //                 label: 'Total Income',
    //                 backgroundColor: 'rgba(0,255,0,0.6)',
    //                 data: data.incomeTotal,
    //             },
    //             {
    //                 label: 'Total Expense',
    //                 backgroundColor: 'rgba(255,0,0,0.6)',
    //                 data: data.expenseTotal,
    //             },
    //         ],
    //     };
    //     let ctx = document.getElementById('daily-work-report').getContext('2d');
    //     ctx.canvas.style.height = '400px';
    //     ctx.canvas.style.width = '100%';
    //     window.myBar = new Chart(ctx, {
    //         type: 'bar',
    //         data: barChartData,
    //         options: {
    //             title: {
    //                 display: true,
    //                 text: income_and_expense_reports,
    //             },
    //             tooltips: {
    //                 enabled: true,
    //                 mode: 'single',
    //                 callbacks: {
    //                     label: function (tooltipItem, data) {
    //                         var label = data.datasets[tooltipItem.datasetIndex].label;
    //                         var datasetLabel = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
    //                         return label + ': ' + addCommas(datasetLabel);
    //                     },
    //                 },
    //             },
    //             elements: {
    //                 rectangle: {
    //                     borderWidth: 1,
    //                     borderColor: 'rgb(0, 0, 0, 0.1)',
    //                 },
    //             },
    //             responsive: false,
    //             scales: {
    //                 xAxes: [
    //                     {
    //                         ticks: {
    //                             autoSkip: false,
    //                         },
    //                     },
    //                 ],
    //                 yAxes: [
    //                     {
    //                         ticks: {
    //                             callback: function (label) {
    //                                 return label / 1000 + 'k';
    //                             },
    //                         },
    //                         scaleLabel: {
    //                             display: true,
    //                             labelString: 'Revenues (In ' +
    //                                 currentCurrencyName + ')',
    //                         },
    //                     }],
    //             },
    //         },
    //     });
    // };

    window.prepareReport = function (result) {

        let results = result.data;
        let ctx = document.getElementById('daily-work-report');
        let incomeTotal = 0;
        let expenseTotal = 0;
        $.each(result.data.incomeTotal, function () {
            incomeTotal += this;
        });
        $.each(result.data.expenseTotal, function () {
            expenseTotal += this;
        });
        if (expenseTotal === 0 && incomeTotal === 0) {
            $('#income-expense-report-container').html('');
            $('#income-expense-report-container').append(
                '<div align="center" class="no-record">No Records Found</div>');
            return true;
        } else {
            $('#income-expense-report-container').html('');
            $('#income-expense-report-container').append('<canvas id="daily-work-report"></canvas>');
        }
// Define colors
        let primaryColor = KTUtil.getCssVariableValue('--bs-primary');
        let dangerColor = KTUtil.getCssVariableValue('--bs-danger');

// Define fonts
        let fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

        // Chart data
        const data = {
            labels: results.date,
            datasets: [
                {
                    label: 'Total Income',
                    backgroundColor: primaryColor,
                    data: results.incomeTotal,
                },
                {
                    label: 'Total Expense',
                    backgroundColor: dangerColor,
                    data: results.expenseTotal,
                },
            ],
        };

// Chart config
        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: income_and_expense_reports,
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            label: function (tooltipItem, results) {
                                let label = results.datasets[tooltipItem.datasetIndex].label;
                                let datasetLabel = results.datasets[tooltipItem.datasetIndex].results[tooltipItem.index];
                                return label + ': ' + addCommas(datasetLabel);
                            },
                        },
                    },
                },
                responsive: true,
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            callback: function (label) {
                                return label / 1000 + 'k';
                            },
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Revenues (In ' +
                                currentCurrencyName + ')',
                        },
                    }
                }
            },
            defaults: {
                global: {
                    defaultFont: fontFamily
                }
            }
        };

// Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
        let myChart = new Chart(ctx, config);
    }
});
