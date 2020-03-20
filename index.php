<?php
$username = "";
$password = "";
$userError = "";
if(isset($_POST['formSubmit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
     if ($username == ""){
         $userError = "please enter your username";
     } else {

         $xmldoc = new DOMDocument();

         //nice formatting
         $xmldoc->preserveWhiteSpace = false;
         $xmldoc -> formatOutput = true;

         //load my xml file
         $xmldoc->load('tickets.xml');


         //DOM list
         $tickets = $xmldoc->getElementsByTagName('ticket');
         var_dump($tickets);
         //print the XML FILE
         for ($i = 0; $i<$tickets->length; $i++){
             print '<div>'.$tickets->item($i)->getElementsByTagName('id')[$i]->textContent.'</div>';
             print '<div>'.$tickets->item($i)->getElementsByTagName('dateofissue')[$i]->textContent.'</div>';

         }


     }
}
?>
<form action='' method='post'>
    <fieldset>
        <legend>Enter Username and Password</legend>
        <h3><label for='username'>Username:</label>
            <input type='text' value=" " name='username'/></h3>
        <h3><label for='password'>Password:</label>
        <input type='text' value=" " name='password'/></h3>
        <span style='color:red;'> <?= $userError ?></span>


</fieldset>
<p><input type='submit' value='Submit' name='formSubmit'></p>
</form>