<?php

include 'iCalClass2.php';
include 'iCalExtendIcs.php';
include 'assets/calendars.php';
$dispo = NULL;
if ($_POST && $_POST['t-start'] && $_POST['t-end']) {

  $dateStart = $_POST['t-start'];
  $dateEnd = $_POST['t-end'];

  $obj = new icalExtendIcs();


  //var_dump($obj->MyBetwennDates(FILE1, $dateStart, $dateEnd),$obj->MyBetwennDates(FILE2, $dateStart, $dateEnd));
  $dispo = $obj->getDispo(FILE1, FILE2, $dateStart, $dateEnd);

  if ($dispo) {
    $dispo = '<div class="alert alert-success" role="alert">data ' .date_format(date_create($dateStart), 'd-M-Y') . ' / '  .date_format(date_create($dateEnd), 'd-M-Y') .' <strong>disponivel para CASA 1</strong></div>';
  } else {
    $dispo .= '<div class="alert alert-danger">data' .date_format(date_create($dateStart), 'd-M-Y') . ' / '  .date_format(date_create($dateEnd), 'd-M-Y') .' <strong>NÃO DISPONIVEL para casa 1</strong></div>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Favicons -->
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="assets/theme/css/t-datepicker.min.css">
  <link rel="stylesheet" href="assets/theme/css/themes/t-datepicker-orange.css">




  <style>
    .link {
      clear: both;
      padding-top: 20px;
    }

    .error-null {
      color: red;
      margin-top: 15px;
    }

    .check-validator {
      margin-left: 10px;
    }

    .btn-check-validator {
      margin-left: 10px;
    }

    .dispo {

      margin-bottom: 100px;
      padding: 30px;
      box-shadow: 2px 2px 11px 7px rgba(0, 0, 0, 0.1);
     background-color: #f8f9fa;
    }
    .top {
      background-image: url('images/1.jpg');
      height:100va;
      padding: 20px;
  

    }

    .album {

      background-color: #f8f9fa !important;
    }


    @media (max-width: 980px) {

      .btn-check-validator {
        margin-top: 30px;

      }

      .dispo {
        text-align: center;


      }

    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Top navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  
    <!-- Set up your HTML -->
    <div class="container top">
      <h1> Minha casinha </h1>
 <div class=" clearfix dispo">
  <h4> Ver desponibilidade </h4>
      <form action="index4.php" method="POST">
        <div class="t-datepicker check-validator input-group">
          <div class="t-check-in"></div>
          <div class="t-check-out"></div>
        </div>
        <input class="btn btn-info btn-check-validator" type="submit" value="Submit" />
      </form>
    </div>

    </div>
   

    <!--//-->
    <div class="album py-5 bg-light">
      <div class="container">


        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
              
            
              <img src="images/1.jpg" alt="image">
              <div class="card-body">
                <h4> Casa 1</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
                <?= $dispo; ?>
              </div>
            </div>
          </div>

          <!--//-->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>

          <!--//-->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>




</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="assets/theme/js/t-datepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.t-datepicker').tDatePicker({
      valiDation: false // default 
    })
    $('.btn-check-validator').on('click', function(e) {
      var getDateInputs = $('.check-validator').tDatePicker('getDateInputs')
      getDateInputs.map(function(el) {
        if (el === null) {
          e.preventDefault();
          return;
        }
      })
      var errorNull = $('.error-null').length
      if (errorNull === 0) {
        if (getDateInputs[0] === null) {
          $("<p class='.check-validator error-null'>Please fill out this field Check-In</p>").appendTo(".check-validator .t-date-check-in");
        }
        if (getDateInputs[1] === null) {
          $("<p class='.check-validator error-null'>Please fill out this field Check-Out</p>").appendTo(".check-validator .t-date-check-out");
        }
      }

    })
  })
</script>
</body>

</html>