
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
     * @class Job
     * @constructor
     */
    var Job = function() {

        /**
         *
         * @property {*} id
         */
        this.id = null;
    }
    if(window['Resource'] == null || window['Resource'] == undefined) {
        throw(new Error('Job relies on Resource which cant be found. Please add it to the html (before Job).'));
    }
    else
    {
        Job.prototype = new Resource();
    }
    window.Job = Job;
}());