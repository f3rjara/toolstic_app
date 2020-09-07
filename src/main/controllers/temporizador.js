//SE ANALIZA LA FECHA DE INGRESO AL SISTEMA
function TemporizadorDesde(min){
    var minu = (90 - parseInt(min))-1;  
    var fechaInicio = new Date();
    fechaInicio.setMinutes(fechaInicio.getMinutes()+minu);
      
  
  
  // Set the date we're counting down to
  var countDownDate = new Date(fechaInicio).getTime();
  
  // Update the count down every 1 second
  var x = setInterval(function() {
  
    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
   
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = ('0' + Math.floor((distance % (1000 * 60)) / 1000)).slice(-2);
    
    if(hours > 0)
    {
        // Output the result in an element with id="TempPrueba"
      document.getElementById("TempPrueba").innerHTML = "0" + hours + " : "
      + minutes + " : " + seconds ;    
        
    }
    else
    {
    // Output the result in an element with id="TempPrueba"
      document.getElementById("TempPrueba").innerHTML = minutes + " : " + seconds ;   
    
        if(minutes <= 10){
        document.getElementById("btn_TempPrueba").classList.add("red");
        }
      
    }
          
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("TempPrueba").innerHTML = "TIEMPO FINALIZADO";
      Stopearquestion();
    }
  }, 1000);
  }
  