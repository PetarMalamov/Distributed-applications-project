<?php
include  '../Session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Gelima</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../Clients/clientsStyle.css">
  </head>
  <body>
  <nav id="nav">
    <div class="nav-wrapper">
      <a href="../Data/data.php" class="brand-logo">Gelima</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="../Problems/problems.php">Problems</a></li>
        <li><a href="../Clients/client.php">Clients</a></li>
        <li><a href="../Data/data.php" class="active">Data</a></li>
        <li><a href="../Session.php/?end">Log out</a></li>
      </ul>
    </div>
  </nav>
    <div id="info">
        <div class="row">
          <div class="input-field col s12">
            <select name="Selects" id="Selects" class="Selects">
              <option value="" disabled selected>Select action</option>
              <option value="1">Problems</option>
              <option value="2">Cars</option>
              <option value="3">Clients</option>
            </select>
          </div>
        </div>
      <div class="row ProblemsTable">
        <div class="col s12" >
          <div class="row">
            <div class="right">
              <div class="input-field col s6">
                <input id="NameSearch" type="text" class="validate" name="NameSearch">
                <label for="email">Name</label>
              </div>
              <div class="input-field col s6">
                <a  class="waves-effect waves-light btn" id="search">Search</a>
              </div>
            </div>
          </div>
        </div>
        <table id="Content">
          <thead>
            <tr>
                <th class="order" data-order="order_id">Name</th>
                <th class="order" data-order="client_id">Duration(minutes)</th>
                <th class="order" data-order="product_id">Price</th>
                <th class="order" data-order="quantity">Description</th>
            </tr>
          </thead>
          <?php

            $url = "http://localhost:44316/api/problems";
            $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
            $curl = curl_init($url);
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $json_response = curl_exec($curl);
            $json = json_decode($json_response,true);
            foreach ($json as $json){
              echo "<tr><td>" .$json['Name']."</td><td>".$json['Duration']. "</td><td>" .$json['Price']. "</td><td>".$json['Descrioption']."</td></tr>";
            }
          curl_close($curl);?>
        </table>
      </div>
      <div class="row CarsTable">
        <div class="col s12" >
          <div class="row">
            <div class="right">
              <div class="input-field col s6">
                <input id="HPSearch" type="text" class="validate" name="HPSearch">
                <label for="email">HP</label>
              </div>
              <div class="input-field col s6">
                <a  class="waves-effect waves-light btn" id="HorsepowerSearch">Search</a>
              </div>
            </div>
          </div>
        </div>
        <table id="Content2">
          <thead>
            <tr>
                <th class="order" data-order="order_id">Name</th>
                <th class="order" data-order="client_id">Model</th>
                <th class="order" data-order="product_id">RecNumber</th>
                <th class="order" data-order="quantity">HP</th>
                <th class="order" data-order="quantity">BuildOn</th>
                <th class="order" data-order="quantity">ProblemId</th>
            </tr>
          </thead>
          <?php

            $url = "http://localhost:44316/api/Cars";
            $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
            $curl = curl_init($url);
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $json_response = curl_exec($curl);
            $json = json_decode($json_response,true);

            foreach ($json as $oneJson){

              echo "<tr><td>" .$oneJson['Name']."</td><td>".$oneJson['Model']. "</td><td>" .$oneJson['BuildOn']. "</td><td>".$oneJson['HP']."</td><td>".$oneJson['RecNumber']."</td><td>".$oneJson['ProblemId']."</td></tr>";
            }
          curl_close($curl);?>
        </table>
      </div>
      <div class="row ClientsTable">
        <div class="col s12" >
          <div class="row">
            <div class="right">
              <div class="input-field col s6">
                <input id="last_nameSearch" type="text" class="validate" name="last_nameSearch">
                <label for="email">Last name</label>
              </div>
              <div class="input-field col s6">
                <a  class="waves-effect waves-light btn" id="LNAMEsearch">Search</a>
              </div>
            </div>
          </div>
        </div>
        <table id="Content3">
          <thead>
            <tr>
                <th class="order" data-order="order_id">First name</th>
                <th class="order" data-order="client_id">Last name</th>
                <th class="order" data-order="product_id">Email</th>
                <th class="order" data-order="quantity">ClientsSince</th>
                <th class="order" data-order="quantity">CarId</th>
            </tr>
          </thead>
          <?php

            $url = "http://localhost:44316/api/Clients";
            $headers[] = 'Authorization: bearer ' .$_SESSION['token'];
            $curl = curl_init($url);
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,4);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $json_response = curl_exec($curl);
            $json = json_decode($json_response,true);
            foreach ($json as $json){
              echo "<tr><td>" .$json['Fname']."</td><td>".$json['Lname']. "</td><td>" .$json['email']. "</td><td>".$json['ClientSince']."</td><td>".$json['CarId']."</td></tr>";
            }
          curl_close($curl);?>
        </table>
      </div>
    </div>
    <script>
    $(document).ready(function(){
        $('.ProblemsTable').hide();
         $('.CarsTable').hide();
         $('.ClientsTable').hide();
         $('.Selects').change(function(){
           if ($(this).val()==1) {
             $('.ProblemsTable').show();
             $('.CarsTable').hide();
             $('.ClientsTable').hide();
           }
           if ($(this).val()==2) {
             $('.CarsTable').show();
             $('.ProblemsTable').hide();
             $('.ClientsTable').hide();
           }
           if ($(this).val()==3) {
            $('.ProblemsTable').hide();
            $('.CarsTable').hide();
            $('.ClientsTable').show();
           }
         });
    });

    $(document).ready(function(){
         $('select').formSelect();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
      });

    $(document).ready(function(){
      $("#search").click(function(e){
        e.preventDefault();
        if($("#NameSearch").val()!=""){
          $("#Content tr").not(":first").remove();
          $.post( "actions.php",{action:"search",value:$("#NameSearch").val()}, function( data ) {
          //  console.log(data);

            $.each(data, function( index, value ) {
              $("#Content").append(`<tr><td>`+value.Name+`</td><td>`+value.Duration+`</td><td>`+value.Price+`</td><td>`+value.Descrioption+`</td></tr>`);

            });
          });

        }
      });

      $("#HorsepowerSearch").click(function(e){
        e.preventDefault();
        if($("#HPSearch").val()!=""){
          $("#Content2 tr").not(":first").remove();
          $.post( "actions.php",{action:"HPsearch",value:$("#HPSearch").val()}, function( data ) {
          //  console.log(data);

            $.each(data, function( index, value ) {
              $("#Content2").append(`<tr><td>`+value.Name+`</td><td>`+value.Model+`</td><td>`+value.BuildOn+`</td><td>`+value.HP+`</td><td>`+value.RecNumber+`</td><td>`+value.ProblemId+`</td></tr>`);

            });
          });

        }
      });

      $("#LNAMEsearch").click(function(e){
        e.preventDefault();
        if($("#last_nameSearch").val()!=""){
          $("#Content3 tr").not(":first").remove();
          $.post( "actions.php",{action:"last_nameSearch",value:$("#last_nameSearch").val()}, function( data ) {
          //console.log(data);

            $.each(data, function( index, value ) {
              $("#Content3").append(`<tr><td>`+value.Fname+`</td><td>`+value.Lname+ `</td><td>`+value.email+ `</td><td>`+value.ClientSince+`</td><td>`+value.CarId+`</td></tr>`);

            });
          });

        }
      });
  });
    </script>
  </body>
</html>
