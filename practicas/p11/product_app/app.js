// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIONES DE VALIDACIÓN
function validarProducto(producto) {
    const { nombre, marca, modelo, precio, unidades, detalles, imagen } = producto;
    const errores = [];

    // a) Nombre: requerido y ≤ 100 caracteres
    if (!nombre || nombre.trim() === "" || nombre.length > 100) {
        errores.push("El nombre es requerido y debe tener 100 caracteres o menos.");
    }

    // b) Marca: requerida
    if (!marca || marca.trim() === "") {
        errores.push("Debes seleccionar una marca.");
    }

    // c) Modelo: requerido, alfanumérico y ≤ 25 caracteres
    const regexModelo = /^[a-zA-Z0-9]+$/;
    if (!modelo || !regexModelo.test(modelo) || modelo.length > 25) {
        errores.push("El modelo debe ser alfanumérico y tener 25 caracteres o menos.");
    }

    // d) Precio: requerido y > 99.99
    if (isNaN(precio) || Number(precio) <= 99.99) {
        errores.push("El precio debe ser mayor a 99.99.");
    }

    // e) Detalles: opcional, ≤ 250 caracteres
    if (detalles && detalles.length > 250) {
        errores.push("Los detalles deben tener 250 caracteres o menos.");
    }

    // f) Unidades: requerido y ≥ 0
    if (isNaN(unidades) || Number(unidades) < 0) {
        errores.push("Las unidades deben ser un número mayor o igual a 0.");
    }

    // g) Imagen: opcional, si no se da usar por defecto
    let imagenFinal = imagen && imagen.trim() !== "" ? imagen : "img/default.png";

    return {
        valido: errores.length === 0,
        errores,
        imagen: imagenFinal
    };
}

// FUNCIONES EXISTENTES
function buscarID(e) {
    e.preventDefault();
    var id = document.getElementById('search').value;
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            let productos = JSON.parse(client.responseText);
            if (Object.keys(productos).length > 0) {
                let descripcion = '';
                descripcion += '<li>precio: ' + productos.precio + '</li>';
                descripcion += '<li>unidades: ' + productos.unidades + '</li>';
                descripcion += '<li>modelo: ' + productos.modelo + '</li>';
                descripcion += '<li>marca: ' + productos.marca + '</li>';
                descripcion += '<li>detalles: ' + productos.detalles + '</li>';

                let template = `
                    <tr>
                        <td>${productos.id}</td>
                        <td>${productos.nombre}</td>
                        <td><ul>${descripcion}</ul></td>
                    </tr>
                `;
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id=" + id);
}

function buscarProducto(e) {
    e.preventDefault();
    var criterio = document.getElementById('search').value;
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            let productos = JSON.parse(client.responseText);
            let template = '';
            if (productos.length > 0) {
                productos.forEach(prod => {
                    let descripcion = `
                        <li>precio: ${prod.precio}</li>
                        <li>unidades: ${prod.unidades}</li>
                        <li>modelo: ${prod.modelo}</li>
                        <li>marca: ${prod.marca}</li>
                        <li>detalles: ${prod.detalles}</li>
                    `;
                    template += `
                        <tr>
                            <td>${prod.id}</td>
                            <td>${prod.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
            } else {
                template = `<tr><td colspan="3">No se encontraron productos.</td></tr>`;
            }
            document.getElementById("productos").innerHTML = template;
        }
    };
    client.send("id=" + criterio);
}

// AGREGAR PRODUCTO CON VALIDACIÓN
function agregarProducto(e) {
    e.preventDefault();

    try {
        var productoJsonString = document.getElementById('description').value;
        var producto = JSON.parse(productoJsonString);

        // Añadimos nombre desde input
        producto.nombre = document.getElementById('name').value;

        // Validación completa
        const resultadoValidacion = validarProducto(producto);
        if (!resultadoValidacion.valido) {
            alert(resultadoValidacion.errores.join("\n"));
            return;
        }

        // Actualizar imagen si estaba vacía
        producto.imagen = resultadoValidacion.imagen;

        // Enviar al backend
        var client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
        client.onreadystatechange = function () {
            if (client.readyState == 4 && client.status == 200) {
                alert(client.responseText);
            }
        };
        client.send(JSON.stringify(producto, null, 2));

    } catch (err) {
        alert('JSON inválido: ' + err.message);
    }
}

// OBJETO AJAX
function getXMLHttpRequest() {
    var objetoAjax;
    try { objetoAjax = new XMLHttpRequest(); }
    catch (err1) {
        try { objetoAjax = new ActiveXObject("Msxml2.XMLHTTP"); }
        catch (err2) {
            try { objetoAjax = new ActiveXObject("Microsoft.XMLHTTP"); }
            catch (err3) { objetoAjax = false; }
        }
    }
    return objetoAjax;
}

// INICIALIZACIÓN
function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}