<?php 

session_start();

if($_SESSION['status']!= 'login'){
    header("Location:login.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Bidan Ny.Lathoifah</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css?v=1.2.1" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" /> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <style>
        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url(material-icons/iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
            src: local('Material Icons'),
                 local('MaterialIcons-Regular'),
                 url(material-icons/iconfont/MaterialIcons-Regular.woff2) format('woff2'),
                 url(material-icons/iconfont/MaterialIcons-Regular.woff) format('woff'),
                 url(material-icons/iconfont/MaterialIcons-Regular.ttf) format('truetype');
        }

        .material-icons {
          font-family: 'Material Icons';
          font-weight: normal;
          font-style: normal;
          font-size: 24px;  /* Preferred icon size */
          display: inline-block;
          line-height: 1;
          text-transform: none;
          letter-spacing: normal;
          word-wrap: normal;
          white-space: nowrap;
          direction: ltr;
        
          /* Support for all WebKit browsers. */
          -webkit-font-smoothing: antialiased;
          /* Support for Safari and Chrome. */
          text-rendering: optimizeLegibility;
        
          /* Support for Firefox. */
          -moz-osx-font-smoothing: grayscale;
        
          /* Support for IE. */
          font-feature-settings: 'liga';
        }
        /* Rules for sizing the icon. */
        .material-icons.md-18 { font-size: 18px; }
        .material-icons.md-24 { font-size: 24px; }
        .material-icons.md-36 { font-size: 36px; }
        .material-icons.md-48 { font-size: 48px; }

        /* Rules for using icons as black on a light background. */
        .material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
        .material-icons.md-dark.md-inactive { color: rgba(0, 0, 0, 0.26); }

        /* Rules for using icons as white on a dark background. */
        .material-icons.md-light { color: rgba(255, 255, 255, 1); }
        .material-icons.md-light.md-inactive { color: rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body onload='coba()'>
    <div class="wrapper">
        <?php include ('sidebar.php');?>
        <div class="main-panel">
            <?php include ('navbar.php');?>
            <div class="content">
                <div class="container-fluid"><?php include ('kerangka.php'); ?></div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<script src="assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/arrive.min.js" type="text/javascript"></script>
<!-- Forms Vaations Plugin -->
<script src="assets/js/jquery.validate.min.js"></script>
<!--  Plugin  Date Time Picker and Full Calendar Plugin-->
<script src="assets/js/moment.min.js"></script>
<!--  Charts gin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="assets/js/chartist.min.js"></script>
<!--  Plugin  the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/jquery.bootstrap-wizard.js"></script>
<!--  Notificons Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Plugin  the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Mplugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/js/jquery-jvectormap.js"></script>
<!-- Sliders gin, full documentation here: https://refreshless.com/nouislider/ -->
<!-- <script src="assets/js/nouislider.min.js"></script>
<!-  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>  -->
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/jquery.select-bootstrap.js"></script>
<!--  DataTab.net Plugin, full documentation here: https://datatables.net/    -->
<script src="assets/js/jquery.datatables.js"></script>
<!-- Sweet Al 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="assets/js/sweetalert2.js"></script>
<!-- Plugin fFileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/jasny-bootstrap.min.js"></script>
<!--  Full Cadar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/js/fullcalendar.min.js"></script>
<!-- Plugin fTags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/jquery.tagsinput.js"></script>
<!-- Materialshboard javascript methods -->
<script src="assets/js/material-dashboard.js?v=1.2.1"></script>
<!-- Materialshboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });
</script>
<script>
    function coba(){
        var param = getUrlVars('url');
        function getUrlVars(param=null){
	        if(param !== null)
	        {
	        	var vars = [], hash;
	        	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	        	for(var i = 0; i < hashes.length; i++)
	        	{
	        		hash = hashes[i].split('=');
	        		vars.push(hash[0]);
	        		vars[hash[0]] = hash[1];
	        	}
	        	return vars[param];
	        } 
	        else 
	        {
	        	return null;
	        }
        }
        console.log(param);
        if(param == null){
            $("#dashboard").addClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }else if(param == 'home'){
            $("#dashboard").addClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }else if(param == 'pegawai'){
            $("#dashboard").removeClass("active");
            $("#pegawai").addClass("active");                
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pendaftaran'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").addClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').addClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').addClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pendaftaran-tambah'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").addClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').addClass('active');
            $('#componentsExamples').addClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pembayaran'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").addClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'ubah'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').addClass('active');
            $('#collapseExample').addClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').removeClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").removeClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pasien-umum'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').addClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").addClass("active");
            $("#pasien-umum").addClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pasien-hamil'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').addClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").addClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").addClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'detail-pasien'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').addClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").addClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").addClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pasien-kb'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').addClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").addClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").addClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").removeClass("active");
        }
        else if(param == 'pasien-imunisasi'){
            $("#dashboard").removeClass("active");
            $("#pegawai").removeClass("active");
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
            $('#pasien-sidebar').addClass('in');
            $('#pendaftaran-list').removeClass('active');
            $("#pasien").addClass("active");
            $("#pasien-umum").removeClass("active");
            $("#pasien-kb").removeClass("active");
            $("#pasien-hamil").removeClass("active");
            $("#pasien-imunisasi").addClass("active");
        }
        else{
            $("#dashboard").addClass("active");
            $("#pegawai").removeClass("active");                
            $("#pendaftaran").removeClass("active");
            $("#pembayaran").removeClass("active");
            $('#ubah').removeClass('active');
            $('#collapseExample').removeClass('in');
            $('#pendaftaran-tambah').removeClass('active');
            $('#componentsExamples').removeClass('in');
        }
    }
</script>
</html>