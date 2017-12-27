<?php 
/*En las rutas creamos dos grupos /api y /v1. Esto lo hicimos ya que podrá ser útil a un futuro para manejar diferentes API's ó manejar diferentes versiones de las API's existentes.*/
// Routes
// Grupo de rutas para el API
$app->group('/api', function () use ($app) {
  // Version group
  $app->group('/v1', function () use ($app) {
    $app->get('/saldo-rol/{telefono}', 'obtenerSaldoYRol');
    $app->get('/saldo/{telefono}', 'obtenerSaldo');
    //$app->post('/crear', 'agregarEmpleado');
    $app->put('/actualizar/{telefono}', 'actualizarSaldo');
    //$app->delete('/eliminar/{id}', 'eliminarEmpleado');
  });
});
?>