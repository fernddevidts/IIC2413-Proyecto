from flask import Flask, jsonify, abort, request
from pymongo import MongoClient
import sys

# Se recomienda descargar el json de requests para postman,
# e importarlo en postman para probar las funciones.

app = Flask(__name__)
# MONGODATABASE corresponde al nombre de su base de datos
MONGODATABASE = "Grupo6"
MONGOSERVER = "localhost"
MONGOPORT = 27017
# instanciar el cliente de pymongo para realizar consultas a la base de datos
client = MongoClient(MONGOSERVER, MONGOPORT)


# Decorador defiene la ruta.
@app.route('/')
def hello_world():
    # Funcion retorna una json en base de su request
    # Se recomienda usar jsonify de Flask para manejar la creacion de json
    # Para hacer un print, necesitan hacerlo de la siguiente manera:
    print(123, file=sys.stdout)
    return jsonify({"status": "ok"})

# Recibir id mensaje y retornar info mensaje
@app.route('/message_info/<string:message_id>', methods=['GET'])
def message_info(message_id):
    mongodb = client[MONGODATABASE]
    collection = mongodb.mensajes
    output = collection.find({"_id" : ObjectId(message_id)})
    if len(output) == 0:
        return jsonify(), 404
    else:
        return jsonify(output), 200


# Recibir id usuario y retornar info usuario y sus mensajes enviados
@app.route('/sender/<int:user>', methods=['GET'])
def sender(user):
    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    usuarios = mongodb.usuarios
    output = []
    for u in usuarios.find({"id_usuario": user}, {"_id": 0, "clave": 0}):
        output.append(u)
    for s in mensajes.find({"sender": user}, {"_id": 0}):
        output.append(s)
    if len(output) == 0:
        return jsonify(), 404
    # Retorna los mensajes
    else:
        return jsonify(output), 200


# La función recibe una json con los parametros de la insercion,
# No es necesario agregar variables dentro del URL
@app.route('/add_message/', methods=['POST'])
def add_message():
    mongodb = client[MONGODATABASE]
    collection = mongodb.ayudantia
    # Guarda el json en el variable data
    data = request.get_json()
    # Se inserta un nuevo item a la colección de mongo con los
    #  parámetros definidos en el json
    inserted_message = collection.insert_one({
        'message': data["message"],
        'sender': data["sender"],
        'receptant': data["receptant"],
        'date': data["date"],
    })
    # insert_one retorna None si no pudo insertar
    if inserted_message is None:
        return jsonify(), 404
    # Retorna el id del elemento insertado
    else:
        return jsonify({"id": str(inserted_message.inserted_id)}), 200


@app.route('/remove_message/<string:date>', methods=['DELETE'])
def remove_message(date):
    mongodb = client[MONGODATABASE]
    messages = mongodb.ayudantia
    result = messages.delete_one({
        'date': date,
    })

    if result.deleted_count == 0:
        return jsonify(), 404
    else:
        return jsonify("Eliminado"), 200


if __name__ == '__main__':
    # Pueden definir su puerto para correr la aplicación
    app.run(port=5000)