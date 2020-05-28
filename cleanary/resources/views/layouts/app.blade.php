
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') </title>



        

    
</head>
<body>
 
     <div id="">
            
            <div class="row">
                @yield('content')
            </div>

        
            

       
   
    </div>
     <!-- Portfolio Modals -->

       <!-- jQuery -->
    <script src={{URL::to("js/dashvendor/jquery/jquery.min.js")}}></script>

    <!-- Bootstrap Core JavaScript -->
    <script src={{URL::to("js/dashvendor/bootstrap/js/bootstrap.min.js")}}></script>

         <!-- jQuery -->
  

    <!-- Metis Menu Plugin JavaScript -->
    <script src={{URL::to("js/dashvendor/metisMenu/metisMenu.min.js")}}></script>

    <!-- Morris Charts JavaScript -->
    <script src={{URL::to("js/dashvendor/raphael/raphael.min.js")}}></script>
    <script src={{URL::to("js/dashvendor/morrisjs/morris.min.js")}}></script>
    <script src={{URL::to("js/data/morris-data.js")}}></script>

    <!-- Custom Theme JavaScript -->
    <script src={{URL::to("js/dist/js/sb-admin-2.js")}}></script>
   <script type="text/javascript" src={{URL::to("js/main/main.js")}}></script>
</body>
</html>
