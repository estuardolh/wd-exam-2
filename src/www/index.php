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


echo "<h1>Listado de Bancos</h1>";
echo "<table border='1'>";
echo "<tr>";
echo "<th>Codigo empresa</th>";
echo "<th>Codigo cuenta bancaria</th>";
echo "<th>Nombre cuenta bancaria</th>";
echo "<th>Anulado</th>";
echo "<th>Fecha anulado</th>";
echo "</tr>";

while ($columna = mysqli_fetch_array( $resultado ))
{
  echo "<tr>";
  echo "<td>" . $columna['codigo_empresa'] . "</td><td>" . $columna['codigo_cuenta_bancaria'] . "</td>"."<td>" . $columna['nombre_cuenta_bancaria'] . "</td>"."<td>" . $columna['anulado'] . "</td>"."<td>" . $columna['fecha_anulado'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close( $conexion );
?>
