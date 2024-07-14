const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
//$('#nuevoModal').modal('show');
let tblDevoluciones;

const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));

document.addEventListener("DOMContentLoaded", function () {
 
  tblDevoluciones = $("#tblDevoluciones").DataTable({
    ajax: {
      url: base_url + "devoluciones/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "id_venta" },
      { data: "producto" },
      { data: "usuario" },
      { data: "cantidad" },
      { data: "motivo" },
      { data: "fecha_devolucion" },
      { data: "accion" },
    ],
    responsive: true,
    language,
    dom: "Bfrtip",
    buttons,
    order: [[0, "desc"]],
    
  });

  // Levantar modal para nuevo registro
  nuevo.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    titleModal.textContent = "NUEVA DEVOLUCION";
    btnAccion.textContent = "Registrar";
    frm.reset();
    myModal.show();
  });

  // Submit devoluciones
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "devoluciones/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        let type = res.icono == "success" ? 1 : 2;
        alertas(res.msg.toUpperCase(), type);
        if (res.icono == "success") {
          frm.reset();
          tblDevoluciones.ajax.reload();
          myModal.hide();
        }
      }
    };
  });
});

/*function eliminarDevolucion(idDevolucion) {
  Swal.fire({
    title: "Aviso?",
    text: "Esta seguro de eliminar el registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "devoluciones/delete/" + idDevolucion;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblDevoluciones.ajax.reload();
          }
          let type = res.icono == "success" ? 1 : 2;
          alertas(res.msg.toUpperCase(), type);
        }
      };
    }
  });
}*/

function eliminarDevolucion(idDevolucion) {
  Swal.fire({
      title: "¿Estás seguro?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar",
  }).then((result) => {
      if (result.isConfirmed) {
          fetch(base_url + "devoluciones/delete/" + idDevolucion)
              .then(response => response.json())
              .then(data => {
                  if (data.icono == "success") {
                      tblDevoluciones.ajax.reload();
                  }
                  Swal.fire('Eliminado', data.msg, data.icono);
              })
              .catch(error => console.error('Error:', error));
      }
  });
}



/*function editDevolucion(idDevolucion) {
  const url = base_url + "devoluciones/edit/" + idDevolucion;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Respuesta del servidor: ", this.responseText); // Añade este log
      try {
        const res = JSON.parse(this.responseText);
        document.querySelector("#id").value = res.id;
        document.querySelector("#id_venta").value = res.id_venta;
        document.querySelector("#id_producto").value = res.id_producto;
        document.querySelector("#id_usuario").value = res.id_usuario;
        document.querySelector("#cantidad").value = res.cantidad;
        document.querySelector("#motivo").value = res.motivo;
        document.querySelector("#fecha_devolucion").value = res.fecha_devolucion;
        titleModal.textContent = "Actualizar Devolución";
        btnAccion.textContent = "Actualizar";
        myModal.show();
      } catch (error) {
        console.error("Error al parsear JSON:", error);
      }
    } else if (this.readyState == 4) {
      console.error("Error en la petición: ", this.status);
    }
  };
}*/
function editDevolucion(idDevolucion) {
  console.log("Editando devolución con ID:", idDevolucion);  // Log adicional
  const url = base_url + "devoluciones/edit/" + idDevolucion;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        console.log("Respuesta del servidor: ", this.responseText);
        try {
          const res = JSON.parse(this.responseText);
          document.querySelector("#id").value = res.id;
          document.querySelector("#id_venta").value = res.id_venta;
          document.querySelector("#id_producto").value = res.id_producto;
          document.querySelector("#id_usuario").value = res.id_usuario;
          document.querySelector("#cantidad").value = res.cantidad;
          document.querySelector("#motivo").value = res.motivo;
          document.querySelector("#fecha_devolucion").value = res.fecha_devolucion;
          console.log("Datos cargados en el formulario");  // Log adicional
          titleModal.textContent = "ACTUALIZAR DEVOLUCIÓN";
          btnAccion.textContent = "Actualizar";
          myModal.show();
        } catch (error) {
          console.error("Error al parsear JSON:", error);
        }
      } else {
        console.error("Error en la petición: ", this.status);
      }
    }
  };
}
