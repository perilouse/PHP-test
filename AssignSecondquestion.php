<?php
// setting up empty variables
$dipError = array_fill(0,14,'');




if(isset($_REQUEST['c1']))
	{
	if(is_numeric($_REQUEST['DIbmi']) && is_numeric($_REQUEST['DImiit']) && is_numeric($_REQUEST['DImfi']) && is_numeric($_REQUEST['DImiat']) && 
	is_numeric($_REQUEST['DImicet']) && is_numeric($_REQUEST['DImsi']) && is_numeric($_REQUEST['DIrcmp']) &&
	is_numeric($_REQUEST['DEbmi']) && is_numeric($_REQUEST['DEmiit']) && is_numeric($_REQUEST['DEmfi']) && is_numeric($_REQUEST['DEmiat']) && 
	is_numeric($_REQUEST['DEmicet']) && is_numeric($_REQUEST['DEmsi']) && is_numeric($_REQUEST['DErcmp']))
		{
		$diBMI = (int)$_REQUEST['DIbmi'];
		$diMIIT = (int)$_REQUEST['DImiit'];
		$diMFI = (int)$_REQUEST['DImfi'];
		$diMIAT = (int)$_REQUEST['DImiat'];
		$diMICET = (int)$_REQUEST['DImicet'];
		$diMSI = (int)$_REQUEST['DImsi'];
		$diRCMP = (int)$_REQUEST['DIrcmp'];
		
		$deBMI = (int)$_REQUEST['DEbmi'];
		$deMIIT = (int)$_REQUEST['DEmiit'];
		$deMFI = (int)$_REQUEST['DEmfi'];
		$deMIAT = (int)$_REQUEST['DEmiat'];
		$deMICET = (int)$_REQUEST['DEmicet'];
		$deMSI = (int)$_REQUEST['DEmsi'];
		$deRCMP = (int)$_REQUEST['DErcmp'];
		
		$BMI = $diBMI + $deBMI;
		$MIIT = $diMIIT + $deMIIT;
		$MFI = $diMFI + $deMFI;
		$MIAT = $diMIAT + $deMIAT;
		$MICET = $diMICET + $deMICET;
		$MSI = $diMSI + $deMSI;
		$RCMP = $diRCMP + $deRCMP;
		
		echo "MAJLIS KONVOKESYEN";
		echo "<br/>Universiti Kuala Lumpur";
		echo "<br/>2020";
		echo "<table>";
		echo "<tr>";
		echo "<td>Institute</td>";
		echo "<td>Degree</td>";
		echo "<td>Diploma</td>";
		echo "</tr>";
		
		$campus = array ('BMI','MIIT','MFI','MIAT','MICET','MSI','RCMP');
		$Tcampus = array ($BMI,$MIIT,$MFI,$MIAT,$MICET,$MSI,$RCMP);
		$diploma = array($diBMI,$diMIIT,$diMFI,$diMIAT,$diMICET,$diMSI,$diRCMP);
		$degree = array($deBMI,$deMIIT,$deMFI,$deMIAT,$deMICET,$deMSI,$deRCMP);

		$i=0;
		
		foreach ($diploma as $d)
		{echo "<tr>";
		echo "<td>$campus[$i]</td>";
		echo "<td>$degree[$i]</td>";
		echo "<td>$d</td>";
		echo "</tr>";
		$i++;}

		echo "<br/>Universiti Kuala Lumpur";
		echo "<br/>2020";
		echo "<table>";
		echo "<tr>";
		echo "<td>institute</td>";
		echo "<td>total</td>";
		echo "</tr>";
		
		$i=0;
		foreach ($diploma as $d)
		{echo "<tr>";
		echo "<td>$campus[$i]</td>";
		echo "<td>$Tcampus[$i]</td>";
		echo "</tr>";
		$i++;}
				
		echo "</table>";
		}
		else 	{
			echo"Error";
			$Dcampus = array ('DIbmi','DEbmi','DImiit','DEmiit','DImfi','DEmfi','DImiat','DEmiat','DImicet','DEmicet','DImsi','DEmsi','DIrcmp','DErcmp');
			$i=0;
			foreach ($Dcampus as $c)
			{
			if (empty($_REQUEST[$c])) 
				{
			    $dipError[$i] = "input missing";
			    $i++;
			  	}
			else 	{
			  		if (!is_numeric($_REQUEST[$c]))
					{$dipError[$i]= "please only use integers";
					$i++;
					}
				}
			}		
			}
	}
	

