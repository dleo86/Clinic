
  function mostrarSeleccionado1()
  {
     var x = document.querySelector(".widget");
     var img = document.querySelector('.imagen24');
     if (x.style.display === "none") {
        x.style.display = "block";
        img.style.transform = 'rotate(270deg)';
     } else {
        x.style.display = "none";
        img.style.transform = 'rotate(90deg)';
     }
  }
