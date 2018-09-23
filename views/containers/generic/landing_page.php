<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coming Soon - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="../../../assets/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../../../assets/css/coming-soon.min.css" rel="stylesheet">

  </head>

  <body>

    <div class="overlay" style="background-color:orange"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="../../../assets/mp4/bg.mp4" type="video/mp4">
    </video>

    <div class="masthead">
      <div class="masthead-bg" style="background-color:#36688D;opacity:1!important"></div>
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-12 my-auto">
            <div class="masthead-content text-white py-5 py-md-0">
              <h1 class="mb-3">Welcome!</h1>
              <p class="mb-5">We're working hard to finish the development of this site. Our target launch date is
              <br>
                Choose from over <strong><a href="../visitors/view_products.php" style="color:white;text-decoration:underline ">1000 live stock products</a> </strong>!</p>
              <div style="text-align:center;">
                <input id="username" style="margin:5px;" type="text" class="form-control" placeholder="Enter Username">
                <input id="password" style="margin:5px;" type="password" class="form-control" placeholder="Enter Password">
                <input style="margin:5px;" type="button" class="form-control btn btn-primary" value="Login" onclick="login()">
                No account sign up <a href="./registration.php">here</a>!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="social-icons">
      <ul class="list-unstyled text-center mb-0">
        <li class="list-unstyled-item">
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="list-unstyled-item">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="list-unstyled-item">
          <a href="#">
            <i class="fab fa-instagram"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="../../../assets/js/jquery.3.2.1.min.js"></script>
    <script src="../../../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../../../assets/js/coming-soon.min.js"></script>

    <script>
        function login(){
          var username = $('#username').val();
          var password = $('#password').val();
          $.ajax({
              method: 'post',
              url: "../../../controllers/generic/login.php",
              data: {Username: username, Password: password},
              success: function(result){
                  var jsonResult = JSON.parse(result);
                  if(jsonResult.Status=='Success Buyer Account'){
                      window.location.href="../../../views/containers/customers/";
                  }else{
                    if(jsonResult.Status=='Success Subscriber Account'){
                      window.location.href="../../../views/containers/subscribers/";
                    }else{
                      if(jsonResult.Status == 'Already Logged In'){
                        window.location.href="../../../";
                      }else{
                        alert(jsonResult.Status)
                      }
                    }
                  }
              },
              fail: function(result){
                  console.log(result);
              }
          });
        }
      </script>
  </body>

</html>
