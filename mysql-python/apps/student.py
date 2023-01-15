from flask import Flask, jsonify, request
from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = "mysql+pymysql://root:@localhost:3306/movil21"
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)
ma = Marshmallow(app)

class estudiantes(db.Model):
    id_estudiante = db.Column(db.Integer, primary_key=True)
    nombres = db.Column(db.String(50))
    apellidos = db.Column(db.String(50))
    telefono = db.Column(db.String(15))

    def __init__(self, nombres, apellidos, telefono):
        self.nombres = nombres
        self.apellidos = apellidos
        self.telefono = telefono

with app.app_context():
    db.create_all()

class estudiantesSchema(ma.Schema):
    class Meta:
        fields = ('id_estudiante', 'nombres', 'apellidos', 'telefono')

estudiantes_schema = estudiantesSchema()
estudiantes_s_schema = estudiantesSchema(many=True)

#get all students
@app.route('/estudiantes', methods=['GET'])
def getestudiantes():
    allestudiantes = estudiantes.query.all()
    response = estudiantes_s_schema.dump(allestudiantes)
    return jsonify(response)

#get student by id
@app.route('/estudiantes/<id>', methods=['GET'])
def getestudiantesbyid(id):
    estudiante = estudiantes.query.get(id)
    return estudiantes_schema.jsonify(estudiante)

#create new student
@app.route('/estudiantes', methods=['POST'])
def setestudiantes():
    nombres = request.json['nombres']
    apellidos = request.json['apellidos']
    telefono = request.json['telefono']

    nuevo_est = estudiantes(nombres, apellidos, telefono)
    db.session.add(nuevo_est)
    db.session.commit()
    return estudiantes_schema.jsonify(nuevo_est)

#update student by id
@app.route('/estudiantes/<id>', methods=['PUT'])
def updestudiantes(id):
    estudiante = estudiantes.query.get(id)
    nombres = request.json['nombres']
    apellidos = request.json['apellidos']
    telefono = request.json['telefono']

    estudiante.nombres = nombres
    estudiante.apellidos = apellidos
    estudiante.telefono = telefono

    db.session.commit()
    return estudiantes_schema.jsonify(estudiante)

#delete student by id
@app.route('/estudiantes/<id>', methods=['DELETE'])
def delestudiantesbyid(id):
    estudiante = estudiantes.query.get(id)

    db.session.delete(estudiante)
    db.session.commit()
    return estudiantes_schema.jsonify(estudiante)

@app.route('/', methods=['GET'])
def index():
    return jsonify({'Message': 'Welcome'})

if __name__=="__main__":
    app.run(debug=True)

