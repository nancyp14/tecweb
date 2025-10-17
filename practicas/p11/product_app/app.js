// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar por ID"
function buscarID(e) {
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
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

// NUEVA FUNCIÓN: "Buscar Producto" (por nombre, marca o detalles)
function buscarProducto(e) {
    e.preventDefault();
    var criterio = document.getElementById('search').value;

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            
            // SE OBTIENE UN ARREGLO DE PRODUCTOS
            let productos = JSON.parse(client.responseText);
            let template = '';

            // SE VERIFICA SI HAY RESULTADOS
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

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;
    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

// INICIALIZACIÓN
function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}