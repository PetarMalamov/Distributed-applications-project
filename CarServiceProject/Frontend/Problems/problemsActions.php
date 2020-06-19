<?php
session_start();
  switch ($_POST['ActSelc']) {
    case "1":
    //add problem
    $url = "http://localhost:44316/api/problems";
    $data = array(
      'Name'=>$_POST['Name'],
      'Duration'=>$_POST['Duration'],
      'Price'=>$_POST['Price'],
      'Descrioption'=>$_POST['Desc'],
      'CreatedOn'=>date("Y/m/d")
    );
        $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        header("Location: http://localhost/WebSite/Problems/problems.php?ActionIsSuccessful");
      break;
    case "2":
    // Update
    $id = $_POST['problems'];
    $data = array(
      "ProblemId"=>$id,
      'Name'=>$_POST['Name'],
      'Duration'=>$_POST['Duration'],
      'Price'=>$_POST['Price'],
      'Descrioption'=>$_POST['Desc'],
      'CreatedOn'=>date("Y/m/d")
    );
    $url = "http://localhost:44316/api/problems/".$id;
    $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    header("Location: http://localhost/WebSite/Problems/problems.php?ActionIsSuccessful");
      break;
      case "3":
      //delete problem
      $id = $_POST['problems'];
      $url = "http://localhost:44316/api/problems/".$id;
      $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      $result = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($ch);
      header("Location: http://localhost/WebSite/Problems/problems.php?ActionIsSuccessful");
        break;
    default:
      echo "error value is incorrect";
      break;
  }

 ?>
