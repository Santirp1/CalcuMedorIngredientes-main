//Ingredientes

//------------------------------NUEVO--------------------------------------------
var botonNuevo = document.getElementById("nuevoIngrediente")

botonNuevo.addEventListener('click', function () {
  agregarCardIngrediente()
})

function agregarCardIngrediente() {
  var formNuevoIngrediente = document.getElementById('formNuevoIngrediente')
formNuevoIngrediente.classList.remove('hidden')

  
}
//--------------------------------------------------------------------------------

//------------------------------EDITAR--------------------------------------------
var botonesEditar = document.getElementsByClassName('btnEditar')

for (let i = 0; i < botonesEditar.length; i++) {
  const boton = botonesEditar[i];
  boton.addEventListener('click', function () {
    HabilitarControl(this)
  })
}

function HabilitarControl(boton) {
  var idInput = boton.id
  HabilitarNombre(idInput)
  HabilitarCantidad(idInput)
  HabilitarPrecio(idInput)
}

function HabilitarNombre(id) {
  var inputNombre = document.getElementById(id)
  inputNombre.disabled = false
}

function HabilitarCantidad(id) {
  var inputCantidad = document.getElementById('cantidad' + id)
  inputCantidad.disabled = false
}

function HabilitarPrecio(id) {
  var inputPrecio = document.getElementById('precio' + id)
  inputPrecio.disabled = false
}
//--------------------------------------------------------------------------------

//------------------------------ELIMINAR------------------------------------------
var eliminarIngrediente = document.getElementsByClassName('eliminarIngrediente')

for (let i = 0; i < eliminarIngrediente.length; i++) {
  const ingrediente = eliminarIngrediente[i];
  ingrediente.addEventListener('click', () => {
    eliminar(ingrediente)
    alerta(ingrediente)
  }) 
}
function eliminar(ingrediente) {
  var divEliminar = document.getElementById('eliminar'+ingrediente.id)
  divEliminar.innerHTML = '<input type="hidden" value='+ingrediente.id+' name="eliminar">'
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
//--------------------------------------------------------------------------------

//------------------------IMAGEN A NUEVO INGREDIENTE------------------------------

var imagenNueva = document.getElementById('iconoNuevo')

imagenNueva.addEventListener('click', () => {
  var listaIconos = document.getElementById('listaIconos')
  ocultarMostrarLista()
})

var iconosLista = document.getElementsByClassName('iconoLista')

for (let i = 0; i < iconosLista.length; i++) {
  const icono = iconosLista[i];
  icono.addEventListener('click', ()=>{
    var iconoSeleccionado = document.getElementById('iconoSeleccionado')
    var iconoNuevo = document.getElementById('iconoNuevo')
    var inputIcono = document.getElementById('inputIcono')
    iconoSeleccionado.src = icono.src
    iconoSeleccionado.value = icono.name
    inputIcono.value = icono.name
    iconoNuevo.classList.add('hidden')
    iconoSeleccionado.classList.remove('hidden')
    ocultarMostrarLista()
  })
}

iconoSeleccionado.addEventListener('click', () => {
  ocultarMostrarLista()
})

function ocultarMostrarLista(){
  if (listaIconos.classList.contains('hidden')) {
    listaIconos.classList.remove('hidden')
  }else{
    listaIconos.classList.add('hidden')
  }
}

//--------------------------------------------------------------------------------

