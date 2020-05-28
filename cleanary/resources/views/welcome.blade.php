<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href={{URL::to("js/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href={{URL::to("js/vendor/fontawesome-free/css/all.min.css")}} rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href={{URL::to("css/agency.css")}} rel="stylesheet">
     <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href={{URL::to("css/materialize.min.css")}} media="screen,projection" />
     

 
     
  

     
       
    </head>
    <body id="page-top">
        
           

           @include('include.toppage')
           
               @yield('body')
           
               
          
           

         
         <!-- Bootstrap core JavaScript -->
    <script src={{URL::to("js/vendor/jquery/jquery.min.js")}}></script>
    <script src={{URL::to("js/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>

    <!-- Plugin JavaScript -->
    <script src={{URL::to("js/vendor/jquery-easing/jquery.easing.min.js")}}></script>

    <!-- Contact form JavaScript -->
    <script src={{URL::to("js/jqBootstrapValidation.js")}}></script>
    <script src={{URL::to("js/contact_me.js")}}></script>

    <!-- Custom scripts for this template -->
    <script src={{URL::to("js/agency.min.js")}}></script>

    </body>
</html>
