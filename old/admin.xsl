<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="3.0" xmlns:sl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match = "/">
        <htlm>
            <header>
                <title>Ticketing</title>
            </header>
            <body>
                <h1>Ticket</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>User ID</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:apply-templates select="/tickets/ticket" />
                    </tbody>
                </table>

            </body>
        </htlm>

    </xsl:template>

    <xsl:template match="ticket">
        <tr>
            <td><xsl:apply-templates select="id" /> </td>
        </tr>
    </xsl:template>
</xsl:stylesheet>