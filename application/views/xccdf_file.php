<?php 
function booleanValue($param){
  return filter_var( $param, FILTER_VALIDATE_BOOLEAN);
}

$device_secure_boolean = booleanValue($device_secure);
$bluetooth_boolean = booleanValue($bluetooth);
$nfc_boolean = booleanValue($nfc);
$gps_boolean = booleanValue($gps);
$wifi_hostpot_boolean = booleanValue($wifi_hostpot);
$power_save_boolean = booleanValue($power_save);
$airplane_mode_boolean = booleanValue($airplane_mode);
$touched_sound_boolean = booleanValue($touched_sound);
$dtmf_tone_boolean = booleanValue($dtmf_tone);
$haptic_feedback_boolean = booleanValue($haptic_feedback);
$lock_screen_sounds_boolean = booleanValue($lock_screen_sounds);
//screen_off_timeout
$text_show_password_boolean = booleanValue($text_show_password);
//lock_screen_after

$strXML='<?xml version="1.0" encoding="utf-8"?>'; 
$strXML.="<?xml-stylesheet type='text/xsl' href='STIG_unclass.xsl'?>";    
$strXML.='<Benchmark xmlns:dsig="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:cpe="http://cpe.mitre.org/language/2.0" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:dc="http://purl.org/dc/elements/1.1/" id="Google_Android_9-x_STIG" xml:lang="en" xsi:schemaLocation="http://checklists.nist.gov/xccdf/1.1 http://nvd.nist.gov/schema/xccdf-1.1.4.xsd http://cpe.mitre.org/dictionary/2.0 http://cpe.mitre.org/files/cpe-dictionary_2.1.xsd" xmlns="http://checklists.nist.gov/xccdf/1.1">';

$date = date('Y-m-d');

$strXML.= '<status date="'.$date.'">accepted</status>
<title>Configuración Segura de Android 9 SDK: 28,29</title>
<description>Reporte de configuración segura de sistema Android en base a la guía CCN-STIC 453E.</description>
<notice id="terms-of-use" xml:lang="en"></notice>
<plain-text id="release-info">Release: 1 Benchmark Date: 10 Dec 2019</plain-text>
<version>1</version>';

$strXML.='<Profile id="validacion">
<title>Validacion en base a la Guia CCN-STIC 453E</title>';
if(!$device_secure_boolean)
   $strXML.='<select idref="no_codigo_de_acceso" selected="true"/>';

if($bluetooth_boolean)
  $strXML.='<select idref="bluetooth_activo" selected="true"/>';

if($nfc_boolean)
  $strXML.='<select idref="nfc_activo" selected="true"/>';

if($gps_boolean)
  $strXML.='<select idref="gps_activo" selected="true"/>';

if($wifi_hostpot_boolean)
  $strXML.='<select idref="zona_wifi_activo" selected="true"/>';

if(!$power_save_boolean)
  $strXML.='<select idref="ahorro_bateria_desactivado" selected="true"/>';

if($airplane_mode_boolean)
  $strXML.='<select idref="modo_avion_activado" selected="true"/>';

if($touched_sound_boolean)
  $strXML.='<select idref="tonos_teclado_activado" selected="true"/>';

if($dtmf_tone_boolean)
  $strXML.='<select idref="tonos_tactiles_teclado_marcacion_activado" selected="true"/>';

if($haptic_feedback_boolean)
  $strXML.='<select idref="vibrar_al_tocar_activado" selected="true"/>';

if($lock_screen_sounds_boolean)
  $strXML.='<select idref="sonido_al_bloquear_pantalla_activado" selected="true"/>';

if($screen_off_timeout==="2")
  $strXML.='<select idref="suspender_despues_de_activado" selected="true"/>';

if($haptic_feedback_boolean)
  $strXML.='<select idref="mostrar_contrasena" selected="true"/>';

if($lock_screen_after === "30")
  $strXML.='<select idref="bloquear_pantalla" selected="true"/>';

$strXML.='</Profile>';

$strXML.= '<Group id="validation_group">
    <title>Lista de verificacion Android 9</title>
    <description>Lista de verificacion basada en la Guia CCN-STIC 453E</description>';

if(!$device_secure_boolean){
$strXML.= '<Rule id="no_codigo_de_acceso" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Código de acceso</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 7</ident>
    </Rule>';
  }

if($bluetooth_boolean){
$strXML.='<Rule id="bluetooth_activo" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Bluetooth</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 7</ident>
    </Rule>';
}

if($nfc_boolean){
$strXML.='<Rule id="nfc_activo" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>NFC</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 7, 13.2</ident>
    </Rule>';
}

if($gps_boolean){
$strXML.='<Rule id="gps_activo" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>GPS</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 7, 10.3, 12.3, 16.3</ident>
    </Rule>';
}

if($wifi_hostpot_boolean){
$strXML.='<Rule id="zona_wifi_activo" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Zona WIFI (Hostpot)</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 8.3</ident>
    </Rule>';
}

if(!$power_save_boolean){
$strXML.='<Rule id="ahorro_bateria_desactivado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Ahorro de energía</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 8.3, 9.2</ident>
    </Rule>';
}

if($airplane_mode_boolean){
$strXML.='<Rule id="modo_avion_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Modo avión</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 12.1</ident>
    </Rule>';
}

if($touched_sound_boolean){
$strXML.='<Rule id="tonos_teclado_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Tonos del Teclado</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 9.4</ident>
    </Rule>';
  }

if($dtmf_tone_boolean){
$strXML.='<Rule id="tonos_tactiles_teclado_marcacion_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Tonos táctiles del teclado de marcación</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 9.4</ident>
    </Rule>';
  }

if($haptic_feedback_boolean){
$strXML.='<Rule id="vibrar_al_tocar_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Vibrar al tocar</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 9.4</ident>
    </Rule>';
}

if($lock_screen_sounds_boolean){
$strXML.='<Rule id="sonido_al_bloquear_pantalla_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Sonido al bloquear pantalla</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulo 9.4</ident>
    </Rule>';
}

if($screen_off_timeout!=="2"){
$strXML.='<Rule id="suspender_despues_de_activado" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Suspender después de</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 9.2, 9.3, 10.1, 15.1</ident>
    </Rule>';
  }

if($haptic_feedback_boolean){
$strXML.='<Rule id="mostrar_contrasena" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Mostrar contraseñas</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 7, 9, 10.1, 10.1.3</ident>
    </Rule>';
  }

if($lock_screen_after !== "30"){
$strXML.='<Rule id="bloquear_pantalla" selected="true" weight="10.0" prohibitChanges="false" abstract="false" role="full" severity="high">
    <title>Bloquear pantalla</title>
    <ident system="ttps://www.ccn-cert.cni.es/series-ccn-stic/guias-de-acceso-publico-ccn-stic/3040-ccn-stic-453e-seguridad-de-dispositivos-moviles-android-7-x.html">Capitulos 9, 10.1</ident>
    </Rule>';
}

$strXML.='</Group>';
  
  $strXML .='</Benchmark>';
echo $strXML;
?>
