<?xml version="1.0"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:template match="/results">
        <html>
            <body>
                <h1>Results</h1>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZIP</th>
                        <th>Credit Card</th>
                        <th>Balance</th>
                    </tr>
                    <xsl:for-each select="customer">
                        <tr>
                            <td><xsl:value-of select="@id" /></td>
                            <td><xsl:value-of select="@nameFirst" /></td>
                            <td><xsl:value-of select="@nameLast" /></td>
                            <td><xsl:value-of select="@address" /></td>
                            <td><xsl:value-of select="@city" /></td>
                            <td><xsl:value-of select="@st" /></td>
                            <td><xsl:value-of select="@zip" /></td>
                            <td><xsl:value-of select="@creditCard" /></td>
                            <td><xsl:value-of select="@balance" /></td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>