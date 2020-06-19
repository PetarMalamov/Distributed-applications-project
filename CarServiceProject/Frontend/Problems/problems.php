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
    <div class="nav-wrapper" >
      <a href="products.php" class="brand-logo">Gelima</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="problems.php" class="active">Problems</a></li>
        <li><a href="../Clients/client.php">Clients</a></li>
        <li><a href="../Data/data.php">Data</a></li>
        <li><a href="../Session.php/?end">Log out</a></li>
      </ul>
    </div>
  </nav>
  <div id="info">
    <div class="row">
    <form class="col s12" action="problemsActions.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <select name="ActSelc" id="ActSelc">
            <option value="" disabled selected>Select action</option>
            <option value="1">Add</option>
            <option value="2">Update</option>
            <option value="3">Delete</option>
          </select>
        </div>
      </div>
      <div class="row Update">
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
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="Name" id="name" type="text" class="validate" maxlength="50">
          <label for="name">Name</label>
        </div>
        <div class="input-field col s6">
          <input name="Duration" id="Duraton" type="number" class="validate">
          <label for="Duraton">Duration</label>
        </div>
      </div>
      <div class="row Delete">
        <div class="input-field col s6">
          <input name="Price" id="Price" type="number" class="validate">
          <label for="Price">Price</label>
        </div>
        <div class="input-field col s6">
          <input name="Desc" id="Description" type="text" class="validate" maxlength="150">
          <label for="Description">Description</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <div class="right">
          <button id="btn" class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
        </div>
      </div>
      </div>
    </form>
  </div>
  </div>
  <script type="text/javascript">
  if ($('#Price').val()<0) {
    $('#btn').disabled = false;
  }else{
    $('#btn').disabled = false;
  }
  if (window.location.href.indexOf('?ActionIsSuccessful') > 0) {
     alert("action is successful");
  }
    document.getElementById("btn").disabled = true;
    $('.Update').hide();
    $("#ActSelc").change(function(){
      document.getElementById("btn").disabled = false;
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
         $('select').formSelect();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, options);

      });

  </script>
  </body>
</html>
