<?php
/**
 * Created by IntelliJ IDEA.
 * User: Benjamin Legrand
 * Date: 14/03/13
 * Time: 11:51
 * To change this template use File | Settings | File Templates.
 */
$facebook = new Facebook(array(
    'appId'  => '344617158898614',
    'secret' => '6dc8ac871858b34798bc2488200e503d',
));

// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
        $user = null;
    }
}