function GrafiPregunDocExperto(id_docente){

    console.log(id_docente);
    //CONSULTA DATOS POR AJAX

    $.ajax({
        type: "POST",
        data: {
            id_docente: id_docente           
        },        
        url: "php/gra_preval.php",       
        success: function(res){  
            var data = jQuery.parseJSON(res); 
            console.log(data) ;

            
            var pre_asig = data[0]['TotalPre'];
            var pre_vali = data[0]['TotalPreVyA'];
            var pre_poco = data[0]['TotalPrePC'];
            var pre_sinva = data[0]['TotalPreSV'];
            var pre_noace = data[0]['TotalPreNoAc'];
            var lineoffset = 0;
            if(pre_vali <= 10)
            {
                lineoffset = 0;
            }
            else{
                lineoffset = -25;
            }
            //GRAFICAR CON CHART JS
            var ctx = document.getElementById('Graf-PreVali');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                responsive: true, 
                data: {
                    labels: ['T. Preguntas asignadas', 'Pre. Validadas', 'Pre. Validas por corregir', 'Pre. Sin validar', 'Pre. No aceptadas'],
                    datasets: [{
                        label: 'No. preguntas',            
                        data: [pre_asig, pre_vali, pre_poco, pre_sinva, pre_noace],
                        backgroundColor: [       
                            'rgba(14, 25, 58, 0.5)',
                            'rgba(1, 145, 64, 0.5)', 
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            
                        ],
                        borderColor: [  
                            'rgba(14, 25, 58, 1)', 
                            'rgba(1, 145, 64, 1)',  
                            'rgba(54, 162, 235, 1)',  
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
                                suggestedMax: (pre_asig+5),
                                fontFamily: 'Comfortaa'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "black",
                                suggestedMax: (pre_asig+4),
                                fontFamily: 'Comfortaa',                        
                                beginAtZero: true
                            }
                        }]
                    },      
                    title: {
                        display: true,
                        text: 'Total de mis  preguntas asignadas',
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
                            var invert = Math.abs(value) <= 5;
                            return value < 1 ? 'end' : 'start'
                        },
                        anchor: 'end',
                        backgroundColor: 'white',
                        borderColor: null,
                        borderRadius: 4,
                        borderWidth: 1,
                        color: 'black',
                        display: true,
                        font: {
                            size: 11,
                            weight: 800,
                            family:'Comfortaa'
                        },                  
                        offset: lineoffset,
                        formatter: function(value) {
                            return Math.round(value * 10) / 10
                        }
                        }
                    }
                    
                }      
            });
            //FIN GRAFICAR CON CHART JS


            if(!data[0]['bandera']){              
              return false;            
            }                 
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP

    


    
    



}