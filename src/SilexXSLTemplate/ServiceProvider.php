<?php

/*
 * This file contains xslt provider for of the Silex framework.
 *
 * (c) Andrey Kucherenko <andrey@kucherenko.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SilexXSLTemplate;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \XSLTemplate\Renderer;
use \XSLTemplate\XML\Writer;
/**
 * Xslt Provider.
 *
 * Allow use xsl templates with Silex microframework.
 * Can understand if browser can process xslt on client side or generate html on server side.
 *
 * @author Andrey Kucherenko <andrey@kucherenko.org>
 */
class ServiceProvider implements ServiceProviderInterface {

    /**
     * Register XSL templates for Silex microframework
     *
     * @param \Silex\Application|\SilexXSLTemplate\Application $app
     */
    public function register(Application $app) {
        $app['xsltemplate'] = $app->share(function () use ($app) {

            $renderer = new Renderer();

            if (isset($app['xsltemplate.parameters'])) {
                $renderer->addParameters($app['xsltemplate.parameters']);
            }

            if (isset($app['xsltemplate.templates.path'])) {
                $renderer->addParameters(array('templates.path' => $app['xsltemplate.templates.path']));
            }

            if (isset($app['xsltemplate.templates.url'])) {
                $renderer->addParameters(array('templates.url' => $app['xsltemplate.templates.url']));
            }

            if (isset($app['xsltemplate.configure'])) {
                $app['xsltemplate.configure']($renderer);
            }

            return $renderer;
        });

        $app['xsltemplate.writer'] = $app->share(function() use ($app){
            $writer = new Writer();
            $writer->init();
            return $writer;
        });

    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
    }
}