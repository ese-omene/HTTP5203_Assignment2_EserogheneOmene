<?php
$username = "";
$password = "";
$userError = "";
if(isset($_POST['formSubmit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "" || $password == ""){
        $userError = "please  complete the form";
    } else {

        $xmldoc = new DOMDocument();


        //nice formatting
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc -> formatOutput = true;

        //load my xml file
        $xmldoc -> load('users.xml');
        $xPath = new DOMXPath($xmldoc);

        $users = $xmldoc->getElementsByTagName('users');
        foreach ($users as $user){
           print "<div>" .$user->getAttribute('title').'</div>';
        }




        $query = "users/user[username='$username'and password='$password'] ";
        $login = $xPath->query($query);

















    }
}
?>
<form action='' method='post'>
    <fieldset>
        <legend>Enter Username and Password</legend>

        <h3><label for='username'>Username:</label>
            <input type='text'  name='username'/></h3>


        <h3><label for='password'>Password:</label>
            <input type='text' name='password'/></h3>

        <span style='color:red;'> <?= $userError ?></span>


    </fieldset>
    <p><input type='submit' value='Submit' name='formSubmit'></p>
</form>