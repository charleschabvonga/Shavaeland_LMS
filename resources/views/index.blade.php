<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shavaeland</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" media="min-width: 500px" href="min-500px.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <!--link href="/css/app.css" rel="stylesheet" type="text/css"-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
    @media(min-width: 500px){}

    body {
        font: 400 15px/1.8 Lato, sans-serif;
        color: #777;
    }
    h1 {
        margin: 25px 0 5px 0;
        letter-spacing: 10px;      
        font-size: 40px;
        color: #111;
    }
    h3, h4 {
        margin: 10px 0 30px 0;
        letter-spacing: 10px;      
        font-size: 30px;
        color: #CE8F64;
    }
    .container {
        padding: 50px 120px;
    }
    .person {
        border: 10px solid transparent;
        margin-bottom: 25px;
        width: 80%;
        height: 80%;
        opacity: 0.7;
    }
    .person:hover {
        border-color: #f1f1f1;
    }
    .carousel-inner img {
        -webkit-filter: grayscale(90%);
        filter: grayscale(90%); /* make all photos black and white */ 
        width: 100%; /* Set width to 100% */
        margin: auto;
    }
    .carousel-caption h3 {
        color: #CE8F64 !important;
    }
    .carousel-caption p {
        color: #CE8F64 !important;
    }
    @media (max-width: 600px) {
      .carousel-caption {
        display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
      }
    }
    .bg-1 {
        background: #2d2d2d;
        color: #CE8F64;
    }
    .bg-1 h3 {color: #fff;}
    .list-group-item:first-child {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .thumbnail {
        padding: 0 0 15px 0;
        border: none;
        border-radius: 0;
    }
    .thumbnail p {
        margin-top: 15px;
        color: #555;
    }
    .btn {
        padding: 10px 20px;
        background-color: #333;
        color: #f1f1f1;
        border-radius: 0;
        transition: .2s;
    }
    .btn:hover, .btn:focus {
        border: 1px solid #333;
        background-color: #fff;
        color: #000;
    }
    .modal-header, h4, .close {
        background-color: #333;
        color: #fff !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-header, .modal-body {
        padding: 40px 50px;
    }
    .nav-tabs li a {
        color: #777;
    }
    #map {
        width: 100%;
        height: 400px;
    }  
    .navbar {
        font-family: Montserrat, sans-serif;
        margin-bottom: 0;
        background-color: #2d2d30;
        border: 0;
        font-size: 11px !important;
        letter-spacing: 4px;
        opacity: 0.9;
    }
    .navbar li a, .navbar .navbar-brand { 
        color: #CE8F64 !important;
    }
    .navbar-nav li a:hover {
        color: #d5d5d5 !important;
    }
    .navbar-nav li.active a {
        color: #fff !important;
        background-color: #29292c !important;
    }
    .navbar-default .navbar-toggle {
        border-color: transparent;
    }
    .open .dropdown-toggle {
        color: #fff;
        background-color: #555 !important;
    }
    .dropdown-menu li a {
        color: #000 !important;
    }
    .dropdown-menu li a:hover {
        background-color: #808080 !important;
    }
    footer {
        background-color: #2d2d30;
        color: #f5f5f5;
        padding: 32px;
    }
    footer a {
        color: #f5f5f5;
    }
    footer a:hover {
        color: #777;
        text-decoration: none;
    }  
    .form-control {
        border-radius: 0;
    }
    textarea {
        resize: none;
    }
  </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            
          <ul class="nav navbar-nav navbar-left">
            <li><a href="#myCarousel"><img src="/images/logo.png" alt="logo"></a></li>
            <li><a href="#about">ABOUT US</a></li>
            <li><a href="#services">SERVICES</a></li>
            <li><a href="#team">TEAM</a></li>
            <li><a href="#contact">CONTACT</a></li>
          </ul>
        </div>
      </div>

      <div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/login">LOGIN</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>    

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        
      <div class="item active">
        <img src="/images/road.jpg" alt="RF" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="text-align:left">Road Freight</h3>
        </div>      
      </div>

      <div class="item">
        <img src="/images/air.jpg" alt="AF" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="text-align:right">Air Freight</h3>
        </div>      
      </div>
    
      <div class="item">
        <img src="/images/sea.jpg" alt="SF" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="text-align:left">Sea Freight</h3>
        </div>      
      </div>

      <div class="item">
        <img src="/images/rail.jpg" alt="RF" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="text-align:right">Rail Freight</h3>
        </div>      
      </div>

      <div class="item">
        <img src="/images/clearance.jpg" alt="CFS" width="1200" height="700">
        <div class="carousel-caption">
          <h3 style="text-align:left">Clearing and Forwarding</h3>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <h1 class="text-center">PERFORMANCE DRIVEN LOGISTICS</h1>

  <!-- Container (The About Us Section) -->
  <div id="about" class="container text-center">
    <h3>ABOUT US</h3>
    <p>SHAVAELAND international logistics solutions is a vibrant and dynamic South African company with a great vision for 
        transportation solutions. We believe in endless possibilities in terms of satisfying your transportation needs and 
        specialize in supplying quality freight services as well as advise our clients on what solutions are in the market 
        that suits their needs. It is our aim to be your below-the-line transporter of choice. We have gone to great lengths 
        to find credible sources of many of our solutions, both locally and abroad, so that our clients can enjoy a wide range 
        of services to choose from and give their clients and stakeholders something of value.</p>

    <div class="row text-center">
          <div class="col-sm-4">
            <div class="thumbnail">
              <!--<img src="images/mission.jpg"  alt="Values">-->
              <p><strong><span style="color:#CE8F64">Our Mission</span></strong></p>
              <p>Interpret our customers' vision,<br>to provide efficient and reliable<br>solution based services to our <br>global customers,based on mutual <br>trust and expertise.</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <!--<img src="images/vision.jpg"  alt="Values">-->
              <p><strong><span style="color:#CE8F64">Our Vision</span></strong></p>
              <p>To set the standards of excellence,<br>meet and exceed our clients’ <br>expectactations.
                To protect our clients' interests in the most<br> efficient and cost effective way.</p>
            </div>
          </div>
          <div class="col-sm-4">
                  
            <div class="thumbnail">
              <!--<img src="images/values.jpg"  alt="Values">-->
              <p><strong><span style="color:#CE8F64">Our Values</span></strong></p>
              <li>Versatility</li>
              <li>Quality</li>
              <li>Leadership</li>
              <li>Accountability</li>
              <li>Safety</li>
            </div>
          </div>
        </div>
        <p>VERSATILITY - <em>Willingness to accommodate needs above our own.</em></p>
  </div>

  <!-- Container (Services Section) -->
  <div id="services" class="bg-1">
    <div class="container">
      <h3 class="text-center"><span style="color:#CE8F64">OUR SERVICES<br><h6>Tailored logistic Services</h6><span></h3>
          <p>Road Freight<span style="color:white"> - We facilitate collection and deliveries of big or small cargo across the borders.</span></p>
      <hr>
          <p>Air Freight<span style="color:white"> - We facilitate all air freight shipping from anywhere in the world.</span></h2>
      <hr>
          <p>Sea Freight<span style="color:white"> - Container imports and exports from anywhere in the world. Full Container loads (FCL) or Less than container loads (LCL).</span></p>
      <hr>
          <p>Rail Freight<span style="color:white"> - We facilitate all rail freight from anywhere within the <abbr title="Southern African Development Community">SADC</abbr> region.</span></p>
      <hr>
          <p>Clearing and forwarding - <span style="color:white"> - We have various integrated services to meet customer logistical needs as well as cost effective transport and logistical systems solutions.</span></p>
      <hr>
    </div>
    <p class="text-center">QUALITY - <em>Delivering above standard and always striving for excellence.</em></p><br><br>
  </div>

  <!-- Container (Team Section) -->
  <div id="team" class="container">
      <h3 class="text-center">MEET OUR TEAM</h3>
      <br>
      <br>
      <div class="row text-center">
          <div class="col-sm-3">
              <div class="thumbnail">
              <img src="images/fungai.jpg" alt="Fungai">
              <p><strong>Fungai T.H. Nyagumbo</strong></p>
              <p>Executive Director</p>
              <a href="mailto:fungai@shavaeland.co.za">fungai@shavaeland.co.za</a>
              </div>
          </div>
          <div class="col-sm-3">
              <div class="thumbnail">
              <img src="images/topenya.jpg" alt="Topenya">
              <p><strong>Topenya Saurombe</strong></p>
              <p>Managing Director</p>
              <a href="mailto:topenya@shavaeland.co.za">topenya@shavaeland.co.za</a>
              </div>
          </div>
          <div class="col-sm-3">
              <div class="thumbnail">
              <img src="images/desmond.jpg" alt="Desmond">
              <p><strong>Desmond Nyagumbo</strong></p>
              <p>Operations Director</p>
              <a href="mailto:desmond@shavaeland.co.za">desmond@shavaeland.co.za</a>
              </div>
          </div>
          <div class="col-sm-3">
              <div class="thumbnail">
              <img src="images/hillary.jpg" alt="Hillary">
              <p><strong>Hillary Mubanga</strong></p>
              <p>Workshop Manager</p>
              <a href="mailto:hillary@shavaeland.co.za">hillary@shavaeland.co.za</a>
              </div>
          </div>
      </div>
  </div>

  <!-- Container (Contact Section) -->
  <div id="contact" class="container">
  <h3 class="text-center">CONTACT</h3>
      <div class="row">
          <div class="col-md-3">
              <p><span class="glyphicon glyphicon-map-marker"></span> 52 Lovemore Street<br> Boksburg<br>  Johannesburg<br> Gauteng<br>  South Africa</p>
              <p><span class="glyphicon glyphicon-phone"></span> +27 11 028 8791</p>
              <p><a href="mailto:info@shavaeland.co.za">info@shavaeland.co.za</a></P>
          </div>
          
          {!! Form::open(['url' => 'contact/submit']) !!}
          <div class="col-md-6">
              <div class="row">
                  <div class="col-sm-6 form-group">
                  <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                  </div>
                  <div class="col-sm-6 form-group">
                  <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                  </div>
              </div>
              <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5" required></textarea>
              <br>
              <div class="row">
                  <div class=" col-md-8 form-group text-center">
                      @if(session('success'))
                      <div class="alert alert-success col-md-12">
                          {{session('success')}}
                      </div>
                      @endif
                      <br>
                  </div>
                  <div class="col-md-4 form-group">
                  <button class="btn pull-right" type="submit">Send</button>
                  </div>
              </div>
          </div>
          {!! Form::close() !!}

          <div class="col-md-3">
              <p><span class="glyphicon glyphicon-time"></span> BUSINESS HOURS</p>
              <p class="pull-right">Monday: 8:00 AM - 5:00 PM<br>Tuesday: 8:00 AM - 5:00 PM<br>Wednesday: 8:00 AM - 5:00 PM<br>Thursday: 
                  8:00 AM - 5:00 PM<br>Friday: 8:00 AM - 3:00 PM<br>Saturday: Closed<br>Sunday: 9:00 AM - 1:00 PM<br></p>
          </div>
      </div>

      
      <p class="text-center">SAFETY - <em>Dedicating to ensure the safety and welfare of our employees, contractors, and our customers.</em></p>
  </div>

  <!-- Add Google Maps -->
  <div id="map"></div>

  

  <!-- Footer -->
  <footer class="text-center">
    <a class="up-arrow text-center" href="#myCarousel" data-toggle="tooltip" title="TO TOP">
      <span class="glyphicon text-center glyphicon-chevron-up"></span>
    </a>
      <p class="m-0 text-center text-white">Copyright &copy; 2018<a href="mailto:charles@shavaeland.co.za"> Shavaeland (Pty) Ltd</a></p>
  </footer>

  <script>
    $(document).ready(function(){
      // Initialize Tooltip
      $('[data-toggle="tooltip"]').tooltip(); 
      
      // Add smooth scrolling to all links in navbar + footer link
      
      $(".navbar a[href='/login'] .navbar a[href='#login'],.navbar [href='#myCarousel'], .navbar [href='#about'], .navbar [href='#services'], .navbar [href='#team'], .navbar [href='#contact'], footer a[href='#myCarousel']").on('click', function(event) {

        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 900, function(){
      
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      });
    })
  </script>

  <script>
    function initMap() {
        var shava = {lat:-26.181201,lng:28.237948}
        var map = new google.maps.Map(document.getElementById('map'), {zoom: 13, center: shava});
        var marker = new google.maps.Marker({position:{lat:-26.195190,lng:28.244759},map:map});
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeyCi_BIuwOI85DA8S_KyDIVHaVFn0wpk&callback=initMap"></script>
  <script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
