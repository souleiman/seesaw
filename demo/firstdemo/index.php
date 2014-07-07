<!DOCTYPE html>
<html style="margin:0px; height:100%;">
<head>
	<title>iMagine</title>
	<script src="libs/jquery-1.10.2.js"></script>
	<script src="libs/jquery-ui-1.10.4.min.js"></script>
	<?php 
		$link = mysql_connect('localhost', 'root', 'mountain');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('imagine');
	?>

</head>

<body style="margin:0px; height:100%; background: rgba(25,168,165,.65);">

	<section id="header" style="width:100%; height:50px; background: linear-gradient(to right,#FFFFFF 30%, rgba(171,150,94,1))">
		<section id="navbar" style="width:60%; height:50px; margin-left:20%; margin-right:20%;">
			<img src="images/logo.png" id="logo" style="float:left;" class="draggable">
			<img src="images/profile.png" id="search" style="float:right; height:auto; width:4%; margin-top:.5%;" class="draggable">
			<img src="images/redheart.png" id="setting" style="float:right; height:auto; width:4%; margin-top:.5%;" class="draggable">
<!-- 			<img src="images/lightbulb.png" id="idea" style="float:right; height:auto; width:4%; margin-top:.5%;" class="draggable"> -->			
			<a href = "form.html"><img src = "images/lightbulb.png" id="idea" style="float:right; border:0; height:auto; width:4%; margin-top:.5%;"></a>
		</section>
	</section>

	<section id="profile" style="width:18%; height:50%; margin-left:1%; float:left; background-color:white; margin-top:1%; border-radius:.5em;">
		<h1 style="font-family:Lucida Grande, Tahoma, Arial, Verdana, sans-serif; text-align:center;"> User Profile </h1>
	</section>

	<section id="content" style="float:left; width:60%; height:100%; margin-left:1%; margin-right:auto; background-color:white; margin-top:1%; margin-bottom:1%; border-radius:.5em;">
		<?
		// Fetch Events
		$query="SELECT * FROM dummy ORDER BY id DESC";
		$result=mysql_query($query);
		if($result === FALSE) {
			echo "Database Failure";
			die(mysql_error());
		}
		// Grab Events for this month and year
		// Note: Using different names to not confuse variables. f for fetch
		$count = 1;
		while ($row=mysql_fetch_array($result)) {
			$username=$row['username'];
			$description=$row['description'];
			$comment_count=$row['comment_count'];
			$tags=$row['tags'];
			$time_created=$row['time_created'];
			//$data[$count] = array($f_event, $f_month, $f_day, $f_year, $f_start, $f_end, $f_location, $f_type, $f_description);
			$count++;
			//echo ($username.", ".$description);			
			$temp = "";
			$temp .= '<div id="project" class="row" style="width=80%; height:auto; padding-bottom:2%; border-bottom:solid; border-width:.1em; border-color:rgba(171,150,94,.5);" class="draggable">';
			$temp .= '<img src="images/userpng.png" style="float:left; width=5% height:auto; margin-top:1%; margin-left:.75%; border-radius:.5em;" class="draggable">';
			$temp .= '<div style="width: 80%; height:auto; font-family:Lucida Grande, Tahoma, Arial, Verdana, sans-serif;font-size:20px; padding-top:.75%; padding-left:6%;">';
			$temp .= $username." says: ";
			$temp .= $description;
			$temp .= ' - ';
			$temp .= $time_created;
			$temp .= '<br>';
			$temp .= 'Tags: '.$tags;
			$temp .= '<div style="float:right; height:auto; font-size:18px; margin-right:1%; margin-top:1%;">';
			$temp .= $comment_count.' comments';
			$temp .= '</div>';
			$temp .= '</div>';
			$temp .= '</div>';
			echo $temp;
		}
		?>
	</section>

	<section id="hot" style="width:18%; height:50%; margin-right:1%; float:right; background-color:white; margin-top:1%; border-radius:.5em;">
		<h1 style="font-family:Lucida Grande, Tahoma, Arial, Verdana, sans-serif; text-align:center;"> Top Ideas </h1>
	</section>

	
	<section id="formwrapper" style="width:100%; height:100%; position:absolute; top:0px; left:0px; display:none;">
		<section id="formbg" style="width:100%; height:100%; position:absolute; background-color:black; opacity:0.8;">
		</section>
		<section id="form" style="border-radius:.5em; width:300px; height:300px; top:50%; left:50%; margin-top:-150px; margin-left:-150px; position:relative; background-color:white;">
			<label style="margin-left:2%;">Title:</label><br>
			<input type="text" name="title"><br>
			<label style="margin-left:2%;">Description:</label><br>
			<textarea name="description" rows="4" cols="25" maxlength="250" style="resize:none;"></textarea><br>
			<br>
			<img src="images/redheart.png" style="float:left; height:auto; width:20%; margin-top:.5%;" id="submit" class="draggable">
		</section>
	</section>

	<section id="fullidea" style="width:100%; height:100%; position:absolute; top:0px; left:0px; display:none;">
		<section id="ideabg" style="width:100%; height:100%; position:absolute; background-color:black; opacity:0.8;">
		</section>
		<section id="ideabody" style="border-radius:.5em; width:50%; height:70%; margin-left:auto; margin-right:auto; margin-top:5%; position:relative; background-color:white;">
		</section>
	</section>
