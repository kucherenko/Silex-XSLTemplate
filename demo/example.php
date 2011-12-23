<?php
/**
 * Example of Silex application with XSLTemplate
 *
 * @author Andrey Kucherenko <andrey@kucherenko.org>
 * @date   23.12.11
 */

require_once 'silex.phar';
require_once '../src/SilexXSLTemplate/ServiceProvider.php';

$app = new Silex\Application();

$app->register(new SilexXSLTemplate\ServiceProvider(), array(
    'xsltemplate.templates.path' => __DIR__ . '/xsl',
    'xsltemplate.templates.url'  => 'xsl/',
    'xsltemplate.class_path'     => __DIR__ . '/../vendor/xsltemplate/src',
));

$app->get('/', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $app['xsltemplate.writer']->writeElement('page', 'test');

    if ($request->get('xml')) {
        $app['xsltemplate']->addParameters(array(
            'only.xml' => true
        ));
    }

    $content = $app['xsltemplate']->render('example.xsl', $app['xsltemplate.writer']);
    $contentType = $app['xsltemplate']->getContentType();

    return new Symfony\Component\HttpFoundation\Response(
        $content,
        200,
        array('Content-Type' => $contentType)
    );
});

$app->run();