<html>
<head>
<title>Certificate Query</title>

<style type="text/css">

.inputclass{
    width: 1200px;
    height: 50px;
    top: 10px;
    left: 10px;
    position:absolute;
    padding-top: 10px;

    text-align:center;
    vertical-align:middle;
    background-color:#FFFFFF;

    font-family: Georgia, serif;
    font-size: 16px;
    font-style: italic;
    font-variant: normal;
    font-weight: normal;

    box-shadow: 10px 10px 5px #888888;
    border:2px solid #000000;

    -moz-border-radius-bottomleft:14px;
    -webkit-border-bottom-left-radius:14px;
    border-bottom-left-radius:14px;

    -moz-border-radius-bottomright:14px;
    -webkit-border-bottom-right-radius:14px;
    border-bottom-right-radius:14px;

    -moz-border-radius-topright:14px;
    -webkit-border-top-right-radius:14px;
    border-top-right-radius:14px;

    -moz-border-radius-topleft:14px;
    -webkit-border-top-left-radius:14px;
    border-top-left-radius:14px;
}

.outputclass{
    width: 1160px;
    height: 460px;
    top: 90px;
    left: 10px;
    position:absolute;
    overflow-y: auto;

    padding: 20px;
    text-align:left;
    vertical-align:middle;
    background-color:#FFFFFF;

    font-family: Book Antiqua;
    font-size: 14px;
    font-style: italic;
    font-variant: normal;
    font-weight: normal;

    box-shadow: 10px 10px 5px #888888;
    border:2px solid #000000;

    -moz-border-radius-bottomleft:14px;
    -webkit-border-bottom-left-radius:14px;
    border-bottom-left-radius:14px;

    -moz-border-radius-bottomright:14px;
    -webkit-border-bottom-right-radius:14px;
    border-bottom-right-radius:14px;

    -moz-border-radius-topright:14px;
    -webkit-border-top-right-radius:14px;
    border-top-right-radius:14px;

    -moz-border-radius-topleft:14px;
    -webkit-border-top-left-radius:14px;
    border-top-left-radius:14px;
}

.hold{
    width: 1200px;
    height: 600px;
    margin-left: auto;
    margin-right: auto;
}
.contain{
    position:absolute;
    z-index:0;
    background:transparent;
}             

white.body{
    background-color:#FFFFFF;
}
blue.body{
    background-color:#66CCFF;
}
green.body{
    background-color:#D6EB99;
}
body{
    background-color:#E0E0E0;
}

form {
    width:90%;
    padding-top: 10px;
    background-color:#ffffff;
    vertical-align:middle;
    text-align:center;
    margin:auto;
}

select{
    padding: 2px 6px;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
    font-size: 16px;
    font-family: Georgia, serif;
    font-style: italic;
    font-variant: normal;
    font-weight: normal;
}

