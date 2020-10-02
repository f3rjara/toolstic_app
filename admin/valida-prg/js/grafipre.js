function myFunction(x) {
    if (x.matches) { // If media query matches
      var dataPos = 'horizontalBar';
    } else {
      var dataPos = 'bar';
    }
    return dataPos;
  }

var x = window.matchMedia("(max-width: 700px)")
var datatype = myFunction(x);

window.onresize = function(){
    anchoVentana = window.innerWidth;
    console.log(anchoVentana);
    if(anchoVentana <= 700){
        datatype = "bar"
     }  
     else{
        chart.update();
        datatype = "horizontalBar";
     } 
};

function FirstGrafic(tpt,tpv,tpsv,tpna){   
    var ctx = document.getElementById('GrafPreTotales');
    var myChart = new Chart(ctx, {
        type: datatype,  
        responsive: true, 
        data: {
            labels: ['Total preguntas', 'Pre. Validadas', 'Pre. Sin validar', 'Pre. No aceptadas'],
            datasets: [{
                label: 'No. preguntas',            
                data: [tpt, tpv, tpsv, tpna],
                backgroundColor: [       
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(1, 145, 64, 0.5)', 
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    
                ],
                borderColor: [                            
                    'rgba(54, 162, 235, 1)',
                    'rgba(1, 145, 64, 1)',    
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',              
                ],
                borderWidth: 2
            }]
        },
        options: { 
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: (tpt+10),
                        fontFamily: 'Comfortaa'
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "black",
                        fontFamily: 'Comfortaa',  
                        fontSize: 11,          
                        suggestedMax: (tpt+10),            
                        beginAtZero: true
                    }
                }]
            },      
            title: {
                display: true,
                text: 'Total preguntas registradas en ToolsTIC',
                fontSize: 16,
                fontFamily: 'Comfortaa'
            }, 
            legend: {
                display: false,            
            },
            plugins: {
                datalabels: {
                    align: function(context) {
                        var index = context.dataIndex;
                      var value = context.dataset.data[index];
                      var invert = Math.abs(value) <= 1;
                      return value < 1 ? 'end' : 'start'
                    },
                    anchor: 'end',
                    backgroundColor: null,
                    borderColor: null,
                    borderRadius: 4,
                    borderWidth: 1,
                    color: '#223388',
                    font: {
                      size: 11,
                      weight: 600,
                      family:'Comfortaa'
                    },
                    offset: -13,
                    padding: -7,
                    formatter: function(value) {
                        return Math.round(value * 10) / 10
                    }
                  }
              }
            
        }      
    });
}

function MyPreGrafic(tpt,tpv,tpsv,tpna){   
    var ctx = document.getElementById('GrafMisPre');
    var myChart = new Chart(ctx, {
        type: datatype,    
        data: {
            labels: ['Total preguntas', 'Pre. Validadas', 'Pre. Sin validar', 'Pre. No aceptadas'],
            datasets: [{
                label: 'No. preguntas',            
                data: [tpt, tpv, tpsv, tpna],
                backgroundColor: [       
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(1, 145, 64, 0.5)', 
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    
                ],
                borderColor: [                            
                    'rgba(54, 162, 235, 1)',
                    'rgba(1, 145, 64, 1)',    
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',              
                ],
                borderWidth: 2
            }]
        },
        options: {
            legend: {
                display: false  
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: (tpt+10),
                        fontFamily: 'Comfortaa'
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "black",
                        fontFamily: 'Comfortaa',  
                        fontSize: 11,      
                        suggestedMax: (tpt+10),                
                        beginAtZero: true
                    }
                }]
            },      
            title: {
                display: true,
                text: 'Total preguntas creadas por mi',
                fontSize: 16,
                fontFamily: 'Comfortaa'
            }, 
            legend: {
                display: false,            
            },
            plugins: {
                datalabels: {
                  align: function(context) {
                      var index = context.dataIndex;
                    var value = context.dataset.data[index];
                    var invert = Math.abs(value) <= 1;
                    return value < 1 ? 'end' : 'start'
                  },
                  anchor: 'end',
                  backgroundColor: null,
                  borderColor: null,
                  borderRadius: 4,
                  borderWidth: 1,
                  color: '#223388',
                  font: {
                    size: 11,
                    weight: 600,
                    family:'Comfortaa'
                  },
                  offset: -13,
                  padding: -7,
                  formatter: function(value) {
                      return Math.round(value * 10) / 10
                  }
                }
              }
        }
    });
}
