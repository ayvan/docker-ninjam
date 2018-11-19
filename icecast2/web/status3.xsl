<xsl:stylesheet xmlns:xsl = "http://www.w3.org/1999/XSL/Transform" version = "1.0" >
<xsl:output omit-xml-declaration="no" method="xml" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" indent="yes" encoding="UTF-8" />
<xsl:template match = "/icestats" >
<pre>
<xsl:for-each select="source">
<mount><xsl:value-of select="@mount" /></mount>
<listeners><xsl:value-of select="listeners" /></listeners>
<users> <xsl:value-of select="title" /></users>
</xsl:for-each>
</pre>
</xsl:template>
</xsl:stylesheet>
