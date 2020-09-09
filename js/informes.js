
  function mostrarSeleccionado()
  {
var e = document.getElementById("valor");
var value = e.options[e.selectedIndex].value;
    if (e.options[e.selectedIndex].value == "valor1")//(document.querySelector('#valor1').checked)
    {
      alert('Ejemplo de prueba');
      window.open("vista/mostrar_informe1.php");//?date1=<?php echo $fecha1; ?>date2=<?php echo $fecha2; ?>
    }
    if (document.querySelector('#valor2').checked)
    {
      //alert('tienes estudios primarios');
      window.open("vista/mostrar_informe2.php");
    }
     if (document.querySelector('#valor3').checked)
    {
      //alert('Ejemplo de prueba');
      window.open("vista/mostrar_informe3.php");
    }
     if (document.querySelector('#valor4').checked)
    {
      //alert('Ejemplo de prueba 2');
      window.open("vista/mostrar_informe4.php");
    }
     if (document.querySelector('#valor5').checked)
    {
      //alert('Ejemplo de prueba 5');
      window.open("vista/mostrar_informe5.php");
    }
  }
