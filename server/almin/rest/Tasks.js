

/**
 *@namespace almin::resources
 */
(function () {

    /**
     *
     *
     * @author Benjamin Legrand
     * @created 30/4/2013
     * @copyright Jerzual
     * @todo
     * @class Tasks
     * @constructor
     */
    var Tasks = { };

    Tasks.get = function(req, res) {
        res.json({});
    };

    Tasks.save = function(req, res) {
        res.send(200);
    };

    Tasks.query = function(req, res) {
        res.json([]);
    };

    Tasks.remove = function(req, res) {
        res.send(200);
    };

    module.exports = Tasks;
}());
