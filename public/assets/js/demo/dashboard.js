let revenueData = [];
let fetchEarningData = function () {

    $.ajax({
        url: "dashboard/earning",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            jQuery.map(data, function (n) {
                revenueData.push(n)

            });
        },
    });
};

let customerData = [];
let fetchCustomerData = function () {
    $.ajax({
        url: "dashboard/customer",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            customerData.push(data)
        },
    });
};
let fetchMemberData = function () {
    $.ajax({
        url: "dashboard/member",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            customerData.push(data)
        },
    });
};
let orderData = [];
let debitData = [];
let stockInAmount = [];
let handleRenderChart = function() {
    // global apexchart settings
    Apex = {
        title: {
            style: {
                fontSize:  '14px',
                fontWeight:  'bold',
                fontFamily:  app.font.family,
                color:  app.color.white
            },
        },
        legend: {
            fontFamily: app.font.family,
            labels: {
                colors: '#fff'
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: app.font.family
            }
        },
        grid: {
            borderColor: 'rgba('+ app.color.whiteRgb + ', .25)',
        },
        dataLabels: {
            style: {
                fontSize: '12px',
                fontFamily: app.font.family,
                fontWeight: 'bold',
                colors: undefined
            }
        },
        xaxis: {
            axisBorder: {
                show: true,
                color: 'rgba('+ app.color.whiteRgb + ', .25)',
                height: 1,
                width: '100%',
                offsetX: 0,
                offsetY: -1
            },
            axisTicks: {
                show: true,
                borderType: 'solid',
                color: 'rgba('+ app.color.whiteRgb + ', .25)',
                height: 6,
                offsetX: 0,
                offsetY: 0
            },
            labels: {
                style: {
                    colors: '#fff',
                    fontSize: '12px',
                    fontFamily: app.font.family,
                    fontWeight: 400,
                    cssClass: 'apexcharts-xaxis-label',
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#fff',
                    fontSize: '12px',
                    fontFamily: app.font.family,
                    fontWeight: 400,
                    cssClass: 'apexcharts-xaxis-label',
                }
            }
        }
    };


    // small stat chart
    let x = 0;
    let chart = [];


    let elmList = [].slice.call(document.querySelectorAll('[data-render="apexchart"]'));
    elmList.map(function(elm) {
        let chartType = elm.getAttribute('data-type');
        let chartHeight = elm.getAttribute('data-height');
        let chartTitle = elm.getAttribute('data-title');
        let chartColors = [];
        let chartPlotOptions = {};
        let chartData = [];
        let chartStroke = {
            show: false
        };

        if (chartType === 'bar') {

            chartColors = [app.color.theme];
            chartPlotOptions = {
                bar: {
                    horizontal: false,
                    columnWidth: '65%',
                    endingShape: 'rounded'
                }
            };
            chartData = [{
                name: chartTitle,
                data:  revenueData
            }];
        } else if (chartType === 'pie') {
            chartColors = ['rgba('+ app.color.themeRgb + ', 1)', 'rgba('+ app.color.themeRgb + ', .75)', 'rgba('+ app.color.themeRgb + ', .5)'];
            chartData = customerData
        } else if (chartType === 'donut') {
            chartColors = ['rgba('+ app.color.themeRgb + ', .15)', 'rgba('+ app.color.themeRgb + ', .35)', 'rgba('+ app.color.themeRgb + ', .55)', 'rgba('+ app.color.themeRgb + ', .75)', 'rgba('+ app.color.themeRgb + ', .95)'];
            chartData = stockInAmount;
            chartStroke = {
                show: false,
                curve: 'smooth',
                lineCap: 'butt',
                colors: 'rgba(' + app.color.blackRgb + ', .25)',
                width: 2,
                dashArray: 0,
            };
            chartPlotOptions = {
                pie: {
                    donut: {
                        background: 'transparent',
                    }
                }
            };

        } else if (chartType === 'line') {
            chartColors = [app.color.theme];

            chartData = [{
                name: chartTitle,
                data: orderData
            }];
            chartStroke = {
                curve: 'straight',
                width: 2
            };
        }

        let chartOptions = {
            chart: {
                height: chartHeight,
                type: chartType,
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: chartColors,
            stroke: chartStroke,
            plotOptions: chartPlotOptions,
            series: chartData,
            grid: {
                show: false
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return ''
                        }
                    },
                    formatter: (value) => { return ''+ value },
                }
            },
            xaxis: {
                labels: {
                    show: true
                }
            },
            yaxis: {
                labels: {
                    show: true
                }
            }
        };
        chart[x] = new ApexCharts(elm, chartOptions);
        chart[x].render();
        x++;
    });


    let serverChartOptions = {
        chart: {
            height: '100%',
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        grid: {
            show: true,
            borderColor: false,
        },
        stroke: {
            show: false
        },
        colors: ['rgba(' + app.color.whiteRgb + ', .25)', app.color.theme],
        series: [
            {
                name: 'DEBIT',
                data: debitData
            },
            {
                name: 'CREDIT',
                data: creditData
            }],

        xaxis: {
            // categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', 30],
            labels: {
                show: true
            }
        },
        fill: {
            opacity: .65
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "BDT " + val
                }
            }
        }
    };
    let apexServerChart = new ApexCharts(
        document.querySelector('#chart-server'),
        serverChartOptions
    );
    apexServerChart.render();
};
let fetchOrderData = function () {
    $.ajax({
        url: "dashboard/order",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            jQuery.map(data, function (n) {
                orderData.push(n)

            });
        },
        complete: function (data) {
            handleRenderChart()
        },

        // error: function (data) {
        //
        // }
    });
};
let fetchStockInAmountData = function () {
    $.ajax({
        url: "dashboard/stockIn-amount",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            jQuery.map(data, function (n) {
                stockInAmount.push(n)
            });
        },
    });
};
let fetchDebitData = function () {
    $.ajax({
        url: "dashboard/debit-amount",
        type: "Get",
        dataType: "json",
        cache: false,
        success: function (data) {
            jQuery.map(data, function (n) {
                debitData.push(n)
            });
        },
    });
};
let creditData = [];
let fetchCreditData = function () {
    $.ajax({
        url: "dashboard/credit-amount",
        type: "Get",
        dataType: "json",
        cache: false,
        data: {},

        success: function (data) {
            jQuery.map(data, function (n) {
                creditData.push(n)
            });
        },
    });
};

