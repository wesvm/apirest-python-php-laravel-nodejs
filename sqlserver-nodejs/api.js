const dboUsers = require('./dbuser');
var User = require('./user');

var express = require('express');
var bodyParser = require('body-parser');
var cors = require('cors');

var app = express();
var router = express.Router();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors());
app.use('/api', router);

router.route('/usuarios').get((request, response) => {
    dboUsers.getUser().then(result => {
        response.json(result[0])
    })
})

router.route('/usuarios/:id').get((request, response) => {
    dboUsers.getUserbyId(request.params.id).then(result => {
        response.json(result[0])
    })
})

router.route('/usuarios/guardar').post((request, response) => {
    let user = { ...request.body }
    dboUsers.setUser(user).then(result => {
        response.json({ "message": "yes" })
    })
})

var port = process.env.PORT || 8090;
app.listen(port);
console.log("Listening " + port);
