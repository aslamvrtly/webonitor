<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function checkDomainDetails($website){
    $details = [];
    $website = str_replace('https://', '', $website);
    $website = str_replace('http://', '', $website);
    $output = shell_exec('whois ' . escapeshellarg($website));
    if($output){
        if(preg_match('/Registry Expiry Date: (.+)/i', $output, $matches1)){
        $details["expiry"] = strtotime($matches1[1]);
        }
        if(preg_match_all('/Name Server: (.+)/i', $output, $matches)){
        $details["expiry"] = strtotime($matches1[1]);
        }
        return $details;
    }else{
        return ['status' => 'failed'];
    }
}

function checkSSL($domain) {
    $domain = str_replace('https://', '', $domain);
    $domain = str_replace('http://', '', $domain);

    $g = stream_context_create(array("ssl" => array("capture_peer_cert" => true)));
    $r = stream_socket_client("ssl://$domain:443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $g);
    if ($r) {
        $cont = stream_context_get_params($r);
        $cert = openssl_x509_parse($cont["options"]["ssl"]["peer_certificate"]);
        return $cert;
    } else {
        return ['status' => 'Not Secured']; // SSL check failed
    }
}

function checkWebsiteStatus($website){
    $curl = curl_init($website);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if($httpCode >= 200 && $httpCode < 400){
        return true;
    }else{
        return false;
    }
}

if (isset($_GET['domain']) && isset($_GET["is_dns"])) {
    $domain = $_GET['domain'];
    $domain = str_replace('https://', '', $domain);
    $domain = str_replace('http://', '', $domain);
    $domain = str_replace('www.', '', $domain);

    $dns = [];
    $types = [DNS_A, DNS_AAAA, DNS_MX, DNS_TXT, DNS_CNAME, DNS_CAA];
    $type_names = [
        DNS_A => 'A',
        DNS_AAAA => 'AAAA',
        DNS_MX => 'MX',
        DNS_TXT => 'TXT',
        DNS_CNAME => 'CNAME',
        DNS_CAA => 'CAA',
    ];
    
    foreach ($types as $type) {
        if(checkdnsrr($domain, $type_names[$type])){
            $dns_records = dns_get_record($domain, $type);
            $dns = array_merge($dns, $dns_records);
        }
    }

    if(checkdnsrr("www." . $domain, "CNAME")){
        $dns_records = dns_get_record("www." . $domain, DNS_CNAME);
        $dns = array_merge($dns, $dns_records);
    }
    
    echo json_encode($dns);
}

if (isset($_GET['domain']) && isset($_GET["is_status"])) {
    $domain = $_GET['domain'];
    if($domain != ""){
        echo checkWebsiteStatus($domain);
    }else{
        echo 'Domain is invalid';
    }
}

if (isset($_GET['domain']) && isset($_GET["is_domain"])) {
    $domain = $_GET['domain'];
    if($domain != ""){
        $dom = checkDomainDetails($domain);
        $dom['status'] = "success";
    }else{
        $dom = ['status' => 'failed'];
    }
    echo json_encode($dom);
}

if (isset($_GET['domain']) && isset($_GET["is_ssl"])) {
    $domain = $_GET['domain'];
    if($domain != ""){
        $cert = checkSSL($domain);
        $cert['status'] = "Secured";
    }else{
        $cert = ['status' => 'Not Secured'];
    }
    echo json_encode($cert);
}

?>