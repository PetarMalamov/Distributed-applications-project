<?php
session_start();
if(isset($_REQUEST['action']) && $_REQUEST['action']=="search"){
    header('Content-Type: application/json');
    $url = "http://localhost:44316/api/problems?name=".$_REQUEST["value"];

    $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $json_response = curl_exec($curl);
    $json = json_decode($json_response,true);

  curl_close($curl);

  echo $json_response;
  exit();

}
if (isset($_REQUEST['action']) && $_REQUEST['action'] =="HPsearch") {
  header('Content-Type: application/json');

  $url ="http://localhost:44316/api/Cars?hp=".$_REQUEST["value"];

  $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
  $curl = curl_init($url);
  curl_setopt($curl,CURLOPT_URL,$url);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  $json_response = curl_exec($curl);
  $json = json_decode($json_response,true);

curl_close($curl);

echo $json_response;
exit();
}
if (isset($_REQUEST['action']) && $_REQUEST['action']=="last_nameSearch") {
  header('Content-Type: application/json');
  $url = "http://localhost:44316/api/Clients?Lname=".$_REQUEST["value"];

  $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
  $curl = curl_init($url);
  curl_setopt($curl,CURLOPT_URL,$url);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  $json_response = curl_exec($curl);
  $json = json_decode($json_response,true);

curl_close($curl);

echo $json_response;
exit();
}
