

var ingredientes = document.getElementsByClassName("ingredientes")
const recetaNueva = document.getElementById("recetaNueva")
var arrIngredientes = []
var nombreReceta = ''
var descripcionReceta = ''
for (let i = 0; i < ingredientes.length; i++) {
  const ingrediente = ingredientes[i];
  ingrediente.addEventListener('click', (e)=>{
    if(e.target.id == ('cantidad' + ingrediente.id)){
      
    }else{
      var ingredienteSeleccionado = document.getElementById(ingrediente.id)
      var cantidadingredienteSeleccionado = document.getElementById('cantidad' + ingrediente.id)
      if (arrIngredientes.includes(ingredienteSeleccionado.id)) {
        swal("El ingrediente ya forma parte de la receta.")
      }else{
        var ingredienteCopia = ingredienteSeleccionado
        ingredienteCopia.classList.add("ingredienteAgregado")
        console.log(ingredienteSeleccionado)
        recetaNueva.innerHTML += ingredienteCopia.outerHTML
        var nuevoIngrediente = arrIngredientes.push(ingredienteCopia.id)
       var ingredienteNuevo = document.getElementById('cantidad' + ingrediente.id)
      ingredienteNuevo.focus()
      ingredienteNuevo.addEventListener('blur', ()=>{
        if (ingredienteNuevo.value == '' || ingredienteNuevo.value == 0){
          swal("Debe ingresar la cantidad del ingrediente.")
            .then((value) => {
              ingredienteNuevo.focus();
            });
        }
      })
      }
    }
  })
}

recetaNueva.addEventListener('click', (event)=>{
  console.log(event.target)
  if(event.target.id == "eliminarIngredienteAgregado") {
    console.log("voy a eliminar el ingrediente")
    console.log(event.target.parentNode.parentNode.parentNode)
    event.target.parentNode.parentNode.parentNode.remove()
    console.log(event.target.parentNode.parentNode.parentNode.id)
    var indice = arrIngredientes.indexOf(event.target.parentNode.parentNode.parentNode.id)
    arrIngredientes.splice(indice, 1)
  }
})

var botonGuardarReceta = document.getElementById('btnGuardar')

botonGuardarReceta.addEventListener('click', guardarReceta(), true)

function guardarReceta(){
  nombreReceta = document.getElementById('nombreRecetaNueva').value
  descripcionReceta = document.getElementById('descripcionReceta').value
  var parametros = {
          "arrIngredientesReceta" : arrIngredientes,
          "nombreReceta" : nombreReceta,
          "descripcionReceta" : descripcionReceta
  };
  $.ajax({
          data:  parametros,
          url:   'GuardarReceta.php',
          type:  'post',
          success:  function (response) {
            // alert(response)
                  $("#resultado").html(response);
          }
  });
}


function habilitarInputsCantidades() {
  var inputsCantidades = document.getElementsByName('cantidadIngrediente')
  for (let i = 0; i < inputsCantidades.length; i++) {
    const input = inputsCantidades[i];
    input.classList.remove('hidden')
    
  }
}

function alerta(ingrediente) {
  swal({
    title: "Confirmar",
    text: "Confirma el borrado del ingrediente?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      swal("El ingrediente fue eliminado", {
        icon: "success",
      });
      setTimeout(function(){
        var nombreForm = 'formIngrediente'+ingrediente.id
        var formIngrediente = document.getElementById(nombreForm)
        formIngrediente.submit()
    }, 400)
    }else {
      swal("El ingrediente no se ha sido eliminado");
    }
  });
}
