<?php
  session_start();
  $user = $_POST['UserName'];
  $pwd = $_POST['pwd'];
  $url = "http://localhost:44316/token";

  $data = array (
        'grant_type' => 'password',
        'username' => $user,//'petar99.77@abv.bg',
        'password' => $pwd//'Testtt123.'
        );
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
      $curl = curl_init($url);
      curl_setopt($curl,CURLOPT_URL,$url);
      curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $json = json_decode($json_response,true);
      if (isset($json['access_token'])) {
        $_SESSION['token'] = $json['access_token'];
        header("Location: http://localhost/WebSite/Clients/client.php");
      }else {
        header("Location: http://localhost/WebSite/?loginError");
      }

      // $curl = curl_init();
      // curl_setopt($curl, CURLOPT_POST, 1);
      // curl_setopt($curl, CURLOPT_URL, $url);
      // $headers[] = 'Content-Type: application/x-www-form-urlencoded';
      // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
      //  'Username' => 'petar99.77@abv.bg',
      //  'Password' => 'Testtt123.',
      //  'grant_type' => 'password'
      // )));
      // $result = curl_exec($curl);
      // curl_close($curl);
      // echo $result;
 ?>
