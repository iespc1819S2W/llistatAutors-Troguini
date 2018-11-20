<?php
//$orderby = "ID_OUT ASC";
/*if(isset($_POST['orde'])){
    $orderby = $_POST['orde'];
    }
$mysqli = set_charset('utf8');
}*/
/* $sql = select ID_AUT, NOM_AUT from autors order by $orderby;
$cursor = query($sql) or die($sql);
*/

//Conexion a base de datos
$host = "127.0.0.1";
//$usuario = "root";
//contra = "";
$usuario = "miguel";
$contra = "Barbara123";
$basededatos = "biblioteca";
$mysqli = new mysqli($host,$usuario,$contra,$basededatos);//con esta linea nos estamos conectando a la base de datos.
if (!$mysqli){//Por si no funciona la conexión.
    die("No funciona la conexión");
}
$mysqli->set_charset("utf8");//le damos utf8 a los valores que nos vienen de la base de datos.
//termina la parte de codigo;
$sql = "select ID_AUT, NOM_AUT from AUTORS order by  ID_AUT asc ";
$cursor = $mysqli->query($sql) or die($sql);//creamos el cursor.
while($row = $cursor->fetch_assoc()){//El while se recorre hasta la ultima linea y el cursor se queda en la ultima posicion y no
    // avanza. fetch_assoc() convierte el cursor en una array asociativa para poder usar el cursor.
    echo "<tr>";
        echo "<td>".$row["ID_AUT"]."</td>";
        echo "<td>".$row["NOM_AUT"]."</td><br>";
    echo "</tr>";
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Biblioteca</title>
</head>
<body>
<form action="biblioteca.php" method="post">
    <input type="submit" name="enviar">
</form>
</body>
</html>
