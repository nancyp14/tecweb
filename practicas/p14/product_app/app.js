$(document).ready(function(){

    let edit = false;

    $('#product-result').hide();
    listarProductos();

    // ---- VALIDACIONES ----
    function validarCampo(id, regla) {
        let valor = $(`#${id}`).val().trim();
        let valido = true;
        let mensaje = "";

        if (regla.required && valor === "") {
            valido = false;
            mensaje = "Este campo es requerido";
        }

        if (regla.number && isNaN(valor)) {
            valido = false;
            mensaje = "Debe ser número válido";
        }

        if (regla.min !== undefined && valor < regla.min) {
            valido = false;
            mensaje = `Debe ser mayor o igual a ${regla.min}`;
        }

        mostrarEstado(`${id}-estado`, mensaje, valido);
        return valido;
    }

    function mostrarEstado(id, mensaje, valido) {
        let barra = $(`#${id}`);
        barra.removeClass('text-success text-danger');

        if (valido) {
            barra.text("Correcto");
            barra.addClass('text-success');
        } else {
            barra.text(" " + mensaje);
            barra.addClass('text-danger');
        }
    }

    // ---- VALIDACIÓN NOMBRE ASÍNCRONA ----
    $('#name').keyup(function(){
        let nombre = $('#name').val().trim();
        if(nombre.length === 0) return;

        $.ajax({
            url: './backend/product-search.php?search=' + nombre,
            type: 'GET',
            success: function(response){
                const data = JSON.parse(response);
                if(data.length > 0){
                    mostrarEstado("name-estado", "Nombre ya existe", false);
                } else {
                    mostrarEstado("name-estado", "", true);
                }
            }
        });
    });

    // ---- VALIDACIÓN AL SALIR DE CADA CAMPO ----
    $('#precio').blur(()=> validarCampo("precio", {required:true, number:true, min:0}));
    $('#unidades').blur(()=> validarCampo("unidades", {required:true, number:true, min:1}));
    $('#modelo').blur(()=> validarCampo("modelo", {required:true}));
    $('#marca').blur(()=> validarCampo("marca", {required:true}));
    $('#detalles').blur(()=> validarCampo("detalles", {required:true}));
    $('#imagen').blur(()=> validarCampo("imagen", {required:true}));

    // ---- CARGAR PRODUCTOS ----
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                let template = '';

                productos.forEach(producto => {
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item">${producto.nombre}</a></td>
                            <td>${producto.modelo} / ${producto.marca}</td>
                            <td>
                            <button class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#products').html(template);
            }
        });
    }

    // ---- GUARDAR O EDITAR ----
    $('#product-form').submit(e => {
        e.preventDefault();

        // Validación antes de enviar
        if(!( validarCampo("precio",{required:true,number:true,min:0}) &&
              validarCampo("unidades",{required:true,number:true,min:1}) &&
              validarCampo("modelo",{required:true}) &&
              validarCampo("marca",{required:true}) &&
              validarCampo("detalles",{required:true}) &&
              validarCampo("imagen",{required:true}) ))
        {
            $('#product-result').show();
            $('#container').html("<li class='text-danger'>Hay campos inválidos</li>");
            return;
        }

        const postData = {
            nombre: $('#name').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val(),
            id: $('#productId').val()
        };

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

        $.post(url, postData, (response) => {
            $('#product-result').show();
            $('#container').html(`<li>${response}</li>`);
            $('#product-form').trigger('reset');
            $('.estado').text("");
            listarProductos();
            edit = false;

            // regresar texto botón
            $('button.btn-primary').text("Agregar Producto");
        });
    });

    // ---- CARGAR PRODUCTO EN FORMULARIO ----
    $(document).on('click', '.product-item', function(e){
        e.preventDefault();
        const id = $(this).closest('tr').attr('productId');

        $.post('./backend/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);

            $('#name').val(product.nombre);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            $('#productId').val(product.id);

            edit = true;

            // cambiar texto botón
            $('button.btn-primary').text("Modificar Producto");
        });
    });

    // ---- ELIMINAR PRODUCTO ----
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        let id = $(this).closest('tr').attr('productId');
        
        if(confirm("¿Seguro que deseas eliminar este producto?")) {
            $.post('./backend/product-delete.php', {id}, function(response) {
                $('#product-result').show();
                $('#container').html(`<li>${response}</li>`);
                listarProductos();
            });
        }
    });
});
