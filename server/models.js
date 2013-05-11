(function(module){
    var Sequelize = require('sequelize')
        , models = {
           // User : require('./models/User')
        }
        , config = require('config');
    console.log("config"+config);
    console.log("models"+config);

    module.exports.models = models;

})(module);