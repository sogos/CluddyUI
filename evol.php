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
	<link rel="stylesheet" href="css/render.css" type="text/css" id="normal"/>
</head>
<body>
	<script>
	function getHex(r, g, b){
		return '#'+intToHex(r)+intToHex(g)+intToHex(b); 
	}
	function intToHex(n){
		n = n.toString(16);
		if( n.length < 2) {
			n = "0"+n; 
		}
		return n;
	}
	function randcolor() {
		var r = Math.floor(Math.random()*256);
		var g = Math.floor(Math.random()*256);
		var b = Math.floor(Math.random()*256);
		var e = getHex(r,g,b); 
		return e;
	}

	function colAdder(maxLarge, elem) {
		if(elem != '') {
			maxLarge = $(elem).parent().parent().attr('class').substr(4,2);
			$(elem).parent().parent().find('div').each(function(){
				var selected = this;
				var parentClass = $(selected).attr('class');
				if(parentClass.match('span[0-9]+')) {
					large = parentClass.substr(4,2);
					maxLarge = maxLarge - large;
				}
				console.log($(this).attr('class'));
			});
		}
		var str = '<span style="float:right; width:200px;" class="coladder">';
		for (var i = 0; i<(maxLarge-1); i++) {
			str = str + '<button id="addRow" class="btn" onclick="addCol(this, '+(i+1)+');">'+(i+1)+'</button>';
		}
		str = str + '</span>';

		if(elem == '') { 
			return str;
		} else {
			$(elem).parent().replaceWith(str);
		}
	}

	function addRow(elem) {
		var color = randcolor();
		var parentClass = $(elem).parent().attr('class');
		if(parentClass.match('span[0-9]+')) {
			maxLarge = parentClass.substr(4,2);
		}
		str = colAdder(maxLarge,'');

		$(elem).parent().parent().append('<br>').append('<div class="row">').append('<div style="background-color: '+color+'" class="'+parentClass+'">'+parentClass+'<button style="float:right;" id="addRow" class="btn btn-primary" onclick="addRow(this);">R</button>'+str+'<button onclick="deleteSpan(this);" type="button" class="btn btn-primary">×</button></div></div>');
	}
	function addCol(elem, type) {
		var color = randcolor();
		str = colAdder(type,'');
		var parentClass = 'span'+type;
		$(elem).parent().parent().append('<div style="background-color: '+color+'" class="'+parentClass+'">'+parentClass+'<button id="addRow" class="btn btn-primary" onclick="addRow(this);">R</button>'+str+'<button onclick="deleteSpan(this);" type="button" class="btn btn-primary">×</button></div>');
		colAdder(0,$(elem));
	}
	function deleteSpan(elem) {
		var target = '';
		actualLarge = $(elem).parent().attr('class').substr(4,2);
		actualLarge = parseInt(actualLarge);
		parentLarge = $(elem).parent().parent().attr('class').substr(4,2);
		parentLarge = parseInt(parentLarge);
		$(elem).parent().parent().children('div').each(function(){
			var selected = $(this);
			var parentClass = $(selected).attr('class');
			if(parentClass.match('span[0-9]+')) {
				large = parentClass.substr(4,2);
				large = parseInt(large);
				parentLarge = (parentLarge - large);
				console.log($(this).attr('class'));
			}
		});
		parentLarge = (parentLarge + actualLarge);
		$(elem).parent().parent().children('span').each(function(){
			var selected = this;
			var parentClass = $(selected).attr('class');
			if(parentClass.match('coladder')) {
				target = $(selected);
				console.log($(target).attr('class'));
			}
			
		});
		var str = '<span style="float:right; width:200px;" class="coladder">';
		for (var i = 0; i<(parentLarge-1); i++) {
			str = str + '<button id="addRow" class="btn" onclick="addCol(this, '+(i+1)+');">'+(i+1)+'</button>';
		}
		str = str + '</span>';
		if(target === "") {
		} else {
			$(target).replaceWith(str);
		}
		$(elem).parent().remove();
	};
	</script>

	<div class="container">
		<blockquote class="pull-right">Follow us on <a href="https://github.com/sogos/CluddyUI">GitHub</a>
			<br>Work based on Bootstrap by Twitter
		</blockquote>
		<div class="row">
			<a class="hide btn btn-success" id="restore">Restore</a><br><br>
			<div class="hide alert alert-info" id="restoreInfo">
				You can continue to Drag and Drop Elements
			</div>
		</div>
		<br>
		<div id="menu" class="row">
			<div class="span12">


				<a class="btn btn-success" data-toggle="modal" href="#myModal" >Render</a>

			</div>
		</div>
		<br>
		<div id="layout" class="row">
			<div class="span12">
				<button id="addRow" class="btn btn-primary" onclick="addRow(this);">Add a Row bottom</button>
			</div>
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