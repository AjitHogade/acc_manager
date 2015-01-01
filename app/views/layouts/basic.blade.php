
<html >
<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
//Bootstrap CSS 
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
<!-- <link rel="stylesheet" type="text/css" href="/media/css/bootstrap.min.css">-->

<!--JQuery UI CSS-->
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet"> 
<!--<link rel="stylesheet" type="text/css" href="/media/css/jquery-ui-base-1.8.20.css"> -->

<!-- Style CSS -->
<link rel="stylesheet" type="text/css" href="/media/css/style.css">
<!-- CSS to manage tagit while adding clients -->
<link href="/media/css/tagit-awesome-blue.css" type="text/css" rel="stylesheet">


<!-- Bootstrap JS -->
<script src="/media/js/bootstrap.min.js"></script>
<!-- JQuery JS -->
<script src="/media/js/jquery.js"></script>
 JQuery UI JS 
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!--<script src="/media/js/jquery-ui.min.js"></script>-->
<!-- TAG-IT JS -->
<script type="text/javascript" src="/media/js/tagit.js" charset="UTF-8"></script>

</head>
<body>
@include('layouts.header')
<div id="content">
<div class="container-fluid">
     <div class="row">
        	@yield('content')  
	 </div>
	</div>	
</div>	
</body>