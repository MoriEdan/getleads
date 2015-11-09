<?php   
include("PulsePro.class.php");  
$pulse1 = new PulsePro('plus_minus');  
$pulse2 = new PulsePro('horizontal');  
$pulse3 = new PulsePro('inline');  
$pulse4 = new PulsePro("like"); 
$pulse5 = new PulsePro("triangle"); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GetLeads Feedback</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>

<?php  
echo PulsePro::css();  
echo PulsePro::javascript();  
?>  
</head>
<body>
<div id="wrapper">
  <h1>GetLeads Feeback Features</h1>
  <div>
    <h2>Plus Minus</h2>
	<?php echo $pulse1->buttons('Plus Minus', 150); ?>  

    <h2>Horizontal</h2>
	<?php echo $pulse2->buttons('Horizontal', 100); ?>  

    <h2>Inline</h2>
	<?php echo $pulse3->buttons('Inline', 100); ?>         
    
    <h2>Like</h2>
	<?php echo $pulse4->buttons('Like', 100); ?>      

    <h2>Triangle</h2>
	<?php echo $pulse5->buttons('Triangle', 100); ?>      
    
   </div>
</div>
</body>
</html>