?>

<head>
	<title>
	Majlis Konvokesyen Universiti Kuala Lumpur 2020
	</title>
</head>
<style>
.error{color: #FF0000;}
</style>
	<body>
	<h1></h1>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<p><p>
	<p>BMI</p>
	<p>Diploma:	<input type="text" name="DIbmi" value="<?php if(isset($_POST['DIbmi'])) echo $_POST['DIbmi'] ?>"/>
	<span class="error"> * <?php echo $dipError[0] ;?></span>  
	 Degree:	<input type="text" name="DEbmi" value="<?php if(isset($_POST['DEbmi'])) echo $_POST['DEbmi'] ?>"/>
	 <span class="error"> * <?php echo $dipError[1] ;?></span></p>
	
	<p>MIIT</p>
	<p>Diploma:	<input type="text" name="DImiit" value="<?php if(isset($_POST['DImiit'])) echo $_POST['DImiit'] ?>"/>
	<span class="error"> * <?php echo $dipError[2] ;?></span>
	 Degree:	<input type="text" name="DEmiit" value="<?php if(isset($_POST['DEmiit'])) echo $_POST['DEmiit'] ?>"/>
	 <span class="error"> * <?php echo $dipError[3] ;?></span></p>
	
	<p>MFI</p> 
	<p>Diploma:	<input type="text" name="DImfi" value="<?php if(isset($_POST['DImfi'])) echo $_POST['DImfi'] ?>"/>
	<span class="error"> * <?php echo $dipError[4] ;?></span>
	  Degree:	<input type="text" name="DEmfi" value="<?php if(isset($_POST['DEmfi'])) echo $_POST['DEmfi'] ?>"/>
	  <span class="error"> * <?php echo $dipError[5] ;?></span></p>
	
	<p>MIAT </p> 
	<p>Diploma:	<input type="text" name="DImiat" value="<?php if(isset($_POST['DImiat'])) echo $_POST['DImiat'] ?>"/>
	<span class="error"> * <?php echo $dipError[6] ;?></span>
	 Degree:	<input type="text" name="DEmiat" value="<?php if(isset($_POST['DEmiat'])) echo $_POST['DEmiat'] ?>"/>
	 <span class="error"> * <?php echo $dipError[7] ;?></span></p>
	
	<p>MICET</p> 
	<p>Diploma:	<input type="text" name="DImicet" value="<?php if(isset($_POST['DImicet'])) echo $_POST['DImicet'] ?>"/>
	<span class="error"> * <?php echo $dipError[8] ;?></span>
	Degree:		<input type="text" name="DEmicet" value="<?php if(isset($_POST['DEmicet'])) echo $_POST['DEmicet'] ?>"/>
	<span class="error"> * <?php echo $dipError[9] ;?></span></p>
	
	<p>MSI</p> 
	<p>Diploma:	<input type="text" name="DImsi" value="<?php if(isset($_POST['DImsi'])) echo $_POST['DImsi'] ?>"/>
	<span class="error"> * <?php echo $dipError[10] ;?></span>
	  Degree:	<input type="text" name="DEmsi" value="<?php if(isset($_POST['DEmsi'])) echo $_POST['DEmsi'] ?>"/>
	  <span class="error"> * <?php echo $dipError[11] ;?></span></p>
	
	<p>RCMP</p> 
	<p>Diploma:	<input type="text" name="DIrcmp" value="<?php if(isset($_POST['DIrcmp'])) echo $_POST['DIrcmp'] ?>"/>
	<span class="error"> * <?php echo $dipError[12] ;?></span>
	 Degree:	<input type="text" name="DErcmp" value="<?php if(isset($_POST['DErcmp'])) echo $_POST['DErcmp'] ?>"/>
	 <span class="error"> * <?php echo $dipError[13] ;?></span><p>
	
	<p><input type="submit" name="c1" value="Input"/></p>
	</form>
	</body>