# Prueba técnica Beeping

## Requisitos del Proyecto

1. **Instalación del Entorno**:
   - Instalar Laravel 8 (PHP 7.4).
   - Utilizar Livewire.

2. **Base de Datos**:
   - Crear migraciones.
   - Añadir a la base de datos 20 registros de "orders" con sus respectivas "lines" y 10 registros de "products".

3. **Comando Eloquent Asíncrono**:
   - Crear un comando con una consulta Eloquent que calcule el coste total de todas las órdenes en la base de datos. Para este cálculo, se debe multiplicar la cantidad ("qty") de las líneas de la orden por el "cost" del producto.
   - Ejecutar esta consulta de forma asíncrona a través de un JOB de Laravel en la base de datos.
   - Imprimir el resultado en la terminal al ejecutar las colas.

4. **Interfaz de Usuario con Livewire**:
   - Utilizar Livewire para mostrar un listado de todas las órdenes en una tabla.
   - La tabla debe mostrar los siguientes campos: "order_ref", "customer_name" y "total qty".

5. **Configuración del Archivo .env**:
   - Crear un mini instructivo que incluya la configuración principal del archivo `.env`.

## Control de Versiones

- Cada tarea debe ser registrada en una rama de Git.

## Entrega

- Enviar el enlace al proyecto (repositorio) al reclutador/a.

## Tablas

### orders
- ID (bigint)
- order_ref (varchar)
- customer_name (varchar)
- created_at (timestamp)
- updated_at (timestamp)

### orders_lines
- ID (bigint)
- order_id (bigint)
- qty (int)
- product_id (bigint)
- created_at (timestamp)
- updated_at (timestamp)

### products
- ID (bigint)
- name (varchar)
- cost (double)
- created_at (timestamp)
- updated_at (timestamp)
