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
$buscador = "";
$pagina = 1;

if (isset($_POST['buscador'])){
    $buscador = $mysqli->real_escape_string($_POST['buscador']);   
}


if (isset($_POST['enviar'])){ //boton del formulario y crea la variable que viene del select
    $ordenacion = isset($_POST['ordenacion'])?$_POST['ordenacion']:"";//viene del formulario del select
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
}else{
    $orden = "ID_AUT ASC";
}
$tuplasPagina = 20;
$sqlT = "select count(*) as numTuplas from AUTORS where NOM_AUT like '%$buscador%' or ID_AUT like '%$buscador%'";
$resultado = $mysqli -> query($sqlT) or die($sqlT);
if ($row = $resultado-> fetch_assoc()){
    $totalTuplas = $row['numTuplas'];
    $totalPaginas = ceil($totalTuplas/$tuplasPagina);//rendondea a lo alto ceil.
}
if (isset($_POST['pagina'])){
    if (isset($_POST['botonBuscador']) || isset($_POST['enviar'])) {
        $pagina = 1;
    }else{
        $pagina = $_POST['pagina'];
    } 
}
if (isset($_POST['siguiente'])){
    if ($pagina < $totalPaginas){
        $pagina++;
         $ordenacion = isset($_POST['ordenacion'])?$_POST['ordenacion']:"";//viene del formulario del select
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
}
if (isset($_POST['primero'])){
    $pagina = 1;
     $ordenacion = isset($_POST['ordenacion'])?$_POST['ordenacion']:"";//viene del formulario del select
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
if (isset($_POST['anterior'])){
    if ($pagina > 1){
        $pagina--;
         $ordenacion = isset($_POST['ordenacion'])?$_POST['ordenacion']:"";//viene del formulario del select
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
}
if (isset($_POST['ultimo'])){
    $pagina = $totalPaginas;
     $ordenacion = isset($_POST['ordenacion'])?$_POST['ordenacion']:"";//viene del formulario del select
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
if (isset($_POST['bEnviarNombre'])) {
    $anadir = $mysqli->real_escape_string($_POST['nombreAnadir']);
    $sql = "insert into autors(id_aut,nom_aut) values((select max(id_aut)+1 from autors as total),'$anadir') ";
    $resultado = $mysqli->query($sql) or die($sql);
}
if (isset($_POST['borrar'])) {
    $eliminar = $mysqli->real_escape_string($_POST['borrar']);
    $sql = "delete from autors where id_aut = $eliminar";
    $resultado  = $mysqli->query($sql) or die($sql);
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
        window.onload = function(){
            document.getElementById("ordenacion").value = "<?php
                    if (empty($ordenacion)){
                        echo "ID_AUT_ASC";
                    }else{
                        echo $ordenacion;
                    }
                ?>"
            var divAnadir = document.getElementById("formAnadir");
            divAnadir.style.display = "none";
            var anadir = document.getElementById("anadir");
            var cancelarNombre = document.getElementById("bCancelarNombre");
            anadir.onclick = function(){
                divAnadir.style.display = "block";
                anadir.style.display = "none";
            }
            cancelarNombre.onclick = function(){
                divAnadir.style.display = "none";
                anadir.style.display = "";
            }
        }
    </script>
</head>
<body>
<header><!--Cabecera con nombre y logotipo-->
    <img src="logo.jpg" alt="Pau Casesnoves" width="150" height="120">
    <h1>Pau Casesnoves</h1>
</header>
<form action="biblioteca.php" method="post" id="formulario">
    <input type="text" name="buscador" id="buscador" value="<?php echo $buscador;?>">
    <button name="botonBuscador" id="botonBuscador">Buscar</button>
    <select name="ordenacion" id="ordenacion">
        <option value="ID_AUT_ASC">Codi Asc</option>
        <option value="ID_AUT_DESC">Codi Desc</option>
        <option value="NOM_AUT_ASC">Nom Asc</option>
        <option value="NOM_AUT_DESC">Nom Desc</option>
    </select>
    <input type="submit" name="enviar" id="enviar">
    <input type="hidden" name="pagina" value="<?php
        echo $pagina;
    ?>">
    <button name="primero">Primero</button>
    <button name="anterior">Anterior</button>
    <button name="siguiente">Siguiente</button>
    <button name="ultimo">Ultimo</button>
</form>
<hr>
<button type="button" id="anadir">Añadir</button>
<div id="formAnadir">
    <form action="" method="post">
        <label for="nombreAnadir">Nombre: </label>
        <input type="text" name="nombreAnadir" id="nombreAnadir"><br/>
        <p>
            <input type="submit" name="bEnviarNombre" id="bEnviarNombre">
            <input type="button" name="bCancelarNombre" id="bCancelarNombre" value="Cancelar">
        </p>
    </form>
</div>  
<hr>    
<?php
    //Necesito $buscador, $tuplasPagina, $tuplaInicial = ($pagina - 1) * $tuplasPagina;
    $tuplaInicial = ($pagina - 1) * $tuplasPagina;
    $sql = "select ID_AUT,NOM_AUT from AUTORS where ID_AUT like '%$buscador%' or NOM_AUT like '%$buscador%' order by $orden limit $tuplaInicial,$tuplasPagina";
    $cursor = $mysqli->query($sql) or die($sql);
    echo "<table>";
    echo "<tr>";
    echo "<th>Codi</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    while($row = $cursor->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["ID_AUT"]."</td>";
        echo "<td>".$row["NOM_AUT"]."</td>";
        echo "<td><button type='submit' name='editar' value='{$row["ID_AUT"]}'>Editar</button>&nbsp;&nbsp;<button type='submit' form='formulario' name='borrar' value='{$row["ID_AUT"]}'>Borrar</button></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<div>";
        echo $pagina."/".$totalPaginas;
    echo "</div>";
?>
</body>
</html>
