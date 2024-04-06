function validarEmpleados() {
    
  let campos = ['diputado', 'fecha', 'nombreSolicitante', 'institucion', 'municipio', 'responsableGrupo', 'correoElectronico', 'telefonoExt', 'tipoParticipantes', 'fechaHora', 'observaciones', 'carrera', 'semestre', 'discapacidad', 'numParticipantes'];

  let isValid = true;

  campos.forEach(function(campo) {
 
    let input = document.getElementById(campo);
  
    if (!input.value) {
     
      input.classList.add('is-invalid');
      isValid = false;
    } else {

      input.classList.remove('is-invalid');
    }

   
    if (campo === 'correoElectronico') {
      let regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }


    if (campo === 'telefonoExt') {
      let regex = /^\d{10}$/;
      if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }

    if (campo === 'numParticipantes') {
      let regex = /^\d+$/;
      if (!regex.test(input.value) || Number(input.value) < 1) {
        input.classList.add('is-invalid');
        isValid = false;
      }
    }
  
  });
 
    return isValid;
  
}