.button{
    border-top: 1px solid #96d1f8;
    background: blue;
    background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
    background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
    background: -moz-linear-gradient(top, #3e779d, #65a9d7);
    background: -ms-linear-gradient(top, #3e779d, #65a9d7);
    background: -o-linear-gradient(top, #3e779d, #65a9d7);
    padding: 2px 6px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
    -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
    box-shadow: rgba(0,0,0,1) 0 1px 0;
    text-shadow: rgba(0,0,0,.4) 0 1px 0;
    color: white;
    font-size: 12px;
    font-family: Georgia, serif;
    text-decoration: none;
    vertical-align: middle;
}
.button:hover{
    border-top-color: #28597a;
    background: #28597a;
    color: #ccc;
}
.button:active{
    border-top-color: #1b435e;
    background: #1b435e;
}

pre{
    white-space: pre-line;
    padding: 5;
    border:1px dotted black;
}

</style>

</head>
<body> 

<?php

function printCertArray($v,$k)
{
    echo "/$k=$v", "";
}

if (isset($_POST['host'])) { $defaultHost = $_POST['host']; } else { $defaultHost = ""; }
if (isset($_POST['port'])) { $defaultPort = $_POST['port']; } else { $defaultPort = ""; }
if (isset($_POST['protocol'])) { $defaultProtocol = $_POST['protocol']; } else { $defaultProtocol = ""; }
if (isset($_POST['tls'])) { $defaultTLS = $_POST['tls']; } else { $defaultTLS = ""; }
if (isset($_POST['sni'])) { $defaultSNI = $_POST['sni']; } else { $defaultSNI = ""; }

if ($defaultHost == "")
{
    $defaultHost = "localhost";
}

if ($defaultPort == "")
{
    $defaultPort = "443";
}
?>

<div class="hold">
<div class="contain">

<div class="inputclass">
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
<?php
if (defined("OPENSSL_TLSEXT_SERVER_NAME") && OPENSSL_TLSEXT_SERVER_NAME == "1")
{
    echo "<label>sni <input type=\"checkbox\" name=\"sni\" id=\"sni\" ";
    if($defaultSNI == "on") { echo 'checked'; };
    echo " />";
}
?>
<label>starttls
<input type="checkbox" name="tls" id="tls" onchange="protocolChanged(this)" <?php if($defaultTLS == "on") { echo 'checked'; } ?> />
</label>
&nbsp;
<select onchange="protocolChanged(this)" name="protocol" id="protocol" >
<option <?php if($defaultProtocol == "http") { echo 'selected'; } ?> value="http">http</option>
<option <?php if($defaultProtocol == "ldap") { echo 'selected'; } ?> value="ldap">ldap</option>
<option <?php if($defaultProtocol == "ftp") { echo 'selected'; } ?> value="ftp">ftp</option>
<option <?php if($defaultProtocol == "smtp") { echo 'selected'; } ?> value="smtp">smtp</option>
<option <?php if($defaultProtocol == "imap") { echo 'selected'; } ?> value="imap">imap</option>
<option <?php if($defaultProtocol == "pop3") { echo 'selected'; } ?> value="pop3">pop3</option>
<option <?php if($defaultProtocol == "mysql") { echo 'selected'; } ?> value="mysql">mysql</option>
<option <?php if($defaultProtocol == "pgsql") { echo 'selected'; } ?> value="pgsql">pgsql</option>
<option <?php if($defaultProtocol == "rsyslog") { echo 'selected'; } ?> value="rsyslog">rsyslog</option>
</select>
<input type='text' name='host' id='host' size="70" value=<?php echo $defaultHost; ?> onClick='this.select();' />
:
<input type='text' name='port' id='port' size="5" value=<?php echo $defaultPort; ?> onClick='this.select();' />
<input type='submit' value='Connect' class="button" />
</form>
</div>

<div class="outputclass">

<?php
echo "Current PHP version: " . phpversion() . "<br>\n";
if (defined('OPENSSL_VERSION_TEXT')) {
    echo OPENSSL_VERSION_TEXT.'  ('.OPENSSL_VERSION_NUMBER.')<br /><br />';
} else {
    echo "OpenSSL extensions not found! <br />\n";
    exit(1);
}

if(isset($_POST["host"]))
{
    set_time_limit(0);
    ob_implicit_flush();
    $timeout = 10;

    if (isset($_POST["host"])) { $host = $_POST["host"]; } else { $host = ""; }
    if (isset($_POST["port"])) { $port = $_POST["port"]; } else { $port = ""; }
    if (isset($_POST["protocol"])) { $protocol = $_POST["protocol"]; } else { $protocol = ""; }
    if (isset($_POST["tls"])) { $usetls = $_POST["tls"]; } else { $usetls = ""; }
    if (isset($_POST["sni"])) { $enablesni = $_POST["sni"]; } else { $enablesni = ""; }

    $ip = gethostbyname($host);
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        echo "Connecting to $ip<br>\n";
    } else {
        echo "Could not resolve $host<br>\n";
        return;
    }

    if ($usetls == "on")
    {
        $url = 'tcp://'.$host;
        echo "Fetching SSL Cert from $url:$port...<br>\n";

        if ($protocol == "ftp" || $protocol == "ldap" || $protocol == "smtp" || $protocol == "imap" || $protocol == "pop3" || $protocol == "pgsql" || $protocol == "mysql")
        {
            $r = fsockopen( "tcp://$host", $port, $errno, $errstr, $timeout );
            if (!$r) { echo "! Error $errno: $errstr<br>\n"; } else { echo "Connected OK.<br>"; }

            print("<pre>\n");
            if ($protocol == "ftp")
            {
                $response = fread($r, 512);
                print "$response";

                fwrite($r,"AUTH TLS\r\n");
                $response = fread($r, 512);
                print "$response";
            }
            if ($protocol == "ldap")
            {
                fwrite($r,"\x30\x1d\x02\x01\x01\x77\x18\x80\x16"."1.3.6.1.4.1.1466.20037");
                $response = fread($r, 512);
            }
            if ($protocol == "smtp")
            {
                $response = fread($r, 512);
                print "$response";

                fwrite($r,"HELO localhost.localdomain\r\n");
                $response = fread($r, 512);
                print $response;

                fwrite($r,"STARTTLS\r\n");
                $response = fread($r, 512);
                print "$response";
            }
            if ($protocol == "imap")
            {
                $response = fread($r, 512);
                print "$response";

                fwrite($r,"1 STARTTLS\r\n");
                $response = fread($r, 512);
                print "$response";
            }
            if ($protocol == "pop3")
            {
                $response = fread($r, 512);
                print "$response";

                fwrite($r,"STLS\r\n");
                $response = fread($r, 512);
                print "$response";
            }
            if ($protocol == "mysql")
            {
                fwrite($r,"\x20\x00\x00\x01\x85\xae\x7f\x00\x00\x00\x00\x01\x21\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00");
                $response = fread($r, 512);
            }
            if ($protocol == "pgsql")
            {
                fwrite($r,"\x00\x00\x00\x08\x04\xd2\x16\x2f");
                $response = fread($r, 512);
            }

            stream_set_blocking($r, true);
            stream_context_set_option($r, 'ssl', 'verify_peer', false);
            stream_context_set_option($r, 'ssl', 'capture_peer_cert', true);
            stream_context_set_option($r, 'ssl', 'capture_peer_cert_chain', true);
            $secure = stream_socket_enable_crypto($r, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            stream_set_blocking($r, false);
            $opts = stream_context_get_options($r);
            fclose($r);
            print("</pre>\n");
        }
        else
        {
            echo "! startTLS not implemented for $protocol<br><br>\n";
        }
    }
    else
    {
        $url = 'ssl://'.$host.":".$port;
        echo "Fetching SSL Cert from $url...<br>";

        $context = stream_context_create();
        $r = stream_context_set_option($context, "ssl", "verify_host", false);
        $r = stream_context_set_option($context, "ssl", "verify_peer", false);
        $r = stream_context_set_option($context, "ssl", "capture_peer_cert", true);
        $r = stream_context_set_option($context, "ssl", "capture_peer_cert_chain", true);

        if ($enablesni == "on")
        {
            $r = stream_context_set_option($context, 'ssl', 'SNI_server_name', $host);
            $r = stream_context_set_option($context, 'ssl', 'SNI_enabled', true);
        }
        else
        {
            $r = stream_context_set_option($context, 'ssl', 'SNI_enabled', false);
        }

        $r = stream_socket_client($url, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);
        if ($errno) { echo "! Error $errno: $errstr<br>\n"; } else { echo "Connected OK.<br>"; }
        if ($r) { $opts = stream_context_get_options($r); }
        else { $opts = stream_context_get_options($context); }
        echo "<br/>";
    }

    echo "<br>Parsing SSL Cert...<br/><hr>";

    if(isset($opts["ssl"]) && isset($opts['ssl']['peer_certificate']))
    {
        $ssl = openssl_x509_parse($opts['ssl']['peer_certificate']);
        print("subject: ");
        //array_walk($ssl["subject"], function($v,$k) { echo "/$k=$v", ""; });
        array_walk($ssl["subject"], 'printCertArray');
        print("<br>");
        print("issuer: ");
        //array_walk($ssl["issuer"], function($v,$k) { echo "/$k=$v", ""; });
        array_walk($ssl["issuer"], 'printCertArray');
        print("<br>");
        if(isset($ssl["extensions"]["subjectAltName"]))
        {
            print("subjectAltName: ");
            print($ssl["extensions"]["subjectAltName"]);
            print("<br>");
        }
        if(isset($ssl["extensions"]["basicConstraints"]))
        {
            print("basicConstraints: ");
            print($ssl["extensions"]["basicConstraints"]);
            print("<br>");
        }
        print("expires: ");
        print(date("D, d M Y", strtotime('20'.$ssl["validTo"])));
        print("<br>");
    }
    else
    {
        echo "! Could not parse peer certificate<br>";
    }

    echo "<br>";
    echo "<br>Parsing SSL Cert Chain...<br/><hr>";
    if(isset($opts["ssl"]) && isset($opts['ssl']['peer_certificate_chain']))
    {
        foreach ($opts['ssl']['peer_certificate_chain'] as $cert)
        {
            $ssl = openssl_x509_parse($cert);
            //var_dump($ssl);
            if (isset($ssl["subject"]))
            {
                print("subject: ");
                //array_walk($ssl["subject"], function($v,$k) { echo "/$k=$v", ""; });
                array_walk($ssl["subject"], 'printCertArray');
                print("<br>");
                print("issuer: ");
                //array_walk($ssl["issuer"], function($v,$k) { echo "/$k=$v", ""; });
                array_walk($ssl["issuer"], 'printCertArray');
                print("<br>");
                if(isset($ssl["extensions"]["subjectAltName"]))
                {
                    print("subjectAltName: ");
                    print($ssl["extensions"]["subjectAltName"]);
                    print("<br>");
                }
                if(isset($ssl["extensions"]["basicConstraints"]))
                {
                    print("basicConstraints: ");
                    print($ssl["extensions"]["basicConstraints"]);
                    print("<br>");
                }
                print("expires: ");
                print(date("D, d M Y", strtotime('20'.$ssl["validTo"])));
                print("<br>");
                print("signatureType: ");
                print($ssl["signatureTypeLN"]);
                print("<br>");
                if(isset($ssl["extensions"]["subjectKeyIdentifier"]))
                {
                    print("subjectKeyIdentifier: ");
                    print($ssl["extensions"]["subjectKeyIdentifier"]);
                    print("<br>");
                }
                if(isset($ssl["extensions"]["authorityKeyIdentifier"]))
                {
                    print("authorityKeyIdentifier: ");
                    print($ssl["extensions"]["authorityKeyIdentifier"]);
                    print("<br>");
                }
                print("<br>");
            }
            else
            {
                echo "! Invalid peer certificate chain<br>";
                break;
            }
        }
    }
    else
    {
        echo "! Could not parse peer certificate chain<br>";
    }
}
?>
</div>
</div>
</div>

<script type="text/javascript">
function protocolChanged()
{
    var protocol = document.getElementById('protocol');
    var port = document.getElementById('port');
    var tls = document.getElementById('tls');

    // console.log(tls.checked);
    // console.log(protocol.value);

    if (protocol.value === "http") {
        port.value = "443";
        if (tls.checked) { tls.checked = false; }
    }
    if (protocol.value === "ldap") { if (tls.checked) { port.value = "389"; } else { port.value = "636"; } }
    if (protocol.value === "ftp") { if (tls.checked) { port.value = "21"; } else { port.value = "990"; } }
    if (protocol.value === "smtp") { if (tls.checked) { port.value = "25"; } else { port.value = "465"; } }
    if (protocol.value === "imap") { if (tls.checked) { port.value = "143"; } else { port.value = "993"; } }
    if (protocol.value === "pop3") { if (tls.checked) { port.value = "110"; } else { port.value = "995"; } }
    if (protocol.value === "mysql") {
        port.value = "3306";
        if (!tls.checked) { tls.checked = true; }
    }
    if (protocol.value === "pgsql") {
        port.value = "5432";
        if (!tls.checked) { tls.checked = true; }
    }
    if (protocol.value === "rsyslog") {
        port.value = "6514";
        if (tls.checked) { tls.checked = false; }
    }
}
</script>

</body>
</head>
