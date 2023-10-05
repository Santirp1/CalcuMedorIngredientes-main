//prueba id receta

function cambiarReceta(){
  var receta = document.getElementById('recetas')
  var id = receta[receta.selectedIndex].id;
  console.log(id)
  var parametros = {
          "idReceta" : id
  };
  $.ajax({
          data:  parametros,
          url:   'RecuperarReceta.php',
          type:  'post',
          success:  function (response) {
                  $("#resultado").html(response);
          }
  });
}

function Calcular() {
        var totalesPorIngrediente = document.getElementsByClassName('totalIngrediente')
        var intCantidadComensales = document.getElementById("intCantidadComensales")
        for (let i = 0; i < totalesPorIngrediente.length; i++) {
                const total = totalesPorIngrediente[i];
                var cantidadIngrediente = document.getElementById('intCantidad'+total.id)
                console.log(cantidadIngrediente.textContent)
                total.textContent = (parseInt(intCantidadComensales.value) * parseFloat(cantidadIngrediente.textContent)).toFixed(2)
        }
}


function LlamarAlerta(numeroMensaje) {
        var mensaje = ''
        switch (numeroMensaje) {
                case 1:
                        mensaje = 'No se encontro la receta solicitada. Verificar.'
                        break;
                case 2:
                        mensaje = 'Probando mensaje 2'
                        break;
        }
        swal(mensaje);
}
