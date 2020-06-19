<?php
  session_start();
  $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
    switch ($_POST['ActionSelect']) {
      case '1':
        //add new car and client
        //urls
        $Carsurl = "http://localhost:44316/api/cars";
        $Clientsurl = "http://localhost:44316/api/Clients";
        $CarIdUrl = "http://localhost:44316/api/cars?name=".$_POST['Carname'];

        //add car
        $CarData = array(
          'Name'=>$_POST['Carname'],
          'Model'=>$_POST['CarModel'],
          'BuildOn'=>$_POST['BuildOn'],
          'HP'=>$_POST['HP'],
          'RecNumber'=>$_POST['RecNumber'],
          'ProblemId'=>$_POST['problems']
        );
          PostRequst($Carsurl,$CarData);

          //get the id of the Car
          $curl = curl_init($CarIdUrl);
          curl_setopt($curl,CURLOPT_URL,$CarIdUrl);
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          $json_response = curl_exec($curl);
          $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          curl_close($curl);
          $id = $json_response;
            //create Client
            $ClientData = array(
              'Fname'=>$_POST['FNAME'],
              'Lname'=>$_POST['Lname'],
              'email'=>$_POST['Email'],
              'ClientSince'=>date("Y/m/d"),
              'CarId'=>$id
            );
            PostRequst($Clientsurl,$ClientData);
        break;
      case '2':
      //Update
          $ids = $_POST['clientsDd'];
          $ids = explode(':',$ids);
          $CarData=array(
            'CarId'=>$ids[1],
            'Name'=>$_POST['Carname'],
            'Model'=>$_POST['CarModel'],
            'BuildOn'=>$_POST['BuildOn'],
            'HP'=>$_POST['HP'],
            'RecNumber'=>$_POST['RecNumber'],
            'ProblemId'=>$_POST['problems']
          );
          $ClientData = array(
            'ClientId'=>$ids[0],
            'Fname'=>$_POST['FNAME'],
            'Lname'=>$_POST['Lname'],
            'email'=>$_POST['Email'],
            'ClientSince'=>date("Y/m/d"),
            'CarId'=>$ids[1]
          );
          $url = "http://localhost:44316/api/cars/".$ids[1];
          PutRequst($url,$CarData);

          $url = "http://localhost:44316/api/Clients/".$ids[0];
          PutRequst($url,$ClientData);
          break;
      case '3':
          //delete car and client
          $ids = $_POST['clientsDd'];
          $ids = explode(':',$ids);
          $url = "http://localhost:44316/api/cars/".$ids[1];
          DeleteRequst($url);
            break;
      default:
        // code...
        break;
    }
      header("Location: http://localhost/WebSite/Clients/client.php?ActionIsSuccessful");
      function PostRequst($url,$data){
        global $headers;
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
      }

      function PutRequst($url,$data){
        global $headers;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        echo $status;
        curl_close($curl);
      }

      function DeleteRequst($url){
        global $headers;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($ch);
      }

 ?>
