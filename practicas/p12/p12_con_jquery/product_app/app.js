// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  "precio": 0.0,
  "unidades": 1,
  "modelo": "XX-000",
  "marca": "NA",
  "detalles": "NA",
  "imagen": "img/default.png"
};

function init() {
  /**
   * Convierte el JSON a string para poder mostrarlo
   * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
   */
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById("description").value = JsonString;
}

$(document).ready(function () {
  console.log("jQuery está funcionando correctamente");

  // Mostrar JSON base
  var JsonString = JSON.stringify(baseJSON, null, 2);
  $("#description").val(JsonString);

  // Cargar lista inicial
  listarProductos();

  // Buscar productos al escribir
  $("#search").keyup(function () {
    let search = $("#search").val();
    if (search === "") {
      listarProductos();
      return;
    }

    $.ajax({
      url: "./backend/product-search.php",
      type: "GET",
      data: { search },
      success: function (response) {
        let productos = JSON.parse(response);
        let template = "";
        let template_bar = "";

        productos.forEach(producto => {
          let descripcion = `
            <li>precio: ${producto.precio}</li>
            <li>unidades: ${producto.unidades}</li>
            <li>modelo: ${producto.modelo}</li>
            <li>marca: ${producto.marca}</li>
            <li>detalles: ${producto.detalles}</li>
          `;
          template += `
            <tr productId="${producto.id}">
              <td>${producto.id}</td>
              <td>${producto.nombre}</td>
              <td><ul>${descripcion}</ul></td>
              <td>
                <button class="product-delete btn btn-danger">Eliminar</button>
              </td>
            </tr>`;
          template_bar += `<li>${producto.nombre}</li>`;
        });

        $("#product-result").removeClass("d-none").addClass("d-block");
        $("#container").html(template_bar);
        $("#products").html(template);
      }
    });
  });

  // Agregar producto
  $("#product-form").submit(function (e) {
    e.preventDefault();
    let producto = JSON.parse($("#description").val());
    producto.nombre = $("#name").val();

    $.ajax({
      url: "./backend/product-add.php",
      type: "POST",
      data: JSON.stringify(producto),
      contentType: "application/json;charset=UTF-8",
      success: function (response) {
        let res = JSON.parse(response);
        let template_bar = `
          <li style="list-style:none;">status: ${res.status}</li>
          <li style="list-style:none;">message: ${res.message}</li>
        `;
        $("#product-result").removeClass("d-none").addClass("d-block");
        $("#container").html(template_bar);
        listarProductos();
      }
    });
  });

  // Eliminar producto
  $(document).on("click", ".product-delete", function () {
    if (confirm("¿De verdad deseas eliminar el Producto?")) {
      let id = $(this).closest("tr").attr("productId");
      $.ajax({
        url: "./backend/product-delete.php",
        type: "GET",
        data: { id },
        success: function (response) {
          let res = JSON.parse(response);
          let template_bar = `
            <li style="list-style:none;">status: ${res.status}</li>
            <li style="list-style:none;">message: ${res.message}</li>
          `;
          $("#product-result").removeClass("d-none").addClass("d-block");
          $("#container").html(template_bar);
          listarProductos();
        }
      });
    }
  });

  // Función para listar productos
  function listarProductos() {
    $.ajax({
      url: "./backend/product-list.php",
      type: "GET",
      success: function (response) {
        let productos = JSON.parse(response);
        let template = "";
        productos.forEach(producto => {
          let descripcion = `
            <li>precio: ${producto.precio}</li>
            <li>unidades: ${producto.unidades}</li>
            <li>modelo: ${producto.modelo}</li>
            <li>marca: ${producto.marca}</li>
            <li>detalles: ${producto.detalles}</li>
          `;
          template += `
            <tr productId="${producto.id}">
              <td>${producto.id}</td>
              <td>${producto.nombre}</td>
              <td><ul>${descripcion}</ul></td>
              <td>
                <button class="product-delete btn btn-danger">Eliminar</button>
              </td>
            </tr>`;
        });
        $("#products").html(template);
      }
    });
  }
});
