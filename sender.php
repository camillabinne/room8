<?
if (!empty($_POST['subject'])) {
  header ("Location: blokeret.php");
 exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>

<?php
if (isset($_POST['submit']))
{
 if (!empty($_POST['name']) && // tjek, at der er skrevet et navn
 !empty($_POST['email']) &&    // tjek, at der er skrevet en e-mail-adresse
 !empty($_POST['emne']) &&  // tjek, at der er skrevet et emne
 !empty($_POST['besked']) &&  // tjek, at der er skrevet en besked
 !empty($_POST['adresse']) &&  // tjek, at der er skrevet en addresse
 !empty($_POST['telefonnummer']) &&  // tjek, at der er skrevet et telefonnummer

// her følger sikringen mod spambotter
 !strpos($_POST['name'], "room8.camillabinne.dk") &&  // tjek, at dit domæne ikke er skrevet i feltet "navn"
 !strpos($_POST['email'], "room8.camillabinne.dk") && // tjek, at dit domæne ikke er skrevet i feltet "email"
 !strpos($_POST['name'], "@") &&  // tjek, at der ikke er et @ i "navn"
 !preg_match('/\r/',$_POST['name']) && // tjek, at der ikke er "vogn-retur" i "navn"
 !preg_match('/\n/',$_POST['name']) &&  // tjek, at der ikke er "linjeskift" i "navn"
 !preg_match('/\r/',$_POST['email']) &&  // tjek, at der ikke er "vogn-retur" i "email"
 !preg_match('/\n/',$_POST['email']))  // tjek, at der ikke er "linjeskift" i "email"

// er alt ok, fortsættes med afsendelse af mailen
 {
  $headers="From: ".$_POST['name']."<".$_POST['email'].">";
  if (@$_POST['customer_copy'])
  {
   $headers .= "\r\nBcc: ".$_POST['email'];
  }
  $body .= "Den " . date("d/m y") . " kl. " . date("G:i") . " skrev " . $_POST['name'] . $_POST['adresse'] . $_POST['telefonnummer'] . ":\r\n\r\n" . $_POST['besked'];
  if (@mail("cami001h@edu.easj.dk", strip_tags($_POST['emne']),
  stripslashes(strip_tags($body)), $headers))
  {
   echo "<p>Tak for din henvendelse. Jeg svarer så hurtigt som muligt.</p>";
  }
  else
  {
   echo "<p>E-mailen blev ikke sendt. Der skete en fejl. Prøv igen!</p>";
  }
 }
 else
 {
  echo "<p>Mailen kunne ikke sendes, alle felter skal udfyldes korrekt!</p>";
 }
}
?>

</body>
</html>