<script>
	//	Mobile version
	//	TODO: get width of device and cut off any hanging text
	var mobile = false;
	var mobiledisplay = function () {
		document.getElementById("content").style.width="100%";
	};
	
	if (mobile) {
		mobiledisplay();
	}
	
	// //	Create a new idea
	// $("#idea").click(function() {
	// 	document.getElementById("formwrapper").style.display="inline";
	// });
	
	// //	Submit a new idea
	// $("#submit").click(function() {
	// 	alert("Submitted! (but not really)");
	// });
	
	// //	Close form
	// $("#formbg").click(function() {
	// 	document.getElementById("formwrapper").style.display="none";
	// });




	//	Test database
	//	TODO: insert code to retrieve data from actual database via GO
	//	TODO: rename tdb to appropriate name
	/*
	var tdb = new Array();
	tdb[0] = "This is a really cool idea and I am so glad I came up with it yay free friday ice cream fundays for everyone!";
	tdb[1] = "No pants days";
	tdb[2] = "Agilex slumber party idea";
	tdb[3] = "The next big thing";
	tdb[4] = "Rave-a-Thon";
	tdb[5] = "I have a really cool idea for humpdays";
	tdb[6] = "Idea to invent software that will make Agilex $1,000,000s";

	var longdes = "Long Description of Friday Fundays";
	
	var popout = "";
	popout += '<img src="images/userpng.png" style="float:left; margin-top:1%; margin-left:1%;">';
	popout += '<div style="float:left; padding-left:1%; padding-top:4%; font-size:20px;">';
	popout += longdes;
	popout += '</div>';
	document.getElementById("ideabody").innerHTML += popout;

	var tdbtime = new Array();
	tdbtime[0] = " - 14m";
	tdbtime[1] = " - 38min";
	tdbtime[2] = " - 1h";
	tdbtime[3] = " - 3h";
	tdbtime[4] = " - 5h";
	tdbtime[5] = " - 7h";
	tdbtime[6] = " - 19h";

	var tdbtags = new Array();
	tdbtags[0] = "@GSS";
	tdbtags[1] = "@HC";
	tdbtags[2] = "@bigdata";
	tdbtags[3] = "@USPS";
	tdbtags[4] = "@Amtrak";
	tdbtags[5] = "@J&H";
	tdbtags[6] = "@Intel";

	var comments = "0 comments";
	
	for (var i = 0; i < tdb.length; i++) {
		var temp = "";
		temp += '<div id="project" class="row" style="width=80%; height:auto; padding-bottom:2%; border-bottom:solid; border-width:.1em; border-color:rgba(171,150,94,.5);" class="draggable">';
		temp += '<img src="images/userpng.png" style="float:left; width=5% height:auto; margin-top:1%; margin-left:.75%; border-radius:.5em;" class="draggable">';
		temp += '<div style="width: 80%; height:auto; font-family:Lucida Grande, Tahoma, Arial, Verdana, sans-serif;font-size:20px; padding-top:.75%; padding-left:6%;">';
		temp += tdb[i];
		temp += tdbtime[i];
		temp += '<br>';
		temp += tdbtags[i];
		temp += '<div style="float:right; height:auto; font-size:18px; margin-right:1%; margin-top:1%;">';
		temp += comments;
		temp += '</div>';
		temp += '</div>';

		temp += '</div>';
		document.getElementById("content").innerHTML += temp;
	}
	*/


	


	//
	//	jQuery tools
	//
	
	//	Draggable - add class="draggable" to any html element and it will enable dragging capabilities
	$(function() {
		$(".draggable").draggable();
	});
	
	//	Click - a demonstration on how to invoke event on specific element when clicked
	$("#example").click(function() {
		//	do something cool!
	});

	//Click a project description, open a larger panel with additional project information
	$("#project").click(function() {
		document.getElementById("fullidea").style.display="inline";
	});

	//Close the larger project description
	$("#ideabg").click(function() {
		document.getElementById("fullidea").style.display="none";
	});
	
</script>
</body>
</html>