var config = require('./dbconfig')
const sql = require('mssql');

async function getUser() {
    try {
        let pool = await sql.connect(config);
        let users = await pool.request().query("SELECT * FROM Usuario");
        return users.recordsets;
    } catch (error) {
        console.log(error);
    }
}

async function getUserbyId(id) {
    try {
        let pool = await sql.connect(config);
        let user = await pool.request()
            .input('input_parameter', sql.Int, id)
            .query("SELECT * FROM Usuario WHERE IdUsuario = @input_parameter");
        return user.recordsets;
    } catch (error) {
        console.log(error);
    }
}

async function setUser(user) {
    try {
        let pool = await sql.connect(config);
        let setuser = await pool.request()
            .input('name', sql.VarChar, user.Nombre)
            .input('lastn', sql.VarChar, user.Apellido)
            .input('dni', sql.VarChar, user.DNI)
            .input('adress', sql.VarChar, user.Direccion)
            .input('phone', sql.VarChar, user.Telefono)
            .execute("pri_user");
        return setuser.recordsets;
    } catch (error) {
        console.log(error);
    }
}

module.exports = {
    getUser: getUser,
    getUserbyId: getUserbyId,
    setUser: setUser
}