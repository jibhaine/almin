
/**
 *@namespace almin::models
 */
(function () {

    /**
     *
     *
     * @author Benjamin Legrand
     * @created 30/4/2013
     * @copyright Jerzual
     * @todo
     * @class User
     * @constructor
     */
    var User = function() {

        /**
         *
         * @property {*} id
         * @private
         */
        var id = null;
        /**
         *
         * @property {*} name
         * @private
         */
        var name = null;
        /**
         *
         * @property {*} email
         * @private
         */
        var email = null;
        /**
         *
         * @property {*} hash
         * @private
         */
        var hash = null;
        /**
         *
         * @property {*} token
         * @private
         */
        var token = null;
        /**
         *
         * @property {*} created
         * @private
         */
        var created = null;
    }

    /**
     *
     * @method loginWith
     * @param  {*} login
     * @param  {*} pass
     */
    User.prototype.loginWith = function(login, pass){

        //Stub code - to be removed
        alert("the function 'loginWith' has been called  " + " with the following parameters:" + " login:" + login + " pass:" + pass)

    }
    /**
     *
     * @method hasRole
     * @param  {*} key
     */
    User.prototype.hasRole = function(key){

        //Stub code - to be removed
        alert("the function 'hasRole' has been called  " + " with the following parameters:" + " key:" + key)

    }
    window.User = User;
}());