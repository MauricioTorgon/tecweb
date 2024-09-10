<?php
function esMultiploDe5y7($numero) {
if(isset($_GET['numero']))
{
    $num = $_GET['numero'];
    if ($num%5==0 && $num%7==0)
    {
        echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
    }
    else
    {
        echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
    }
}
}
?>

<h2>Ejemplo de POST</h2>
<form action="http://localhost/tecweb/practicas/p07/index.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>
<br>
<?php
function postear(){
if(isset($_POST["name"]) && isset($_POST["email"]))
    {
        echo $_POST["name"];
        echo '<br>';
        echo $_POST["email"];
    }
}
?>
