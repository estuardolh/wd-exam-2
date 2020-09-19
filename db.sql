CREATE DATABASE empresa;
USE empresa;

CREATE TABLE BANCOS (
  codigo_empresa varchar(10),
  codigo_cuenta_bancaria varchar(10),
  nombre_cuenta_bancaria varchar(100),
  anulado varchar(2),
  fecha_anulado date
);

CREATE TABLE ESTADO_CUENTA (
  codigo_empresa varchar(10),
  codigo_cuenta_bancaria varchar(10),
  fecha_transaccion date,
  tipo_documento varchar(30),
  numero_documento varchar(10),
  valor_documento double,
  anulado varchar(2),
  fecha_anulado date
);
