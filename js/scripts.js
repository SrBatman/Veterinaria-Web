function validarEmpleados() {
    
    
  let campos = ['nombre', 'apellidoP', 'apellidoM', 'direccion', 'colonia', 'zp', 'correo', 'telefono', 'puesto'];

  let isValid = true;

  campos.forEach(function(campo) {
 
    let input = document.getElementById(campo);
  
    if (!input.value) {
     
      input.classList.add('is-invalid');
      isValid = false;
    } else {

      input.classList.remove('is-invalid');
    }

   
    if (campo === 'correo') {
      let regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }


    if (campo === 'telefono') {
      let regex = /^\d{10}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }
  
  });
 
    return isValid;
  
};

function mostrarModal(){
  $('#modalAddEmployee').modal('show');
}