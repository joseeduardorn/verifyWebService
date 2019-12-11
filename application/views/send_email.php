<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="Verify API">
  	<meta name="author" content="Verify">
	<title>Reporte</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/style/vendor/bootstrap/css/bootstrap.min.css">

</head>

<body class="bg-light">

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Reporte de seguridad del dispoistivo : <strong> <?php echo $device_name; ?></strong></h4>
  <p>Configuración segura de sistema Android en base a la guía <strong><a target="_blank" href="https://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">CCN-STIC 453E</a></strong>. <a href="<?php echo base_url();?>api/view/<?php echo $hash_encode?>"> Ver en linea</a></p>

  <hr>
  <p class="mb-0">Puede descargar el archivo en formato XCCDF de SCAP <a class="btn btn-success" href="<?php echo base_url();?>api/download/<?php echo $hash_encode;?>">aqui</a></p>
</div>
<br/>
<div>
	<div class="alert alert-secondary" role="alert">
		<h2>Informacion General</h2>
	</div>
	<table class="table">
		<tr>
			<td>Nombre del dispositivo</td>
			<td><?php echo $device_name; ?> </td>
		</tr>
		<tr>
			<td>Nombre de Bluetooth</td>
			<td><?php echo $bluetooth_name;?> </td>
		</tr>
		<tr>
			<td>Asistente de voz</td>
			<td><?php echo $voice_assistant;?> </td>
		</tr>
		<tr>
			<td>Informacion DHCP</td>
			<td><?php echo $dhcp_info; ?> </td>
		</tr>
		<tr>
			<td>Version de Android</td>
			<td><?php echo $device_android_version; ?> </td>
		</tr>
		<tr>
			<td>Version SDK</td>
			<td><?php echo $device_android_sdk; ?> </td>
		</tr>
	</table>
	<div class="alert alert-secondary" role="alert">
	  <h4>Consejos</h4>
	  <ol>
		  <li>Se recomienda cambiar el "Nombre del dispositivo"a uno que no represente ni el modelo ni la versión de Android, a fin de no  desvele  información  en  las  conexiones  que  podría  ser  utilizada  por  un  potencial atacante para explotar vulnerabilidades conocidas</li>
		  <li>Cambiar el nombre Bluetooth del dispositivo para evitar revelar información sobre el tipo  y  modelo  de  dispositivo  a  través  del  menú "Ajustes -Dispositivos conectados -Preferencias  de  conexión -Bluetooth -Nombre  del dispositivo</li>
		  <li>Desde  el  punto  de  vista  de  seguridad,se  aconseja  hacer  uso  de  la  opción  "DNS privado" para evitar ataquesde suplantación entre el dispositivo móvil y su resolver.</li>
	  </ol>
	</div>
</div>
	
<div class="alert alert-secondary" role="alert">
	<h2>Verificar Configuración</h2>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Componente</th>
      <th scope="col">Estado Actual</th>
      <th scope="col">Estado Optimo</th>
      <th scope="col">Descricion</th>
    </tr>
  </thead>
  <?php $habilitado = 'Habilitado'; $desabilitado = 'Desabilitado';?>
  <tbody>
    <tr>
      <td>Codigo de acceso</td>
      <td><?php if( filter_var( $device_secure, FILTER_VALIDATE_BOOLEAN) ){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Habilitado</td>
      <td>Establecerun código de acceso PIN/PASS/PATTERN</td>
    </tr>
    <tr>
      <td>Bluetooth</td>
      <td><?php if(filter_var( $bluetooth, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Desactivarlos interfaces inalámbricos de los que no se esté haciendo uso: Wi-Fi, Bluetooth, NFC y datos móviles, que quedan habilitados por defecto tras el proceso  de instalación, aunque  no  se  haya  hecho  uso  de  ellos</td>
    </tr>
    <tr>
      <td>NFC</td>
      <td><?php if(filter_var($nfc, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se aconseja habilitar el interfaz NFC solo en el momento de hacer uso de él, y proceder a desactivarlo seguidamente.</td>
    </tr>
    <tr>
      <td>GPS</td>
      <td><?php if(filter_var($gps, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Desactivar la ubicación.Un ejemplo es el permiso de ubicación para la app "Fotos", que Google incluye para  permitir  la  incorporación  de  coordenadas  geográficas  en  las  fotografías,  opción desaconsejada desde el punto de vista de privacidad</td>
    </tr>
    <tr>
      <td>Zona WIFI (Hotspot)</td>
      <td><?php if(filter_var($wifi_hostpot, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda  desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Ahorro de energia</td>
      <td><?php if(filter_var($power_save, FILTER_VALIDATE_BOOLEAN) ){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Habilitado</td>
      <td>Se  recomienda  activar  este  modo  para  prolongar  la  vida  de  la batería</td>
    </tr>
    <tr>
      <td>Modo avion</td>
      <td><?php if(filter_var($airplane_mode, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Tonos del teclado</td>
      <td><?php if(filter_var($touched_sound, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Tonos táctiles del teclado de marcación</td>
      <td><?php if(filter_var($dtmf_tone, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Vibrar al tocar</td>
      <td><?php if(filter_var($haptic_feedback, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Sonido al bloquear pantalla</td>
      <td><?php if(filter_var($lock_screen_sounds, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Suspender despues de</td>
      <td><?php echo $screen_off_timeout; ?></td>
      <td>2 minutos</td>
      <td>"Suspender después de <X>": este parámetro (que puede tomar valor de [15 segundos,  30  segundos,  1,  2,  5,  10  ó  30  minutos]  determina  cuándo  se apagará la pantalla tras el tiempo de inactividad definido, y es muy relevante por   influenciar   directamente   el   ajuste   "Bloquear  automáticamente",   que bloquea  el  dispositivo  móvil  hasta  la  introducción  del códigode  acceso definido.  Buscando  el  equilibrio entre  seguridad  y  usabilidad, se  recomienda  fijarlo  a  un  máximo  de  1  ó  2 minutos,   pero su   valor dependeráde   la   política   de   seguridad   de   la organización y/o el usuario.</td>
    </tr>
    <tr>
      <td>Mostrar contraseñas</td>
      <td><?php if(filter_var($text_show_password, FILTER_VALIDATE_BOOLEAN)){echo $habilitado;}else{ echo $desabilitado;} ?></td>
      <td>Desabilitado</td>
      <td>Se recomienda desactivar este ajuste</td>
    </tr>
    <tr>
      <td>Bloquear pantalla </td>
      <td><?php echo $lock_screen_after; ?></td>
      <td>30 segundos</td>
      <td>El  rango razonable   para   "Suspender  después  de",   buscando   el   equilibrio   entre seguridad  y  usabilidad,  es  de  1  ó  2  minutos,  pero debe  ser  definido  por  la política  de  seguridad  de  la  organización  propietaria  del  dispositivomóvil.  El valor  para  "Bloquear automáticamente"  se  aconseja  que  sea  de entre 5 y  30 segundos.</td>
    </tr>
  </tbody>
</table>
</body>