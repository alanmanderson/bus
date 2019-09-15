<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
phpinfo();

echo("here");

class CURL {
    var $callback = false;
    var $secure = false;
    var $conn = false;
    var $cookiefile =false;

   
    function CURL($u) {
      global $debug;
        $this->conn = curl_init();
        if ($debug) {
            $this->cookiefile='f:/crawler/temp/'.md5($u);
        } else {
            $this->cookiefile='temp/'.md5($u);
        }
       
    }

    function setCallback($func_name) {
        $this->callback = $func_name;
    }

    function close() {
        curl_close($this->conn);
        /*if (is_file($this->cookiefile)) {
            unlink($this->cookiefile);
        } */
       
    }
   
   
    function doRequest($method, $url, $vars) {

        $ch = $this->conn;

        $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,$user_agent);

        if($this->secure) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        $data = curl_exec($ch);
        if ($data) {
            if ($this->callback)
            {
                $callback = $this->callback;
                $this->callback = false;
                return call_user_func($callback, $data);
            } else {
                return $data;
            }
        } else {
            return curl_error($ch);
        }
    }

    function get($url) {
        return $this->doRequest('GET', $url, 'NULL');
    }

    function post($url, $vars) {
        return $this->doRequest('POST', $url, $vars);
    }
}

$c = new CURL("");
echo $c->get("http://google.com");

echo http_get_request_body('http://google.com');

$r= new HttpResponse('http://google.com', HttpRequest::METH_GET);
$r->send () ;
echo $r->getResponseBody() ; 

echo("TESTING");


#
/**
#
* Access the HTTP Request
#
*/
#
class http_request {
#
 
#
/** additional HTTP headers not prefixed with HTTP_ in $_SERVER superglobal */
#
var $add_headers = array('CONTENT_TYPE', 'CONTENT_LENGTH');
#
 
#
/**
#
* Construtor
#
* Retrieve HTTP Body
#
* @param Array Additional Headers to retrieve
#
*/
#
function http_request($add_headers = false) {
#
 
#
$this->retrieve_headers($add_headers);
#
$this->body = @file_get_contents('php://input');
#
}
#
 
#
/**
#
* Retrieve the HTTP request headers from the $_SERVER superglobal
#
* @param Array Additional Headers to retrieve
#
*/
#
function retrieve_headers($add_headers = false) {
#
 
#
if ($add_headers) {
#
$this->add_headers = array_merge($this->add_headers, $add_headers);
#
}
#
 
#
if (isset($_SERVER['HTTP_METHOD'])) {
#
$this->method = $_SERVER['HTTP_METHOD'];
#
unset($_SERVER['HTTP_METHOD']);
#
} else {
#
$this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : false;
#
}
#
$this->protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : false;
#
$this->request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : false;
#
 
#
$this->headers = array();
#
foreach($_SERVER as $i=>$val) {
#
if (strpos($i, 'HTTP_') === 0 || in_array($i, $this->add_headers)) {
#
$name = str_replace(array('HTTP_', '_'), array('', '-'), $i);
#
$this->headers[$name] = $val;
#
}
#
}
#
}
#
 
#
/**
#
* Retrieve HTTP Method
#
*/
#
function method() {
#
return $this->method;
#
}
#
 
#
/**
#
* Retrieve HTTP Body
#
*/
#
function body() {
#
return $this->body;
#
}
#
 
#
/**
#
* Retrieve an HTTP Header
#
* @param string Case-Insensitive HTTP Header Name (eg: "User-Agent")
#
*/
#
function header($name) {
#
$name = strtoupper($name);
#
return isset($this->headers[$name]) ? $this->headers[$name] : false;
#
}
#
 
#
/**
#
* Retrieve all HTTP Headers
#
* @return array HTTP Headers
#
*/
#
function headers() {
#
return $this->headers;
#
}
#
 
#
/**
#
* Return Raw HTTP Request (note: This is incomplete)
#
* @param bool ReBuild the Raw HTTP Request
#
*/
#
function raw($refresh = false) {
#
 
#
if (isset($this->raw) && !$refresh) {
#
return $this->raw; // return cached
#
}
#
 
#
$headers = $this->headers();
#
$this->raw = "{$this->method}\r\n";
#
 
#
foreach($headers as $i=>$header) {
#
$this->raw .= "$i: $header\r\n";
#
}
#
 
#
$this->raw .= "\r\n{$http_request->body}";
#
 
#
return $this->raw;
#
}
#
 
#
}
#
 
#
/**
#
* Example Usage
#
* Echos the HTTP Request back to the client/browser
#
*/
#
 
#
$http_request = new http_request();
#
 
#
$resp = $http_request->raw();
#
echo nl2br($resp);
#
 $body = $http_request->body();
 
 echo $body;

echo("YEAH");
$body =  http_request('http://google.com');
echo $body;
$theData = '<?xml version="1.0"?>
<note>
    <to>php.net</to>
    <from>lymber</from>
    <heading>php http request</heading>
    <body>i love php!</body>
</note>';
$url = 'http://www.example.com';
$credentials = 'user@example.com:password';
$header_array = array('Expect' => '',
                'From' => 'User A');
$ssl_array = array('version' => SSL_VERSION_SSLv3);
$options = array(headers => $header_array,
                httpauth => $credentials,
                httpauthtype => HTTP_AUTH_BASIC,
                protocol => HTTP_VERSION_1_1,
                ssl => $ssl_array);
echo("here");               
//create the httprequest object               
$httpRequest_OBJ = new httpRequest($url, HTTP_METH_POST, $options);
//add the content type
$httpRequest_OBJ->setContentType = 'Content-Type: text/xml';
//add the raw post data
$httpRequest_OBJ->setRawPostData ($theData);
//send the http request
$result = $httpRequest_OBJ->send();
//print out the result
echo "<pre>"; print_r($result); echo "</pre>";
echo("here");
$r = new HttpRequest('http://www.clickteam.info/davidn/bus/index.php?routeId=1&dirId=1_010004v0_0&stopId=97&update=true', HttpRequest::METH_GET);
$r->setOptions(array('lastmodified' => filemtime('local.rss')));
$r->addQueryData(array('category' => 3));
try {
    $r->send();
    if ($r->getResponseCode() == 200) {
        echo($r->getResponseBody());
    }
} catch (HttpException $ex) {
    echo $ex;
}
echo("here");
?>