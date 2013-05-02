
/**
 * Module dependencies.
 */

var express = require('express')
    , routes = require('./routes')
    , api = require('./routes/api')
  , Sequelize = require("sequelize")
  , http = require('http')
  , path = require('path'),
    log4js = require('log4js');

log4js.configure({
    appenders: [
        { type: 'console' },
        { type: 'file', filename: 'logs/almin.log', category: 'global' }
    ]
});

var logger = log4js.getLogger('global');

var app = express(),

database_options = {
    schema: "almin",
    user: "almin",
    password: "almin",
    host: "localhost",
    port: "5432"
},

allowCrossDomain = function(req, res, next) {
    res.header('Access-Control-Allow-Origin', "*");
    res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
    res.header('Access-Control-Allow-Headers', 'Content-Type');
    return next();
};

// all environments
app.configure(function() {
app.set('port', process.env.PORT || 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');
app.use(express.favicon());
app.use(express.logger('dev'));
app.use(express.bodyParser());
app.use(express.methodOverride());
  app.use(express.cookieParser('your secret here'));
  app.use(express.session());
    app.use(allowCrossDomain);
app.use(app.router);
  app.use(require('less-middleware')({ src: __dirname + '/public' }));
app.use(express.static(path.join(__dirname, 'public')));
});

app.configure('development', function() {
    app.use(express.errorHandler({
        dumpExceptions: true,
        showStach: true
    }));
    return database_options.logging = true;
});

app.configure('production', function() {
    app.use(express.errorHandler());
    return database_options.logging = false;
});

// Routes

app.get('/', routes.index);
app.get('/partial/:name', routes.partial);
app.get('/api/name', api.name);


http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});
