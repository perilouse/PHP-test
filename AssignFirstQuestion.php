<?php



function ligtExe()
	{echo "<br/>light intensity activites";
	$Lmet = 0;
	foreach ($_REQUEST['Lexercise'] as $activities)	{
			if ($activities == 11 )
			{$Lmet = $Lmet + 0.9; }
			if ($activities == 12 )
			{$Lmet = $Lmet + 1.0; }
			if ($activities == 13 )
			{$Lmet = $Lmet + 1.5; }
			if ($activities == 14 )
			{$Lmet = $Lmet + 2.3; }
			if ($activities == 15 )
			{$Lmet= $Lmet+ 2.9; }
							}

			return 	$Lmet;			
	}
function medExe()
	{echo "<br/>moderate intensity activities";
	$Mmet = 0;
	foreach ($_REQUEST['Mexercise'] as $activities)	{
			if ($activities == 21 )
			{$Mmet = $Mmet + 3.0; }
			if ($activities == 22 )
			{$Mmet = $Mmet + 3.3; }
			if ($activities == 23 )
			{$Mmet = $Mmet + 3.5; }
			if ($activities == 24)
			{$Mmet = $Mmet + 3.6; }
			if ($activities == 25 )
			{$Mmet = $Mmet + 4.0; }
							}
			
			return 	$Mmet;	
	}
function vigorExe()
	{echo "<br/>vigorous intensity activities";
	$Vmet = 0;	
	foreach ($_REQUEST['Vexercise'] as $activities)	{
			if ($activities == 31 )
			{$Vmet = $Vmet + 7.0; }
			if ($activities == 32 )
			{$Vmet = $Vmet + 8.0; }
			if ($activities == 33 )
			{$Vmet = $Vmet + 8.0; }
			if ($activities == 34 )
			{$Vmet = $Vmet + 10.0; }
							}

			return 	$Vmet;	
	}
function BMR_gender ($gender, $weight, $height, $age )
		{
	if ($gender == "Male")
	{$bmr=(13.7*$weight)+(5*$height)-(6.8*$age)+66;}
	if ($gender == "Female")
	{$bmr=(9.6*$weight)+(1.8*$height)-(4.7*$age)+6;}
	return 	$bmr;	
		}
$Error = array_fill(0,5,'');

if(isset($_REQUEST['submitted']))
	{
	if(!empty($_POST['name']) && !empty($_POST['age']) && is_numeric($_POST['weight']) && is_numeric($_POST['height']) 
	&& isset($_POST['gender']) )
		{
			if(isset($_REQUEST['Lexercise']) || isset($_REQUEST['Mexercise']) || isset($_REQUEST['Vexercise']))
				{
			$Lmet= 0;
			$Mmet =0;
			$Vmet = 0;			
			echo "<h1> Update </h1>";
			echo "<br/> your name 	: {$_POST['name']}";
			echo "<br/> your age	: {$_POST['age']}";
			echo "<br/> your weight	: {$_POST['weight']}";
			echo "<br/> your height	: {$_POST['height']}";
			echo "<br/> your gender	: {$_POST['gender']}";
			$name = $_POST['name'];
			$age = $_POST['age'];
			$weight = $_POST['weight'];
			$height = $_POST['height'];
			$gender = $_POST['gender'];
			session_start();
			$_SESSION["name"] = "$name";
			$_SESSION["age"] = "$age";
			$_SESSION["weight"] = "$weight";
			$_SESSION["height"] = "$height";
			$_SESSION["gender"] = "$gender";
				if (isset($_REQUEST['Lexercise'])){
				$Lmet= ligtExe();
				echo " = $Lmet";
				}
				if (isset($_REQUEST['Mexercise'])){
				$Mmet = medExe();
				echo " = $Mmet";
				}
				if (isset($_REQUEST['Vexercise'])){
				$Vmet = vigorExe();
				echo " = $Vmet";
				}
			BMR_gender($gender, $weight, $height, $age );
			$bmr = BMR_gender($gender, $weight, $height, $age);
			echo " <br/>this is your BMR $bmr";
			
			 
				}
			else 	{
				echo"<h1>error lvl 2 : please check a routine below</h1>";
				}
	
		}
	else 
		{
			echo"<h1>error lvl 1<h1>";
			echo"Please fill in your details";
				$detail = array ('name','age','weight','height','gender');
				$i=0;
				foreach ($detail as $c)
				{
				if (empty($_REQUEST[$c])) 
					{
				    $Error[$i] = "input missing";
				    
				  	}
				$i++;
				}
		}
	}


