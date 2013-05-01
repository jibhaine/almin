

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
     * @class Analysis
     * @constructor
     */
    var Analysis = function() {

        /**
         *
         * @property {*} id
         */
        this.id = null;
    }
    if(window['Resource'] == null || window['Resource'] == undefined) {
        throw(new Error('Analysis relies on Resource which cant be found. Please add it to the html (before Analysis).'));
    }
    else
    {
        Analysis.prototype = new Resource();
    }
    window.Analysis = Analysis;
}());
