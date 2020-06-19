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
    <link rel="stylesheet" href="clientsStyle.css">
  </head>
  <body>
 <nav id="nav">
    <div class="nav-wrapper" >
      <a href="products.php" class="brand-logo">Gelima</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="../Problems/problems.php">Problems</a></li>
        <li><a href="client.php" class="active">Clients</a></li>
        <li><a href="../Data/data.php">Data</a></li>
        <li><a href="../Session.php/?end">Log out</a></li>
      </ul>
    </div>
  </nav>
  <div id="info">
    <div class="row">
    <form class="col s12" action="ClientsAction.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <select name="ActionSelect" id="ActSelc">
            <option value="" disabled selected>Select action</option>
            <option value="1">Add</option>
            <option value="2">Update</option>
            <option value="3">Delete</option>
          </select>
        </div>
      </div>
      <div class="row Update">
        <div class="input-field col s12">
          <select name="clientsDd">
            <option value="" disabled selected>Select client</option>
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
              foreach ($json as $json) :?>
            <option value='<?php echo $json['ClientId'].":".$json['CarId']?>'><?php echo $json['Fname']." ".$json['Lname']?></option>
            <?php endforeach;
            curl_close($curl);?>
          </select>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="FNAME" id="first_name" type="text" class="validate" maxlength="50">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input name="Lname" id="last_name" type="text" class="validate" maxlength="50">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="Email" id="email" type="email" class="validate" maxlength="70">
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input name="Carname" id="Carname" type="text" class="validate" maxlength="50">
          <label for="last_name">Car Name</label>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="CarModel" id="CarModel" type="text" class="validate" maxlength="50">
          <label for="email">Car Model</label>
        </div>
        <div class="input-field col s6">
          <input name="BuildOn" type="text" class="datepicker">
          <label for="last_name">Build on</label>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="HP" id="HP" type="number" class="validate" maxlength="4">
          <label for="email" >Horsepower</label>
        </div>
        <div class="input-field col s6">
          <input name="RecNumber" id="RecNumber" type="text" class="validate" maxlength="8">
          <label for="last_name">registration numbers</label>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s12">
          <select name="problems">
            <option value="" disabled selected>Select problem</option>
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
              foreach ($json as $json) :?>
            <option value='<?php echo $json['ProblemId']?>'><?php echo $json['Name']?></option>
            <?php endforeach;
            curl_close($curl);?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <div class="right">
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
        </div>
      </div>
      </div>
    </form>
  </div>
  </div>
  <script type="text/javascript">
  if (window.location.href.indexOf('?ActionIsSuccessful') > 0) {
     alert("action is successful");
  }else if (window.location.href.indexOf('?ActionIsNOTSuccessful') > 0) {
    alert("action is NOT successful");
  }
    $('.Update').hide();
    $("#ActSelc").change(function(){
      $('.Update').hide();
      $('.Delete').show();
      if ($(this).val()==2) {
        $('.Update').show();
      }
      if ($(this).val()==3) {
        $('.Update').show();
        $('.Delete').hide();
      }
    });

    $(document).ready(function(){
     $('.datepicker').datepicker();
         $('select').formSelect();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, options);

        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
      });

  </script>
  </body>
</html>
