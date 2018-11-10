from bson.objectid import ObjectId
from flask import Flask, jsonify, abort, request
from pymongo import MongoClient, TEXT
# import json
import sys


# class JSONEncoder(json.JSONEncoder):
#     def default(self, o):
#         if isinstance(o, ObjectId):
#             return str(o)
#         return json.JSONEncoder.default(self, o)


app = Flask(__name__)
app.config['JSON_AS_ASCII'] = False
# MONGODATABASE corresponde al nombre de su base de datos
MONGODATABASE = "Grupo6"
MONGOSERVER = "localhost"
MONGOPORT = 27017
# instanciar el cliente de pymongo para realizar consultas a la base de datos
client = MongoClient(MONGOSERVER, MONGOPORT)


# Recibir id mensaje y retornar info mensaje
@app.route('/message_info/<string:message_id>', methods=['GET'])
def message_info(message_id):
    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    output = mensajes.find_one({'_id' : ObjectId(message_id)}, {'_id':0})
    if len(output) == 0:
        return jsonify(), 404
    else:
        return jsonify(output), 200
        # return JSONEncoder().encode(output), 200


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


# Recibir 2 id usuario y retorna mensajes intercambiados
@app.route('/exchange/<int:user1>/<int:user2>', methods=['GET'])
def exchange(user1, user2):
    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    usuarios = mongodb.usuarios
    output = []
    for s in mensajes.find( {
    "$or" : [
        { "$and" : [ { "sender" : user1 }, { "receptant" : user2 } ] },
    { "$and" : [ {"sender": user2 }, { "receptant" : user1 }]}
    ]}, {"_id": 0}):
        output.append(s)
    if len(output) == 0:
        return jsonify(), 404
    # Retorna los mensajes
    else:
        return jsonify(output), 200



# Busqueda de texto en todos los mensajes
# Frase especifica
@app.route('/all_msgs/sentence/<string:sentences>', methods=['GET'])
def all_msgs_sentence(sentences):
    sentence_search = ""
    sentences_list = sentences.split("-")
    for sentence in sentences_list:
        sentence_split = sentence.split("_")
        sentence_mongo = '\"'
        for word in sentence_split:
            sentence_mongo = sentence_mongo + " " + word
        sentence_mongo += '\"'
        sentence_search += sentence_mongo + " "

    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    mensajes.create_index([('message', TEXT)])
    output = []
    for m in mensajes.find({'$text': {'$search': sentence_search}},{'_id' : 0}):
        output.append(m)
    if len(output) == 0:
        return jsonify(), 404
    else:
        return jsonify(output), 200

# Una o mas palabras que puede contener
@app.route('/all_msgs/words/<string:words>', methods=['GET'])
def all_msgs_words(words):
    words_search = ""
    words= words.split("_")
    for word in words:
        words_search += word + " "

    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    mensajes.create_index([('message', TEXT)])
    output = []
    for m in mensajes.find({'$text': {'$search': words_search}}, {'_id': 0}):
        output.append(m)
    if len(output) == 0:
        return jsonify(), 404
    else:
        return jsonify(output), 200


# palabras que no esten en el mensaje
@app.route('/all_msgs/yes_words/<string:yes_words>/not_words/<string:not_words>', methods=['GET'])
def all_msgs_not_words(yes_words, not_words):
    not_words_search = ""
    yes_words_search = ""
    words_search = ""
    not_words = not_words.split("_")
    yes_words = yes_words.split("_")
    for word in yes_words:
        yes_words_search += word + " "
    for word in not_words:
        not_words_search += "-" + word + " "
    words_search = yes_words_search + " " + not_words_search
    mongodb = client[MONGODATABASE]
    mensajes = mongodb.mensajes
    mensajes.create_index([('message', TEXT)])
    output = []
    for m in mensajes.find({'$text': {'$search': words_search}}, {'_id': 0}):
        output.append(m)
    if len(output) == 0:
        return jsonify(), 404
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