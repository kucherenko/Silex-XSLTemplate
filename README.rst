SilexXSLTemplate\\ServiceProvider
================================

The *SilexXSLTemplate\\ServiceProvider* provides integration `Silex
<http://silex.sensiolabs.org/>`_ microframework with the `XSLTemplate
<https://github.com/kucherenko/xsltemplate/>`_ template engine.

Works with PHP 5.3.2 or later.

Parameters
----------

* **xsltemplate.templates.path**: Path to the directory containing xsl template files.

* **xsltemplate.templates.url**: HTTP url to xsl templates.

* **xsltemplate.parameters** (optional): An associative array of xsltemplate
  parameters. Check out the xsltemplate documentation for more information.

Services
--------

* **xsltemplate**: The ``XSLTemplate\Renderer`` instance. The main way of
  interacting with XSLTemplate.

* **xsltemplate.writer**: The ``XSLTemplate\XML\Writer`` instance. Object for collect data for template in xml format.

* **xsltemplate.configure**: Protected closure that takes the XSLTemplate
  environment as an argument. You can use it to add more
  custom globals.


Registering
-----------

Make sure you place a copy of *XSLTemplate* in the ``vendor/xsltemplate``
directory::

    $app->register(new SilexXSLTemplate\ServiceProvider(), array(
        'xsltemplate.templates.path' => __DIR__ . '/xsl',
        'xsltemplate.templates.url'  => 'xsl/',
        'xsltemplate.class_path'     => __DIR__ . '/vendor/xsltemplate/src',
    ));


Usage
-----

The XSLTemplate provider provides a ``xsltemplate`` service::

    $app->get('/hello/{name}', function ($name) use ($app) {

        $app['xsltemplate.writer']->writeElement('page', 'test');

        $content = $app['xsltemplate']->render('hello.xsl', $app['xsltemplate.writer']);
        $contentType = $app['xsltemplate']->getContentType();

        return new Symfony\Component\HttpFoundation\Response(
            $content,
            200,
            array('Content-Type' => $contentType)
        );
    });

This will render a file named ``xsl/hello.xsl``.


For more information, check out the `XSLTemplate documentation
<https://github.com/kucherenko/xsltemplate/tree/master/doc>`_.