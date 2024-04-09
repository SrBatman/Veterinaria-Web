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


function validarClientes() {
    
    
  let campos = ['nombre', 'apellidoP', 'apellidoM', 'direccion', 'colonia', 'zp', 'correo', 'tel_cel', 'tel_casa'];

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


    if (campo === 'tel_cel') {
      let regex = /^\d{10}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }

    if (campo === 'tel_casa') {
      let regex = /^\d{10}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }
  
  });
 
    return isValid;
  
};

function validarServicios() {
    
  let campos = ['servicio', 'precio'];

  let isValid = true;

  campos.forEach(function(campo) {
 
    let input = document.getElementById(campo);
  
    if (!input.value) {
     
      input.classList.add('is-invalid');
      isValid = false;
    } else {

      input.classList.remove('is-invalid');
    }

  
  });
 
    return isValid;
  
};

function mostrarModal(){
  $('#modalAddEmployee').modal('show');
};


function mostrarModalCliente(){
  $('#modalAddClient').modal('show');
};


function mostrarModalService(){
  $('#modalAddService').modal('show');
};

function mostrarModalDiscount(){
  $('#modalAddDiscount').modal('show');
};