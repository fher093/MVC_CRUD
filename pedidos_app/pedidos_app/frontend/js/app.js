// Servicios REST (el frontend vive en /frontend y la API en /api)
const API = '../api/';
let productos = [];

function esc(t) {
    return $('<div>').text(t == null ? '' : t).html();
}

function mostrarMensaje(texto, tipo) {
    $('#mensaje').removeClass('oculto ok error').addClass(tipo).text(texto);
    setTimeout(function () { $('#mensaje').addClass('oculto'); }, 4000);
}

function errorAjax(xhr) {
    const msg = xhr.responseJSON && xhr.responseJSON.mensaje
        ? xhr.responseJSON.mensaje : 'No se pudo comunicar con el servidor';
    mostrarMensaje(msg, 'error');
}

/* ---------- Navegación ---------- */
$('.tab').on('click', function (e) {
    e.preventDefault();
    $('.tab').removeClass('activo');
    $(this).addClass('activo');
    $('.seccion').addClass('oculto');
    $('#' + $(this).data('seccion')).removeClass('oculto');
});

/* ---------- Cargas iniciales ---------- */
function cargarClientesSelect() {
    $.getJSON(API + 'clientes.php', function (r) {
        let opts = '';
        r.datos.forEach(function (c) {
            opts += '<option value="' + c.id + '">' + esc(c.apellido + ' ' + c.nombre) + '</option>';
        });
        $('#selCliente, #selClienteHistorial').html(opts);
        cargarHistorial();
    }).fail(errorAjax);
}

function cargarProductosSelect() {
    $.getJSON(API + 'productos.php', function (r) {
        productos = r.datos;
        let opts = '';
        productos.forEach(function (p) {
            opts += '<option value="' + p.id + '">' + esc(p.nombre) + '</option>';
        });
        $('#selProducto').html(opts);
        calcularTotal();
    }).fail(errorAjax);
}

function calcularTotal() {
    const id = $('#selProducto').val();
    const cant = parseInt($('#cantidad').val(), 10) || 0;
    const p = productos.find(function (x) { return x.id == id; });
    $('#totalPedido').text(p && cant > 0 ? (p.precio * cant).toFixed(2) : '0.00');
}
$('#selProducto, #cantidad').on('change input', calcularTotal);

/* ---------- 1. Registrar pedido ---------- */
$('#btnRegistrar').on('click', function () {
    const datos = {
        cliente_id: $('#selCliente').val(),
        producto_id: $('#selProducto').val(),
        cantidad: $('#cantidad').val()
    };
    if (!datos.cliente_id || !datos.producto_id || parseInt(datos.cantidad, 10) < 1) {
        mostrarMensaje('Complete todos los campos correctamente', 'error');
        return;
    }
    $.ajax({
        url: API + 'pedidos.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(datos),
        dataType: 'json',
        success: function (r) {
            mostrarMensaje(r.mensaje + ' (N° ' + r.datos.id + ')', 'ok');
            $('#cantidad').val(1);
            calcularTotal();
            cargarHistorial();
        },
        error: errorAjax
    });
});

/* ---------- 2. Clientes ---------- */
function pintarClientes(lista) {
    let html = '';
    lista.forEach(function (c) {
        html += '<tr><td>' + esc(c.cedula) + '</td><td>' + esc(c.apellido + ' ' + c.nombre) +
                '</td><td>' + esc(c.telefono) + '</td><td>' + esc(c.direccion) + '</td></tr>';
    });
    $('#tbClientes').html(html || '<tr><td colspan="4">Sin resultados</td></tr>');
}

function listarClientes() {
    $.getJSON(API + 'clientes.php', function (r) { pintarClientes(r.datos); }).fail(errorAjax);
}

$('#btnTodos').on('click', function () { $('#txtCedula').val(''); listarClientes(); });

$('#btnBuscar').on('click', function () {
    const cedula = $('#txtCedula').val().trim();
    if (cedula === '') { listarClientes(); return; }
    $.getJSON(API + 'clientes.php', { cedula: cedula }, function (r) {
        pintarClientes(r.datos);
    }).fail(function (xhr) { pintarClientes([]); errorAjax(xhr); });
});

/* ---------- 3. Pedidos por cliente ---------- */
function cargarHistorial() {
    const id = $('#selClienteHistorial').val();
    if (!id) return;
    $.getJSON(API + 'pedidos.php', { cliente_id: id }, function (r) {
        let html = '';
        r.datos.forEach(function (p) {
            html += '<tr><td>' + p.id + '</td><td>' + esc(p.producto) + '</td><td>$' +
                    parseFloat(p.precio).toFixed(2) + '</td><td>' + p.cantidad + '</td><td>$' +
                    parseFloat(p.total).toFixed(2) + '</td><td>' + esc(p.fecha) + '</td></tr>';
        });
        $('#tbPedidos').html(html || '<tr><td colspan="6">Este cliente no tiene pedidos</td></tr>');
    }).fail(errorAjax);
}
$('#selClienteHistorial').on('change', cargarHistorial);

/* ---------- Inicio ---------- */
$(function () {
    cargarClientesSelect();
    cargarProductosSelect();
    listarClientes();
});
