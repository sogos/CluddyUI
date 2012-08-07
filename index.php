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
</head>
<body>
	<script>
	$(document).ready( function(){
		$('head').append('<link rel="stylesheet" href="css/normal.css" type="text/css" id="normal"/>')
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
			$('#sortable').append($('<li id="210x280">').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/210x280">').append("</li>"))
		});
		$( "#260x280" ).click(function() {
			$('#sortable').append($('<li id="260x280">').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/260x280">').append("</li>"))
		});
		$( "#320x280" ).click(function() {
			$('#sortable').append($('<li id="320x280">').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/320x280">').append("</li>"))
		});
		$( "#500x400" ).click(function() {
			$('#sortable').append($('<li id="500x400">').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/500x400">').append("</li>"))
		});
		$( "#span4div" ).click(function() {
			$('#sortable').append($('<li id="span4">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span4">4</span>').append("</li>"))
		});
		$( "#span1div" ).click(function() {
			$('#sortable').append($('<li id="span1">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span1">1</span>').append("</li>"))
		});
		$( "#span2div" ).click(function() {
			$('#sortable').append($('<li id="span2">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span2">2</span>').append("</li>"))
		});
		$( "#span6div" ).click(function() {
			$('#sortable').append($('<li id="span6">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span6">6</span>').append("</li>"))
		});
		$( "#span8div" ).click(function() {
			$('#sortable').append($('<li id="span8">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span8">8</span>').append("</li>"))
		});
		$( "#span12div" ).click(function() {
			$('#sortable').append($('<li id="span12">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="span12">12</span>').append("</li>"))
		});

		$("#delete").live('click', function() {
			$(this).parent().remove();
		});
		$("#add_custom_picture").click(function() {
			var height = $('#height').val(); 
			var width = $('#width').val(); 
			$('#sortable').append($('<li id="'+height+'x'+width+'">').append('<img alt="" class="thumbnail" src="http://placehold.it/'+height+'x'+width+'">').append("</li>"))
		});

		$("#sizeselector").validate();
		$("#restore").click(function() {
			$('#restore').addClass('hide');
			$('#restoreInfo').addClass('hide');
			$('#menu').show();
			jQuery('#render').remove();
			$('head').append('<link href="css/normal.css" rel="stylesheet" id="normal" />');
			$('#sortable li').map(function(i,n) {
				if($(n).attr('id').match(/^\d+x\d+$/)) {
					$(n).replaceWith(($('<li id="'+$(n).attr('id')+'">').append('<button id="delete" type="button" class="close">×</button>').append('<img alt="" src="http://placehold.it/'+$(n).attr('id')+'">').append("</li>")))
				} else {
					$(n).replaceWith(($('<li id="'+$(n).attr('id')+'">').append('<button id="delete" type="button" class="close">×</button>').append('<span class="'+$(n).attr('id')+'">'+$(n).attr('id')+'</span>').append("</li>")))
				}
			});

			

		});
		$("#save").click(function() {
			var count = 1;
			var liIds = $('#sortable li').map(function(i,n) {
				var currentId = count + '_' + $(n).attr('id');
				count = count + 1;
				return currentId;
			}).get().join(',');
			$.post('save.php', { layout: liIds },
				function(data)  {
					var ulSize = $('#sortable').size();
					$('#sortable li').map(function(i,n) {
						$(n).remove();
					});
					var layout = jQuery.parseJSON(data);
					$.each(layout, function() {
						$('#sortable').append($('<li id="'+this.id+'">').append('<span class="'+this.class+'">'+this.content+'</span>').append("</li>"))

					});
					jQuery('#normal').remove();
					$('head').append('<link href="css/render.css" rel="stylesheet" id="render" />');
					$('#menu').hide();
					$('#restore').removeClass('hide');
					$('#restoreInfo').removeClass('hide');
					$('#myModal').modal('hide');
				});
		});
	});
</script>


<br>

<div class="container">
	<div class="row">
		<a class="hide btn btn-success" id="restore">Restore</a><br><br>
		<div class="hide alert alert-info" id="restoreInfo">
			You can continue to Drag and Drop Elements
		</div>
	</div>
	<br>
	<div id="menu" class="row">
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
			<br><br>
			<a class="btn btn-success" data-toggle="modal" href="#myModal" >Render</a>

		</div>
	</div>

	<div class="row show-grid">
		<ul id="sortable" class="thumbnails">

		</ul>
	</div>

	<div class="modal hide" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Your layout will be saved</h3>
		</div>
		<div class="modal-body">
			<p>Your layout will be filled with content.</p>
			<p>Click on Restore to retrieve the menu</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Continue Customization</a>
			<a href="#" id="save" class="btn btn-primary">Render Template</a>
		</div>
	</div>
</div>
</body>
</html>