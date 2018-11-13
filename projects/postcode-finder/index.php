<!doctype html>
<html>
<head>
    <title>Postcode Finder</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <style>
	
	body, html {
		width: 100%;
		height: 100%;
		text-align: center;
        font-family: arimo;
	}	
	.container {		
		background-image : url("boathouse-on-pier.jpg");
		background-size: cover;
		background-position: center;
		height: 100%;
		width: 100%;
		padding-top: 60px;	
	}
	button {		
		margin-top: 40px;
		margin-bottom: 20px;	
	}
	p {
		padding: 15px 0 15px 0;	
	}
	.alert {		
		display : none;		
    }
	.white {
		color:white;	
	}
    
    </style>
    
</head>

<body>

	<div class="container">
		
		<div class="row">
		
			<div class="col-md-6 col-md-offset-3">
				
					<h1 class="white">Postcode Finder</h1>
					<p class="lead white">Enter your address below</p>
					
					<form class="form-group">
					
						<input class="form-control" type="text" name="address" id="address" placeholder="Eg. Sample Street, Demo City"/>
						<button id="locationFinder"class="btn btn-success btn-lg">FIND POSTCODE</button> 					
					</form>
					
					<div id="success" class="alert alert-success">Success</div>
					<div id="fail" class="alert alert-danger">Could not find the postcode for this area. Please try again.</div>
					<div id="fail2" class="alert alert-danger">Could not connect to the server. Please try again later.</div>
					<div id="noCity" class="alert alert-danger">Please enter a city...</div>
			</div>	
		</div>
	</div>
	
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
	
	$("#locationFinder").click(function(event){
		
		var result = 0;
		
		$(".alert").hide();
		
		event.preventDefault();
		
		$.ajax({
		
			type: "GET",
			url: "https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($('#address').val())+"&sensor=false&key=AIzaSyBt1NNqg7EQ1CnJquBwRKu_BYNmaUfcLZ0",
			dataType: "xml",
			success: processXML,
			error: error
		}); 
		
		function error(){
		
			$("#fail2").fadeIn();
		
		}
			
		function processXML(xml){
			
			$(xml).find("address_component").each(function() {
			
				if($(this).find("type").text() == "postal_code"){
				
				$('#success').html("The postcode for the area you searched is "+$(this).find('long_name').text()).fadeIn();
					
					result = 1;
				}		
			});
			
			if(result==0){
				
				$("#fail").fadeIn();
			}		
		}	
	});
	
</script>

</body>
</html>
