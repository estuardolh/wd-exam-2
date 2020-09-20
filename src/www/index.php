<?php
// Datos de la base de datos
$usuario = "root";
$password = "7azleeb2hJDv";
$servidor = "localhost";
$basededatos = "empresa";

// creación de la conexión a la base de datos con mysql_connect()
$conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("Sin conexion a bd.");

// Selección del a base de datos a utilizar
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Db no encontrada." );

// establecer y realizar consulta. guardamos en variable.
$consulta = "SELECT * FROM BANCOS";
$resultado = mysqli_query( $conexion, $consulta ) or die ( "Consulta fallida.");


if($_POST['accion'] === 'agregar'){
  $anuladoValue = 'N';
  if(isset($_POST['anulado'])){
    $anuladoValue = $_POST['anulado'];
  }

  $insert = "insert into BANCOS values ('". $_POST['codigo_empresa']
    ."', '". $_POST['codigo_cuenta_bancaria']
    ."', '".$_POST['nombre_cuenta_bancaria']
    ."', '".$anuladoValue
    ."', str_to_date('".$_POST['fecha_anulado']."', '%Y-%m-%d'));";
  mysqli_query( $conexion, $insert);

  header('Location: /');
}else if($_POST['accion'] === 'eliminar'){
  $delete = "DELETE FROM BANCOS WHERE codigo_cuenta_bancaria = '".$_POST['codigo_cuenta_bancaria']."';";
  mysqli_query( $conexion, $delete);

  header('Location: /');

}

echo "<h1>Listado de Bancos</h1>";
echo "<table border='1'>";
echo "<tr>";
echo "<th>Codigo empresa</th>";
echo "<th>Codigo cuenta bancaria</th>";
echo "<th>Nombre cuenta bancaria</th>";
echo "<th>Anulado</th>";
echo "<th>Fecha anulado</th>";
echo "<th></th>";
echo "</tr>";

while ($columna = mysqli_fetch_array( $resultado ))
{
  echo "<tr>";
  echo "<td>" . $columna['codigo_empresa'] . "</td><td>" . $columna['codigo_cuenta_bancaria'] . "</td>"."<td>" . $columna['nombre_cuenta_bancaria'] . "</td>"."<td>" . $columna['anulado'] . "</td>"."<td>" . $columna['fecha_anulado'] . "</td>"."<td><form method=\"POST\"><input name=\"accion\" type=\"hidden\" value=\"eliminar\"><input type=\"hidden\" name=\"codigo_cuenta_bancaria\" value=\"" . $columna['codigo_cuenta_bancaria'] . "\"><input type=\"submit\" value=\"Eliminar\"></form></td>";
  echo "</tr>";
}
echo "</table>";

echo "<h1>Agregar Bancos</h1>";
echo "<form method=\"POST\">";
echo "<table>";

echo "<tr>";
echo "<td>";
echo "</td>";
echo "<td>";
echo "<input name=\"accion\" type=\"hidden\" value=\"agregar\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Codigo empresa";
echo "</td>";
echo "<td>";
echo "<select name=\"codigo_empresa\"><option value=\"001\">001</option><option value=\"002\">002</option></select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Codigo cuenta bancaria";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" name=\"codigo_cuenta_bancaria\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Nombre de la cuenta";
echo "</td>";
echo "<td>";
echo "<textarea name=\"nombre_cuenta_bancaria\" rows=\"4\"></textarea>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Anulado";
echo "</td>";
echo "<td>";
echo "<input type=\"checkbox\" name=\"anulado\" value=\"S\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Fecha anulado";
echo "</td>";
echo "<td>";
echo "<input type=\"date\" name=\"fecha_anulado\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<input type=\"submit\" value=\"Agregar\">";
echo "</td>";
echo "</tr>";

echo "</table>";


mysqli_close( $conexion );
?>
