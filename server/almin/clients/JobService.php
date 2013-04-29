<?php
namespace MyService;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Client for a Jenkins Node instance.
 */
class JobService  extends Client
{
    /**
     * Factory method to create a new MyServiceClient
     *
     * The following array keys and values are available options:
     * - base_url: Base URL of web service
     * - scheme:   URI scheme: http or https
     * - username: API username
     * - password: API password
     *
     * @param array|Collection $config Configuration data
     *
     * @return self
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url' => '{scheme}://{username}.test.com/',
            'scheme'   => 'https'
        );
        $required = array('username', 'password', 'base_url');
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);
        // Attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/client.php');
        $client->setDescription($description);

        return $client;
    }
}