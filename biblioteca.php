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
$usuario = "root";
$contra = "";
//$usuario = "miguel";//usuario creado en portatil personal
//$contra = "Barbara123";//usuario creado en portatil personal
$basededatos = "biblioteca";
$mysqli = new mysqli($host,$usuario,$contra,$basededatos);//con esta linea nos estamos conectando a la base de datos.
if (!$mysqli){//Por si no funciona la conexión.
    die("No funciona la conexión");
}
$mysqli->set_charset("utf8");//le damos utf8 a los valores que nos vienen de la base de datos.
//termina la parte de codigo;

/*while($row = $cursor->fetch_assoc()){//El while se recorre hasta la ultima linea y el cursor se queda en la ultima posicion y no
    // avanza. fetch_assoc() convierte el cursor en una array asociativa para poder usar el cursor.
    echo "<tr>";
        echo "<td>".$row["ID_AUT"]."</td>";
        echo "<td>".$row["NOM_AUT"]."</td>";
    echo "</tr>";
}*/


if (isset($_POST['enviar'])){ //boton del formulario y crea la variable que viene del select
    $ordenacion = (isset($_POST['ordenacion']))?$_POST['ordenacion']:"";//viene del formulario del select
    switch ($ordenacion){
        case "ID_AUT_ASC":
            $orden = "ID_AUT ASC";
            break;
        case "ID_AUT_DESC":
            $orden = "ID_AUT DESC";
            break;
        case "NOM_AUT_ASC":
            $orden = "NOM_AUT ASC";
            break;
        case "NOM_AUT_DESC":
            $orden = "NOM_AUT DESC";
            break;
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Biblioteca</title>
    <style>
        table{
            text-align: center;
        }
    </style>
    <script>

        function valorSelect(){

        }
        window.onload = function(){

        }
    </script>
</head>
<body>
<header><!--Cabecera con nombre y logotipo-->
    <img src="logo.jpg" alt="Pau Casesnoves" width="150" height="120">
    <h1>Pau Casesnoves</h1>
</header>
<form action="biblioteca.php" method="post">
    <select name="ordenacion" id="ordenacion">
        <option value="ID_AUT_ASC">Codi Asc</option>
        <option value="ID_AUT_DESC">Codi Desc</option>
        <option value="NOM_AUT_ASC">Nom Asc</option>
        <option value="NOM_AUT_DESC">Nom Desc</option>
    </select>
    <input type="submit" name="enviar" id="enviar">
</form>
<?php

if (isset($orden)){
    $sql = "select ID_AUT, NOM_AUT from AUTORS order by $orden";
    $cursor = $mysqli->query($sql) or die($sql);//creamos el cursor.
    echo "<table>";
    echo "<tr>";
    echo "<th>Codi</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    while($row = $cursor->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["ID_AUT"]."</td>";
        echo "<td>".$row["NOM_AUT"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}else{
    $sql = "select ID_AUT, NOM_AUT from AUTORS order by  ID_AUT asc ";
    $cursor = $mysqli->query($sql) or die($sql);//creamos el cursor.
    echo "<table>";
    echo "<tr>";
    echo "<th>Codi</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    while($row = $cursor->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["ID_AUT"]."</td>";
        echo "<td>".$row["NOM_AUT"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>
</body>
</html>
