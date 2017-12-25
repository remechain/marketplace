$(document).ready(function(){
//  Переменные
    var 
    //  Переменные __ Высота блока с графиком и заголовком 
        chart_height = $('.chart').height(),
    //  Переменные __ Ширина блока с графиком и заголовком 
        chart_width = $('.chart').width(),
    //  Переменные __ Высота заголовка блока с графиком 
        chart__title_height = $('.chart__title').height(),
    //  Переменные __ Высота заголовка блока с графиком 
        chart__main_height = chart_height - chart__title_height,
    //  Переменные __ Графики из таблицы 
        tc1 = document.getElementById("chart__table-1"),
        tc2 = document.getElementById("chart__table-2"),
        tc3 = document.getElementById("chart__table-3"),
        tc4 = document.getElementById("chart__table-4"),
        tc5 = document.getElementById("chart__table-5");

// Высота и ширина для графика перед таблицей
    $('#chart__main').attr('height', chart__main_height);
    $('#chart__main').attr('width', chart_width);

// График перед таблицей
    var ctx = document.getElementById("chart__main");
    var myChart = new Chart(ctx, {
        type: 'line',
        multiTooltipTemplate: "<%= value %>",
        data: {
            labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
            datasets: [{
                data: [31,11,23,5,64,15,11],
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'rgba(255, 255, 255, 1)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                display:false,
                }],
                xAxes: [{
                    gridLines:{
                    display:false,
                    },
                    ticks: {
                    fontColor: 'rgba(255,255,255,1)',
                    },
                }]
            },
            legend: {
            display: false,
            },
            tooltips: {
            
            backgroundColor: 'rgba(255,255,255,0)',
            }
        }
        
    });

// Графики в таблице

    // Графики в таблице __ таблица 1
        var tc_1 = new Chart(tc1, {
            type: 'line',
            data: {
                labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
                datasets: [{
                    data: [31,11,23,5,64,15,11],
                    backgroundColor: 'rgba(242, 109, 93, .1)',
                    borderColor: '#f26d5d',
                    borderWidth: 1,
                    radius: 0,
                }]
            },
            options: {
                
                responsive: true,
                scales: {
                    yAxes: [{
                        display:false,
                    }],
                    xAxes: [{
                        display:false,
                    }]
                },
                legend: {
                    display: false,
                    padding:0,
                },
                tooltips: {
                    enabled: false,
                }
            }
        });
    
    // Графики в таблице __ таблица 2
        var tc_2 = new Chart(tc2, {
            type: 'line',
            data: {
                labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
                datasets: [{
                    data: [11,31,3,35,24,25,51],
                    backgroundColor: 'rgba(242, 109, 93, .1)',
                    borderColor: '#f26d5d',
                    borderWidth: 1,
                    radius: 0,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                    display:false,
                    }],
                    xAxes: [{
                    display:false,
                    }]
                },
                legend: {
                display: false,
                },
                tooltips: {
                enabled: false,
                }
            }
        });

    // Графики в таблице __ таблица 3
        var tc_3 = new Chart(tc3, {
            type: 'line',
            data: {
                labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
                datasets: [{
                    data: [31,11,23,5,64,15,11],
                    backgroundColor: 'rgba(242, 109, 93, .1)',
                    borderColor: '#f26d5d',
                    borderWidth: 1,
                    radius: 0,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                    display:false,
                    }],
                    xAxes: [{
                    display:false,
                    }]
                },
                legend: {
                display: false,
                },
                tooltips: {
                enabled: false,
                }
            }
        });

    // Графики в таблице __ таблица 4
        var tc_4 = new Chart(tc4, {
            type: 'line',
            data: {
                labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
                datasets: [{
                    data: [11,31,3,35,24,25,51],
                    backgroundColor: 'rgba(242, 109, 93, .1)',
                    borderColor: '#f26d5d',
                    borderWidth: 1,
                    radius: 0,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                    display:false,
                    }],
                    xAxes: [{
                    display:false,
                    }]
                },
                legend: {
                display: false,
                },
                tooltips: {
                enabled: false,
                }
            }
        });

    // Графики в таблице __ таблица 5
        var tc_5 = new Chart(tc5, {
            type: 'line',
            data: {
                labels: ['01.05', '02.05',' 03.05', '04.05', '05.05',' 06.05', '07.05'],
                datasets: [{
                    data: [31,11,23,5,64,15,11],
                    backgroundColor: 'rgba(242, 109, 93, .1)',
                    borderColor: '#f26d5d',
                    borderWidth: 1,
                    radius: 0,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                    display:false,
                    }],
                    xAxes: [{
                    display:false,
                    }]
                },
                legend: {
                display: false,
                },
                tooltips: {
                enabled: false,
                }
            }
        });
});


// new Chartist.Line('.ct-main-chart', {
//   labels: [30.05, 31.05, 1.06, 2.06, 3.06, 4.06, 5.06, 6.06],
//   series: [
//     [5, 9, 7, 8, 5, 3, 5, 4]
//   ]
// }, 
// {
//   axisY: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     // and also don't show the label
//     showLabel: false,
//     offset: -5,
//   },
//   axisX: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     labelOffset: {
//       x: 5,
//       y: 70
//     }
//   },
//   showArea: true
// });

// new Chartist.Line('.ct-table-chart-1', {
//   labels: [30.05, 31.05, 1.06, 2.06, 3.06, 4.06, 5.06, 6.06],
//   series: [
//     [5, 9, 7, 8, 5, 3, 5, 4]
//   ]
// }, 
// {
//   axisY: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     // and also don't show the label
//     showLabel: false,
//     offset: -5,
//   },
//   axisX: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     showLabel: false
//   },
//   showArea: true,
//   width: '200px'
// });

// new Chartist.Line('.ct-table-chart-2', {
//   labels: [30.05, 31.05, 1.06, 2.06, 3.06, 4.06, 5.06, 6.06],
//   series: [
//     [1, 9, 14, 5, 3, 1, 3, 4]
//   ]
// }, 
// {
//   axisY: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     // and also don't show the label
//     showLabel: false,
//     offset: -5,
//   },
//   axisX: {
//     // We can disable the grid for this axis
//     showGrid: false,
//     showLabel: false
//   },
//   showArea: true,
//   width: '200px'
// });