# Sistema de Pedidos (PHP REST + AJAX/jQuery)

## Instalación (XAMPP)
1. Copiar la carpeta `pedidos_app` en `C:\xampp\htdocs\`.
2. Iniciar Apache y MySQL en XAMPP.
3. Abrir phpMyAdmin -> pestaña SQL (o Importar) y ejecutar `database/schema.sql`.
4. Si MySQL tiene contraseña, editar `config/Database.php`.
5. Abrir `http://localhost/pedidos_app/` (entra a `frontend/index.html`).

## Servicios REST
| Método | URL                                   | Descripción                     |
|--------|---------------------------------------|---------------------------------|
| GET    | api/clientes.php                      | Lista todos los clientes        |
| GET    | api/clientes.php?cedula=1801234567    | Busca cliente por cédula        |
| GET    | api/productos.php                     | Lista los productos             |
| POST   | api/pedidos.php                       | Registra pedido (JSON)          |
| GET    | api/pedidos.php?cliente_id=1          | Pedidos de un cliente (detalle) |

Body del POST: `{"cliente_id":1,"producto_id":2,"cantidad":3}`

## Estructura
config/ models/ controllers/ api/ database/ frontend/
