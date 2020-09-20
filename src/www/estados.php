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
$consulta = "SELECT * FROM ESTADO_CUENTA";
$resultado = mysqli_query( $conexion, $consulta ) or die ( "Consulta fallida.");


if($_POST['accion'] === 'agregar'){
  $anuladoValue = 'N';
  if(isset($_POST['anulado'])){
    $anuladoValue = $_POST['anulado'];
  }

  $insert = "insert into ESTADO_CUENTA values ('". $_POST['codigo_empresa']
    ."', '". $_POST['codigo_cuenta_bancaria']
    ."', str_to_date('".$_POST['fecha_transaccion']."', '%Y-%m-%d')"
    .", '".$_POST['tipo_documento']
    ."', '".$_POST['numero_documento']
    ."', ".$_POST['valor_documento']
    .", '".$_POST['anulado']
    ."', str_to_date('".$_POST['fecha_anulado']."', '%Y-%m-%d'));";
  mysqli_query( $conexion, $insert);

  header('Location: /estados.php');
}else if($_POST['accion'] === 'eliminar'){
  $delete = "DELETE FROM ESTADO_CUENTA WHERE codigo_cuenta_bancaria = '".$_POST['codigo_cuenta_bancaria']."';";
  mysqli_query( $conexion, $delete);

  header('Location: /estados.php');

}

echo "<html>";
echo "<head>";
echo "<title>Estados</title>";
echo "<link rel=\"stylesheet\" href=\"estilo.css\" type=\"text/css\">";
echo "</head>";
echo "<body>";
echo "<h1>Listado de Estados de Cuenta</h1>";
echo "<table border='1'>";
echo "<tr>";
echo "<th>Codigo de empresa</th>";
echo "<th>Codigo de Cuenta Bancaria</th>";
echo "<th>Fecha de transaccion</th>";
echo "<th>Tipo de documento</th>";
echo "<th>Numero de documento</th>";
echo "<th>Valor de documento</th>";
echo "<th>Anulado</th>";
echo "<th>Fecha de Anulado</th>";
echo "<th></th>";
echo "</tr>";

while ($columna = mysqli_fetch_array( $resultado ))
{
  echo "<tr>";
  echo "<td>" . $columna['codigo_empresa'] . "</td><td>" . $columna['codigo_cuenta_bancaria'] . "</td>"."<td>" . $columna['fecha_transaccion'] . "</td>"."<td>" . $columna['tipo_documento'] . "</td>"."<td>" . $columna['numero_documento'] . "</td>"."<td>" . $columna['valor_documento'] . "</td>"."<td>" . $columna['anulado'] . "</td>"."<td>" . $columna['fecha_anulado'] . "</td>"."<td><form method=\"POST\" action=\"estados.php\"><input name=\"accion\" type=\"hidden\" value=\"eliminar\"><input type=\"hidden\" name=\"codigo_cuenta_bancaria\" value=\"" . $columna['codigo_cuenta_bancaria'] . "\"><input type=\"submit\" value=\"Eliminar\"></form></td>";
  echo "</tr>";
}
echo "</table>";

echo "<h1>Agregar Estados de Cuenta</h1>";
echo "<form method=\"POST\" action=\"estados.php\">";
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
echo "Codigo de empresa";
echo "</td>";
echo "<td>";
echo "<select name=\"codigo_empresa\"><option value=\"003\">003</option><option value=\"004\">004</option></select>";
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
echo "Fecha transaccion";
echo "</td>";
echo "<td>";
echo "<input type=\"date\" name=\"fecha_transaccion\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Tipo de documento";
echo "</td>";
echo "<td>";
echo "<select name=\"tipo_documento\"><option value=\"CHEQUE\">Cheque</option><option value=\"DEPOSITO\">Deposito</option><option value=\"NOTA_DEBITO\">Nota de debito</option><option value=\"NOTA_CREDITO\">Nota de credito</option></select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Numero de documento";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" name=\"numero_documento\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Valor de documento";
echo "</td>";
echo "<td>";
echo "<input type=\"number\" name=\"valor_documento\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Anulado";
echo "</td>";
echo "<td>";
echo "<input type=\"checkbox\" value=\"S\" name=\"anulado\">";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Fecha de anulacion";
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
echo "</body>";
echo "</html>";

mysqli_close( $conexion );
?>
