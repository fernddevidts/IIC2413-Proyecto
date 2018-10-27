# Grupo 6 y 11

A continuación especificaremos todo lo que se encuentra en nuestra aplicación, siguiendo el orden del enunciado para mayor claridad.

Para ingresar a nuestra aplicación, haga click [aquí](http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/index.php).

## Estructura básica
Nuestra página tiene 4 pestañas básicas, que pueden ver los usuarios no loggeados:

- Login 
- Home
- Servicios
- Productos

Para los usuarios loggeados, además se agrega una pestaña de Profile, y en vez de estar la pestaña Login, hay una de Logout.

## Login a la aplicación

http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/login/login.php 

Al ingresar a la pestaña Login, en la parte superior del navegador para usuarios no loggeados, se pide ingresar un usuario y contraseña. Para lograr ingresar es necesario un usuario y contraseña que estén en el modelo de usuarios de la base de datos.

## Perfil de usuario

http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/profile.php

Al ingresar a la pestaña Profile, en la parte superior del navegador para usuarios loggeados, se abre una ventana con una view principal, y pestañas adicionales. 

Las funciones correspondientes al apartado "Perfil de usuario" del enunciado, se encuentran en las pestañas adicionales del Profile. Se describen a continuación:

- Transferencias: en esta pestaña el usuario puede ver sus transferencias históricas a otros usuarios http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/transferencias.php
- Compras: en esta pestaña el usuario puede ver la lista de todas sus compras, incluyendo tanto las de productos como las de servicios. http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/compras.php Para cada una de las compras, hay 4 columnas: 

  - Id compra: id de la compra de producto o servicio respectiva
  - Productos: todos los productos (o servicios) parte de la compra
  - Monto: el monto total de la compra respectiva
  - Cuotas: todas las cuotas y su información respectiva (id, monto, fecha de expiración y pagado)

- Tarjetas: listado de todas las tarjetas del usuario, y la opción de agregar una nueva tarjeta o remover una existente, que se explicarán en la sección respectiva http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/tarjetas.php
- Seguros: listado de todos los seguros, y la opción de contratar un nuevo seguro, que se explicará en la sección respectiva http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/seguros/seguros.php
- Saldo actual: se indica el saldo actual del cliente, considerando todo lo que ha abonado, menos todo lo que ha gastado en pagos, más todo lo que ha ganado en pagos http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/saldo.php

## Abonos y seguros

Las funciones correspondientes al apartado "Abonos y seguros" del enunciado, se encuentran en la view principal y en las pestañas adicionales del Profile. Se describen a continuación:

- Contratar seguro: se puede hacer ingresando a la pestaña "Seguros" del Profile, apretando el botón "Contratar Seguro". Al lado de cada seguro hay un botón que dice "Contratar". Se hizo como supuesto que la fecha de expiración del seguro es de 2 años a partir de la fecha de contratación (hoy) http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/seguros/contrato_seguro.php

- Añadir/quitar tarjeta de crédito: se puede hacer ingresando a la pestaña "Tarjetas" del Profile. Para quitar una tarjeta, hay un botón "Remove" al lado de cada tarjeta y para agregar una tarjeta, en la parte inferior hay un botón "Agregar Tarjeta", que redirige a otra página donde se puede realizar la acción:
  - Quitar: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/tarjetas.php
  - Añadir: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/agregar_tarjeta.php
- Abonar a la cuenta: se puede hacer desde el view principal del Profile, donde hay un botón que dice "Abonar", y se puede elegir la tarjeta de crédito a utilizar http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/abonos.php
- Monto de la nebcoin: el valor de la NebCoin y ETH se obtienen de  [CoinMarketCap](http://coinmarketcap.com/) en dólares. Este valor se encuentra en el Home de la aplicación:
  - Para usuarios loggeados: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/login/welcome.php
  - Para usuarios no loggeados: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/index.php

## Transferencia entre usuarios
http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/transferir.php

Existe la posibilidad de hacer una transferencia de un usuario a otro por cierto monto, sin cuotas. Esta opción se encuentra en la view principal del Profile, en el botón que dice "Transferir". Este redirige a otra página donde se realiza la acción. Los usuarios a los que se puede transferir se eligen de una lista desplegable. 

## Búsqueda de tiendas
http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/profile.php

Esta opción se encuentra en la view principal del Profile. Para buscar tiendas por nombre, es necesario escribir con mayúsculas y minúsculas, al igual como fueron ingresadas a la base de datos. Ej: “Homecenter” funciona, pero “homecenter” no.


## Búsqueda de productos y servicios
http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/profile/profile.php

Esta opción se encuentra en la view principal del Profile. Para buscar productos y servicios por nombre, es necesario escribir con mayúsculas y minúsculas, al igual como fueron ingresadas a la base de datos, con en el caso de búsqueda de tiendas.


## Página de producto o servicio

Para buscar productos o servicios, en la parte superior del navegador hay dos pestañas, "Productos" y "Servicios". En cada página, se despliega una lista de productos o servicios (respectivamente), y para acceder a uno de ellos basta con apretarlo. Al apretarlo, aparece la información de cada producto/servicio (id, nombre, descripción y precio) y en la última columna se encuentran todas las tiendas en que el producto/servicio puede ser comprado. Si hay un usuario loggeado, este va a ver un botón de comprar abajo del producto/servicio seleccionado. Si no está loggeado, no estará este botón.

- Productos: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/productos.php
- Servicios: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/servicios.php

## Compra de producto o servicio

Desde las páginas de productos y servicios, al apretar un producto/servicio y ver su información, hay abajo un botón de "Comprar". Al apretar este botón, se redirige a otra página, en la que en caso de ser un producto, se pueden elegir tres cosas:

- Cantidad de cuotas: mínimo 1 y máximo 6. Se asume que al elegir comprar el producto/servicio, se agrega a la base de datos de pagos y la de cuotas (aunque sea solo una cuota), y que el dato "pagado" de la cuota es falso. Las cuotas tienen un mes de diferencia, siendo la primera a un mes mes de la fecha actual (hoy)
- Tienda donde ser comprado
- Cantidad de unidades: mínimo 1 y máximo 10

En caso de ser un servicio, no se puede elegir el número de unidades. Finalmente hay un botón de "Comprar", que de ser apretado, redirige a otra página donde se indica que la compra fue exitosa, y se generan los cambios en las bases de datos respectivas.

A continuación se indican las rutas igualmente, aunque no tiene mucho sentido apretarlas porque la información aparece al hacerlo a través de la aplicación:

- Información de servicio: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/serv_individual.php
- Información de producto: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/prod_individual.php
- Comprar: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/comprar.php
- Éxito de compra: http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/ventas/exit.php