function calcBurn ($Lmet, $Mmet, $Vmet , $time, $bmr){
	return ($bmr / 24) * ($Lmet + $Mmet + $Vmet)* $time;;
	}

if(isset($_REQUEST['deliver']))
	{
	session_start();
		echo "<br/> your name 	: ".$_SESSION["name"];
		echo "<br/> your age	: ".$_SESSION["age"];
		echo "<br/> your weight	: ".$_SESSION["weight"];
		echo "<br/> your height	: ".$_SESSION["height"];
		echo "<br/> your gender	: ".$_SESSION["gender"];
	$Thours = 0;
	$TcalorieBurn = 0;
	$bmr = $_POST['deliver'];
		echo "<table>";
		echo	"<tr>
			<td><b> Physical Activities </td>
			<td><b> Hours </td>
			<td><b> Calories burned </td>
		</tr>";
	
	if (isset($_REQUEST['txt11']))
	if(is_numeric($_REQUEST['txt11'])){
			{echo	"<tr>";
			echo "<td>Sleeping</td>";
			$Hours = $_REQUEST['txt11'];
			echo "<td>$Hours</td>";
			echo "<td>";			
			$cb = calcBurn(0.9, 0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
			else
			{
			echo "error not number";
			$Thours=0 + $Thours;;
			$TcalorieBurn = 0 + $TcalorieBurn;
			}
	if (isset($_REQUEST['txt12']))
		if(is_numeric($_REQUEST['txt12'])){
			{echo	"<tr>";
			echo "<td>Watching television</td>";
			$Hours = $_REQUEST['txt12'];
			echo "<td>$Hours</td>";
			echo "<td>";
			echo calcBurn(1.0, 0, 0 , $Hours, $bmr);
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt13']))
		if(is_numeric($_REQUEST['txt13'])){
			{echo	"<tr>";
			echo "<td>Writing, desk work, typing</td>";
			$Hours = $_REQUEST['txt13'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(1.5, 0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt14']))
		if(is_numeric($_REQUEST['txt14'])){
			{echo	"<tr>";
			echo "<td>Walking (2.7km/h), level ground,strolling,very slow</td>";
			$Hours = $_REQUEST['txt14'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(2.3, 0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt15']))
		if(is_numeric($_REQUEST['txt15'])){
			{echo	"<tr>";
			echo "<td>Walking (4km/h)</td>";
			$Hours = $_REQUEST['txt15'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(2.9, 0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
							else
							{
							echo "error not number";
							$Thours=0 + $Thours;;
							$TcalorieBurn = 0 + $TcalorieBurn;
							}	

	if (isset($_REQUEST['txt21']))
		if(is_numeric($_REQUEST['txt21'])){
			{echo	"<tr>";
			echo "<td>Bicyling, light effort</td>";
			$Hours = $_REQUEST['txt21'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 3.0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt22']))
		if(is_numeric($_REQUEST['txt22'])){
			{echo	"<tr>";
			echo "<td>Walking (4.8 km/h)</td>";
			$Hours = $_REQUEST['txt22'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb =calcBurn(0, 3.3, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt23']))
		if(is_numeric($_REQUEST['txt23'])){
			{echo	"<tr>";
			echo "<td>Home exercise, light or moderate effort</td>";
			$Hours = $_REQUEST['txt23'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 3.5, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt24']))
		if(is_numeric($_REQUEST['txt24'])){
			{echo	"<tr>";
			echo "<td>Walking (5.5 km/h)</td>";
			$Hours = $_REQUEST['txt24'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 3.6, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt25']))
		if(is_numeric($_REQUEST['txt25'])){
			{echo	"<tr>";
			echo "<td>Bicycling &#60; 16 km/h</td>";
			$Hours = $_REQUEST['txt25'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 4.0, 0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}

	if (isset($_REQUEST['txt31']))
		if(is_numeric($_REQUEST['txt31'])){
			{echo	"<tr>";
			echo "<td>Jogging</td>";
			$Hours = $_REQUEST['txt31'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 0, 7.0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt32']))
		if(is_numeric($_REQUEST['txt32'])){
			{echo	"<tr>";
			echo "<td>Calisthenics (eg. Push ups, sit-ups, jumping jacks), heavy vigorous efforts</td>";
			$Hours = $_REQUEST['txt32'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 0, 8.0 , $Hours, $bmr);
			echo $cb;
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt33']))
		if(is_numeric($_REQUEST['txt33'])){
			{echo	"<tr>";
			echo "<td>Running, jogging in place</td>";
			$Hours = $_REQUEST['txt33'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 0, 8.0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
	if (isset($_REQUEST['txt34']))
		if(is_numeric($_REQUEST['txt34'])){
			{echo	"<tr>";
			echo "<td>Rope jumping</td>";
			$Hours = $_REQUEST['txt34'];
			echo "<td>$Hours</td>";
			echo "<td>";
			$cb = calcBurn(0, 0, 10.0 , $Hours, $bmr);
			echo $cb;
			echo "</td>";
			echo	"</tr>";
			$Thours= $Hours + $Thours;
			$TcalorieBurn = $cb + $TcalorieBurn;}
							
			echo 	"</table>";
			echo "<br/> this is the time $Thours";
			echo "<br/>this is the calorie burnt $TcalorieBurn";
			}
						else
						{
						echo "error not number";
						$Thours=0 + $Thours;;
						$TcalorieBurn = 0 + $TcalorieBurn;
						}
		}
		

?>

<html>
	<head>
		<title>isb42503 internet programming</title>
		</head>
<body>

<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<?php
if(isset($_REQUEST['submitted']))
	{
		if(isset($_REQUEST['Lexercise']) || isset($_REQUEST['Mexercise']) || isset($_REQUEST['Vexercise']))
		{
		echo 	"<table>";
		echo	"<tr>
			<td>  </td>
			<td> Hours </td>
			<td> MET </td>
			</tr>";
	if (isset($_REQUEST['Lexercise'])){
	echo "<th>Light intensity activities</th>";
	foreach ($_REQUEST['Lexercise'] as $activities)	{
				
			if ($activities == 11 )
			{echo	"<tr>";
			echo "<td>Sleeping</td>";
			?><td><p><input type="text" name="txt11" value="<?php if(isset($_POST['txt11'])) echo $_POST['txt11'] ?>"/></p></td><?php
			echo "<td>0.9</td>";
			echo	"</tr>";}
						
			if ($activities == 12 )
			{echo	"<tr>";
			echo "<td>Watching television</td>";
			?><td><p><input type="text" name="txt12" value="<?php if(isset($_POST['txt12'])) echo $_POST['txt12'] ?>"/></p></td><?php
			echo "<td>1.0</td>";
			echo	"</tr>";}
			
			if ($activities == 13 )
			{echo	"<tr>";
			echo "<td>Writing, desk work, typing</td>";
			?><td><p><input type="text" name="txt13" value="<?php if(isset($_POST['txt13'])) echo $_POST['txt13'] ?>"/></p></td><?php
			echo "<td>1.5</td>";
			echo	"</tr>";}
			
			if ($activities == 14 )
			{echo	"<tr>";
			echo "<td>Walking (2.7km/h), level ground,strolling,very slow</td>";
			?><td><p><input type="text" name="txt14" value="<?php if(isset($_POST['txt14'])) echo $_POST['txt14'] ?>"/></p></td><?php
			echo "<td>2.3</td>";
			echo	"</tr>";}
			
			if ($activities == 15 )
			{echo	"<tr>";
			echo "<td>Walking (4km/h)</td>";
			?><td><p><input type="text" name="txt15" value="<?php if(isset($_POST['txt15'])) echo $_POST['txt15'] ?>"/></p></td><?php
			echo "<td>2.9</td>";
			echo	"</tr>";}}
							}
	if (isset($_REQUEST['Mexercise'])){
	echo "<th>Light intensity activities</th>";
	foreach ($_REQUEST['Mexercise'] as $activities)	{
			if ($activities == 21 )
			{echo	"<tr>";
			echo "<td>Bicyling, light effort</td>";
			?><td><p><input type="text" name="txt21" value="<?php if(isset($_POST['txt21'])) echo $_POST['txt21'] ?>"/></p></td><?php
			echo "<td>3.0</td>";
			echo	"</tr>";}
			
			if ($activities == 22 )
			{echo	"<tr>";
			echo "<td>Walking (4.8 km/h)</td>";
			?><td><p><input type="text" name="txt22" value="<?php if(isset($_POST['txt22'])) echo $_POST['txt22'] ?>"/></p></td><?php
			echo "<td>3.3</td>";
			echo	"</tr>";}
			
			if ($activities == 23 )
			{echo	"<tr>";
			echo "<td>Home exercise, light or moderate effort</td>";
			?><td><p><input type="text" name="txt23" value="<?php if(isset($_POST['txt23'])) echo $_POST['txt23'] ?>"/></p></td><?php
			echo "<td>3.5</td>";
			echo	"</tr>";}
			
			if ($activities == 24)
			{echo	"<tr>";
			echo "<td>Walking (5.5 km/h)</td>";
			?><td><p><input type="text" name="txt24" value="<?php if(isset($_POST['txt24'])) echo $_POST['txt24'] ?>"/></p></td><?php
			echo "<td>3.6<td>";
			echo	"</tr>";}
			
			if ($activities == 25 )
			{echo	"<tr>";
			echo "<td>Bicycling &#60; 16 km/h</td>";
			?><td><p><input type="text" name="txt25" value="<?php if(isset($_POST['txt25'])) echo $_POST['txt25'] ?>"/></p></td><?php
			echo "<td>4.0</td>";
			echo	"</tr>";}}
							}
	if (isset($_REQUEST['Vexercise'])){
	echo "<th>Light intensity activities</th>";
	foreach ($_REQUEST['Vexercise'] as $activities)	{
			if ($activities == 31 )
			{echo	"<tr>";
			echo "<td>Jogging</td>";
			?><td><p><input type="text" name="txt31" value="<?php if(isset($_POST['txt31'])) echo $_POST['txt31'] ?>"/></p></td><?php
			echo "<td>7.0</td>";
			echo	"</tr>";}
			
			if ($activities == 32 )
			{echo	"<tr>";
			echo "<td>Calisthenics (eg. Push ups, sit-ups, jumping jacks), heavy vigorous efforts</td>";
			?><td><p><input type="text" name="txt32" value="<?php if(isset($_POST['txt32'])) echo $_POST['txt32'] ?>"/></p></td><?php
			echo "<td>8.0</td>";
			echo	"</tr>";}
			
			if ($activities == 33 )
			{echo	"<tr>";
			echo "<td>Running, jogging in place</td>";
			?><td><p><input type="text" name="txt33" value="<?php if(isset($_POST['txt33'])) echo $_POST['txt33'] ?>"/></p></td><?php
			echo "<td>8.0</td>";
			echo	"</tr>";}
			
			if ($activities == 34 )
			{echo	"<tr>";
			echo "<td>Rope jumping</td>";
			?><td><p><input type="text" name="txt34" value="<?php if(isset($_POST['txt34'])) echo $_POST['txt34'] ?>"/></p></td><?php
			echo "<td>10.0</td>";
			echo	"</tr>";}}
			
							}
		echo 	"</table>";
		
		?><input type="hidden" name="deliver" value="<?php echo $bmr; ?>">
					 <button type="submit">Submit</button><?php

				}
		}
?>
	</form>
<style>.error{color: #FF0000;}</style>
<h1> lets lose weight with excercise</h1>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<p>	Name 	  	: <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>"/>
		<span class="error"> * <?php echo $Error[0] ;?></span></p>
		<p>	age		: <input type="text" name="age" value="<?php if(isset($_POST['age'])) echo $_POST['age'] ?>"/>
		<span class="error"> * <?php echo $Error[1] ;?></span></p>
		<p>	Weight 	  	: <input type="text" name="weight" value="<?php if(isset($_POST['weight'])) echo $_POST['weight'] ?>"/>
		<span class="error"> * <?php echo $Error[2] ;?></span></p>
		<p>	height 	  	: <input type="text" name="height" value="<?php if(isset($_POST['height'])) echo $_POST['height'] ?>"/>
		<span class="error"> * <?php echo $Error[3] ;?></span></p>
		<p>	Gender		: <span class="error"> * <?php echo $Error[4] ;?></span>
					 <input type="radio" name="gender" value="Male" 
		<?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo 'checked="checked"';?>/>male
					 <input type="radio" name="gender" value="Female"
		<?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo 'checked="checked"';?>/>female
		</p>
		<p> please pick one or multiple excercise	: </p>
		<p> light intensity activites </p>
			  <p><input type="checkbox" id="L1" name="Lexercise[]" <?php if ((!empty($_POST["Lexercise"]) && in_array("11", $_POST["Lexercise"]))) {
			  			  echo "checked";} ?> value="11">Sleeping</p>
			  <p><input type="checkbox" id="L2" name="Lexercise[]" <?php if ((!empty($_POST["Lexercise"]) && in_array("12", $_POST["Lexercise"]))) {
			  			  echo "checked";} ?> value="12">Watching television</p>
			  <p><input type="checkbox" id="L3" name="Lexercise[]" <?php if ((!empty($_POST["Lexercise"]) && in_array("13", $_POST["Lexercise"]))) {
			  			  echo "checked";} ?> value="13">Writing, desk work, typing</p>
			  <p><input type="checkbox" id="L4" name="Lexercise[]" <?php if ((!empty($_POST["Lexercise"]) && in_array("14", $_POST["Lexercise"]))) {
			  			  echo "checked";} ?> value="14">Walking (2.7km/h), level ground,strolling,very slow</p>
			  <p><input type="checkbox" id="L5" name="Lexercise[]" <?php if ((!empty($_POST["Lexercise"]) && in_array("15", $_POST["Lexercise"]))) {
			  			  echo "checked";} ?> value="15">Walking (4km/h)</p>
		<p> moderate intensity activities </p>
			  <p><input type="checkbox" id="M1" name="Mexercise[]" <?php if ((!empty($_POST["Mexercise"]) && in_array("21", $_POST["Mexercise"]))) {
			  			  echo "checked";} ?> value="21">Bicyling, light effort</p>
			  <p><input type="checkbox" id="M2" name="Mexercise[]" <?php if ((!empty($_POST["Mexercise"]) && in_array("22", $_POST["Mexercise"]))) {
			  			  echo "checked";} ?> value="22">Walking (4.8 km/h)</p>
			  <p><input type="checkbox" id="M3" name="Mexercise[]" <?php if ((!empty($_POST["Mexercise"]) && in_array("23", $_POST["Mexercise"]))) {
			  			  echo "checked";} ?> value="23">Home exercise, light or moderate effort</p>
			  <p><input type="checkbox" id="M4" name="Mexercise[]" <?php if ((!empty($_POST["Mexercise"]) && in_array("24", $_POST["Mexercise"]))) {
			  			  echo "checked";} ?> value="24">Walking (5.5 km/h)</p>
			  <p><input type="checkbox" id="M5" name="Mexercise[]" <?php if ((!empty($_POST["Mexercise"]) && in_array("25", $_POST["Mexercise"]))) {
			  			  echo "checked";} ?> value="25">Bicycling &#60; 16 km/h</p>
		<p> vigorous intensity activities </p>
			  <p><input type="checkbox" id="V1" name="Vexercise[]" <?php if ((!empty($_POST["Vexercise"]) && in_array("31", $_POST["Vexercise"]))) {
			  			  echo "checked";} ?> value="31">Jogging</p>
			  <p><input type="checkbox" id="V2" name="Vexercise[]" <?php if ((!empty($_POST["Vexercise"]) && in_array("32", $_POST["Vexercise"]))) {
			  			  echo "checked";} ?> value="32">Calisthenics (eg. Push ups, sit-ups, jumping jacks), heavy vigorous efforts</p>
			  <p><input type="checkbox" id="V3" name="Vexercise[]" <?php if ((!empty($_POST["Vexercise"]) && in_array("33", $_POST["Vexercise"]))) {
			  			  echo "checked";} ?> value="33">Running, jogging in place</p>
			  <p><input type="checkbox" id="V4" name="Vexercise[]" <?php if ((!empty($_POST["Vexercise"]) && in_array("34", $_POST["Vexercise"]))) {
			  			  echo "checked";} ?> value="34">Rope jumping</p>
					  
		<p><input type="submit" name="submitted" value="enter"/></p>
</form>
<p></p>
</body>
<html>
