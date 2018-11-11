# Entrega 4 - Grupo 6 y 11

A continuación especificaremos todo lo que se encuentra en nuestra API, siguiendo el orden del enunciado para mayor claridad.

Para ingresar a nuestra API y base de datos, hay que ejecutar lo siguiente: 
- En MongoDB:
  - En la shell, ejecutar ```use Grupo6```
  - En la carpeta Datos, ejecutar desde el terminal ```mongoimport --db Grupo6 --collection mensajes --file messages.json --jsonArray```
  - En la carpeta Datos, ejecutar desde el terminal ```mongoimport --db Grupo6 --collection usuarios --type csv --file usuarios.csv --headerline```
  
- En Python:
  - Ejecutar el archivo ```__init__.py```.

Además tenemos un archivo **grupo6_entrega4.postman_collection.json**, para hacer las consultas de tipo GET, POST y DELETE.

## GET
Se especificarán las funciones de python y las rutas para ejecutar.

- ```message_id(id)```: recibe el id de un mensaje y retorna la información del mensaje.
  - **URL**: /message_info/<string: message_id>

- ```sender(id)```: recibe el id de un usuario y retorna la información del usuario y los mensajes que ha enviado.
  - **URL**: /sender/<int: user>

- ```conversation(user1, user2)```: recibe los ids de dos usuarios y retorna los mensajes intercambiados entre ellos. 
  - **URL**: /conversation/<int: user1>/<int: user2>

Además, en nuestro archivo de Postman **grupo6_entrega4.postman_collection.json**, hay una consulta para cada uno de estas rutas. Se llaman, respectivamente:
- Get message by id
- Get user and user's messages by user id
- Get messages between to users by their ids
## Text Search
Se especificarán las funciones de python y las rutas para ejecutar.

### Sobre todos los mensajes en la base de datos
- ```all_msgs_sentence(sentence)```: recibe una o más frases y retorna los mensajes que las contienen exactamente como están escritas. Las frases tienen que estar separadas por “-” y las palabras por “_” en la url. 
  - Ej: “encanta_el_metal-que_hablar”
  - **URL**: /all_msgs/sentence/<string: sentence>

- ```all_msgs_words(words)```: recibe una o más palabras y retorna los mensajes que contienen una o más de ellas. Las palabras tienen que estar separadas por “_” en la url.
  - Ej: “encanta_metal”
  - **URL**: /all_msgs/words/<string: words>

- ```all_msgs_not_words(yes_words, not_words)```: recibe palabras que sí puede contener el mensaje y palabras que no puede contener el mensaje. Retorna mensajes que pueden contener una o más palabras yes_words y que excluyen las not_words. Las palabras tienen que estar separadas por “_” en la url.
  - Ej: ”yes_words/encanta/not_words/metal_mal”
  - **URL**: /all_msgs/yes_words/<string: yes_words>/not_words/<string: not_words>

### Sobre los mensajes emitidos por un usuario en particular
- ```sender_sentence(user, sentence)```: recibe el id de un usuario y una o más frases. Retorna los mensajes del usuario cuyo id es el entregado y contienen las frases exactas. Las palabras de las frases tienen que estar separadas por “_” y las frases tienen que estar separadas por “-” en la url.
  - Ej: “sender/1/sentence/Me_encanta-reggaetton”
  - **URL**: /sender/<int: user>/sentence/<string: sentences>

- ```sender_words(user, words)```: recibe el id de un usuario y una o más palabras. Retorna los mensajes de ese usuario que contienen una o más de las palabras entregadas. Las palabras tienen que ir separadas por “_” en la url.
  - Ej: “sender/1/words/me_encanta_despido”
  - **URL**: /sender/<int: user>/words/<string: words>

- ```sender_not_words(user, yes_words, not_words)```: recibe el id de un usuario, palabras que sí puede contener el mensaje y palabras que no puede contener el mensaje. Retorna los mensajes del usuario cuyo id es el entregado y contiene una o más palabras yes_words y que excluyen las not_words. Las palabras tienen que estar separadas por "_" en la url.
  - Ej: "sender/1/yes_words/encanta_el/not_words/tiempo"
  - **URL**: /sender/<int: user>/yes_words/<string: yes_words>/not_words/<string: not_words>

## POST
Se especificará las función de Python y ruta a ejecutar.

- ```add_message()```: recibe el id de un usuario sender, otro de un usuario receptant, y un mensaje a enviar.
  - **URL**: /add_message/

En nuestro archivo de Postman **grupo6_entrega4.postman_collection.json**, para facilitar el llamado, hay una consulta que ejecuta el POST. Se llama **Send message JSON**.

## DELETE
Se especificará las función de Python y ruta a ejecutar.

- ```remove_message(message_id)```: recibe el id de un mensaje a eliminar
  - **URL**: /remove_message/<string: message_id>

En nuestro archivo de Postman **grupo6_entrega4.postman_collection.json**, para facilitar el llamado, hay una consulta que ejecuta el DELETE. Se llama **Remove message**. Hay que cambiar el id del mensaje para ejecutarla, pues es diferente dependiendo de la creación de la base de datos.