fetchEarningData();
fetchMemberData();
fetchCreditData();
fetchDebitData();
fetchCustomerData();
fetchStockInAmountData();
function resolveAfter2Seconds() {
    return new Promise(resolve => {
        setTimeout(() => {
            fetchOrderData()
            resolve('resolved');
        }, 2000);
    });
}


/* Controller
------------------------------------------------ */

$(document).ready(function() {
    async function asyncCall() {
        console.log('calling');
        await resolveAfter2Seconds();
    }

    asyncCall();
    document.addEventListener('theme-reload',  function() {
        $('[data-render="apexchart"], #chart-server').empty();
        handleRenderChart();
    });
    let serial = 1;
    fetch(`dashboard/top-products`)
        .then(res => res.json())
        .then(res => {
            $('#topProducts').html(res.map((topProducts) => ` <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="position-relative mb-2">
                                                <div class="position-absolute top-0 start-0">
                                                    <span class="badge bg-theme text-theme-900 rounded-0 d-flex align-items-center justify-content-center w-20px h-20px">${serial++}</span>
                                                </div>
                                            </div>
                                            <div class="flex-1 ps-3">
                                                <div class="mb-1"><small class="fs-9px fw-500 lh-1 d-inline-block rounded-0 badge bg-white bg-opacity-25 text-white text-opacity-75 pt-5px">${topProducts.barcode_number}</small></div>
                                                <div class="fw-500 text-white">${topProducts.title}</div>
                                                BDT ${topProducts.price}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <table class="mb-2 mt-2">
                                            <tr>
                                                <td class="pe-3">TOTAL SOLD:</td>
                                                <td class="text-white text-opacity-75 fw-500">${topProducts.total}</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">REVENUE:</td>
                                                <td class="text-white text-opacity-75 fw-500">${topProducts.total * topProducts.price} BDT</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                    <a href="product/${topProducts.uuid}" class="text-decoration-none text-white"><i class="bi bi-search"></i></a>
                                    </td>
                                </tr>
                        </tbody>` ))

        });

});



