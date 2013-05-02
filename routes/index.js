
/*
 * GET home page.
 */

exports.index = function(req, res){
    res.render('index', { title: 'Express' });
};
/*
 * GET login/register page.
 */
exports.login = function(req, res){
    res.render('user/login', { title: 'Express' });
};
/*
 * GET user profile page.
 */
exports.profile = function(req, res){
    res.render('user/profile', { title: 'Express' });
};