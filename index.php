<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>test</title>
	<link rel="stylesheet" href="themes/dark-hive/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery-ui-1.8.22.custom.min.js"></script>
	<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.lorem.js"></script>
	<link rel="stylesheet" href="css/dark-hive/jquery-ui-1.8.22.custom.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<style>
	li.highlight{
		background:#f2f2f2;
		border:1px dashed #212326;
		height: 30px;
		width: 100px;
	}
	.show-grid {
		margin-top: 10px;
		margin-bottom: 20px;
	}
	.show-grid [class*="span"] {
		background-color: #eee;
		text-align: center;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		min-height: 30px;
		line-height: 30px;
	}
	.show-grid:hover [class*="span"] {
		background: #ddd;
	}
	.show-grid .show-grid {
		margin-top: 0;
		margin-bottom: 0;
	}
	.show-grid .show-grid [class*="span"] {
		background-color: #ccc;
	}
	#delete {
		position:relative; right:5px; top:-12px;
		background: #111;
		border-radius: 40px;
		width: 30px;
		height 20px;
		color: #FFF;
	}
	body {
		position: relative;
		padding-top: 90px;
		background-color: #fff;
		background-image: url(img/bg.png);
	}
	label { 
		width: 10em;
		float: left; 
	}
	label.error { float: none;
		color: red;
		padding-left: .5em;
		vertical-align: top;
	}

	</style>

</head>
<body>
	<script>
	$(document).ready( function(){
		$( "#sortable" ).sortable({
			revert: true,
			opacity: 0.35,
			placeholder: 'highlight',
			update: function() {  
				//var order = $('#sortable').sortable('serialize'); // récupération des données à envoyer
				//$.post('ajax.php',order); // appel ajax au fichier ajax.php avec l'ordre des photos
			}
		});     
		$( "#sortable" ).disableSelection();
		$( "#210x280" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/210x280">').append("</li>"))
		});
		$( "#260x280" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/260x280">').append("</li>"))
		});
		$( "#320x280" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/320x280">').append("</li>"))
		});
		$( "#500x400" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/500x400">').append("</li>"))
		});
		$( "#span4div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span4">4</span>').append("</li>"))
		});
		$( "#span1div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span1">1</span>').append("</li>"))
		});
		$( "#span2div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span2">2</span>').append("</li>"))
		});
		$( "#span6div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span6">6</span>').append("</li>"))
		});
		$( "#span8div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span8">8</span>').append("</li>"))
		});
		$( "#span12div" ).click(function() {
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span12">12</span>').append("</li>"))
		});

		$("#delete").live('click', function() {
			$(this).parent().remove();
		});
		$("#add_custom_picture").click(function() {
			var height = $('#height').val(); 
			var width = $('#width').val(); 
			$('#sortable').append($('<li>').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" class="thumbnail" src="http://placehold.it/'+height+'x'+width+'">').append("</li>"))
		});

		$("#sizeselector").validate();
	});
</script>


<br>
<div class="container">
	<div class="row">
		<div class="span12 well">
			<button id="210x280" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a 210x280 picture</button>
			<button id="260x280" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a 260x280 picture</button>
			<button id="320x280" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a 320x280 picture</button>
			<button id="500x400" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a 500x400 picture</button>
			<br><br>
			<form class="form-inline" id="sizeselector">
				<input type="text" id="height" value="1280"  class="input-mini required" min=0 max=1280>x<input type="text" id="width" value="1024"  class="input-mini required" min=0 max=1024>
				<a href="#" id="add_custom_picture" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a Custom Size Picture</a>
			</form>
			<button id="span1div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN1</button>
			<button id="span2div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN2</button>
			<button id="span4div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN4</button>
			<button id="span6div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN6</button>
			<button id="span8div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN8</button>
			<button id="span12div" class="btn btn-primary"><i class="icon-leaf icon-white"></i> Add a SPAN12</button>

		</div>
	</div>
	<div class="row show-grid">

		<div id="panel">
			<ul id="sortable" class="thumbnails">

			</ul>
		</div>
	</div>

</div>
</body>
</html>