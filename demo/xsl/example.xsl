<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <head>
                <title>Demo page for Silex with XSLTemplate</title>
            </head>
            <body>
                <h1>Demo page</h1>
                <p>This page generated with:</p>
                <p>
                    Vendor:
                    <xsl:value-of select="system-property('xsl:vendor')" />
                    <br />
                    Version:
                    <xsl:value-of select="system-property('xsl:version')" />
                    <br />
                    Vendor URL:
                    <xsl:value-of select="system-property('xsl:vendor-url')" />
                </p>
                <p>
                    XML source of this page <a href="example.php?xml=1" target="_blank">XML</a>.
                </p>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>