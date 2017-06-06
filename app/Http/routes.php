<?php

Route::any('/', 'front@index');
Route::any('guia', 'front@guia');
Route::any('crud', 'front@crud');
Route::any('componentes', 'front@componentes');

Route::any('registro', 'front@registro');
Route::any('registroProyecto', 'front@registroProyecto');
Route::any('registroEvaluador', 'front@registroEvaluador');
Route::any('recuperarContrasena', 'front@recuperarContrasena');
//vista de roles
Route::any('administrador', 'front@administrador');
Route::any('evaluador', 'front@evaluador');
Route::any('estudiante', 'front@estudiante');
//vistas de administrador
Route::any('consultaUsuarios', 'front@consultaUsuarios');
Route::any('consultaEvaluadores', 'front@consultaEvaluadores');
Route::any('consultaPeticiones', 'front@consultaPeticiones');
Route::any('consultaProyectos', 'front@consultaProyectos');
Route::any('asignarEvaluador', 'front@asignarEvaluador');
Route::any('configuracionPorcentajes', 'front@configuracionPorcentajes');
//vistas de evaluador
Route::any('realizarEvaluacion', 'front@realizarEvaluacion');
Route::any('evaluarModelado', 'front@evaluarModelado');
Route::any('evaluarPlataforma', 'front@evaluarPlataforma');
Route::any('crearCasoprueba', 'front@crearCasoprueba');
Route::any('detallesCasoprueba', 'front@detallesCasoprueba');
Route::any('historialPruebas', 'front@historialPruebas');
Route::any('escenarioCasoprueba', 'front@escenarioCasoprueba');
//View de estudiante
Route::any('verEvaluador', 'front@verEvaluador');
Route::any('subirDocumento', 'front@subirDocumento');
Route::any('verEvaluacion', 'front@verEvaluacion');
Route::any('evaluacionPlataforma', 'front@evaluacionPlataforma');
Route::any('evaluacionModelado', 'front@evaluacionModelado');
Route::any('detailsCasoprueba', 'front@detailsCasoprueba');
Route::any('resultadoCasoPrueba', 'front@resultadoCasoPrueba');

// metodos de crud
Route::resource('createCrud','nombre_controlador@create');
Route::any('crud', 'nombre_controlador@index');
Route::resource('update', 'nombre_controlador@update');
Route::resource('destroy', 'nombre_controlador@destroy');
//metodos de registro
Route::any('registroProyecto', 'usuarios@registroProyecto');
Route::resource('createProyecto','usuarios@create_proyetco');
Route::resource('createEvaluador','usuarios@create_evaluador');
Route::resource('loginUsuario','usuarios@login_leer');
Route::resource('cerrarSession','usuarios@cerrarSession');
Route::any('menuRol/{rol}','usuarios@menuRol');
//consulta usuario
Route::any('consultaUsuarios','usuarios@readUsuario');
Route::resource('deleteUsuario', 'usuarios@deleteUsuario');
Route::resource('updateUsuario', 'usuarios@updateUsuario');
// consulta evaluador
Route::any('consultaEvaluadores','usuarios@readEvaluador');
Route::resource('deleteEvaluador', 'usuarios@deleteEvaluador');
Route::resource('updateEvaluador', 'usuarios@updateEvaluador');
//consulta peticion
Route::any('consultaPeticiones','usuarios@readPeticion');
Route::resource('aceptarPeticion', 'usuarios@aceptarPeticion');
Route::resource('deletePeticion', 'usuarios@deletePeticion');
Route::resource('aceptarPeticionProyecto', 'usuarios@aceptarPeticionProyecto');
Route::resource('deletePeticionProyecto', 'usuarios@deletePeticionProyecto');
//ver y asignar proyecto
Route::any('consultaProyectos','usuarios@readProyecto');
Route::any('asignarEvaluador','usuarios@leerEvaluador');
Route::any('aceptarAsignacion','usuarios@aceptarAsignacion');
Route::any('desasignar','usuarios@desasignar');
//configuracion de porcentajes
Route::any('configuracionPorcentajes', 'usuarios@configuracionPorcentajes');
Route::any('actualizarPorcentaje', 'usuarios@actualizarPorcentaje');
Route::any('actualizarPrioridad', 'usuarios@actualizarPrioridad');
Route::any('actualizarModelo', 'usuarios@actualizarModelo');
// categorizacion
Route::any('categorizacion', 'usuarios@categorizacion');
Route::any('crearCategoria', 'usuarios@crearCategoria');

// ver datos admi
Route::any('datosAdministrador','usuarios@datosAdministrador');
Route::any('guardarClave','usuarios@guardarClave');
Route::any('actualizarDatosAdmi','usuarios@actualizarDatosAdmi');
Route::any('guardarImagenAdmi','usuarios@guardarImagenAdmi');
//  ver datos eva 
Route::any('datosEvaluador','usuarios@datosEvaluador');
Route::any('guardarClave','usuarios@guardarClave');
Route::any('actualizarDatos','usuarios@actualizarDatos');
Route::any('guardarImagen','usuarios@guardarImagen');
// ver datos est
Route::any('datosEstudiante','usuarios@datosEstudiante');
Route::any('guardarClaveEst','usuarios@guardarClaveEst');
Route::any('actualizarDatosEst','usuarios@actualizarDatosEst');
Route::any('guardarImagenEst','usuarios@guardarImagenEst');
//evaluar proyecto 
Route::any('verProyectos','usuarios@proyectosEvaluador');
Route::any('evaluarPlataforma','usuarios@readCasoPrueba');
Route::resource('createCasoPrueba','usuarios@createCasoPrueba');
Route::any('detallesCasoprueba','usuarios@detallesCasoprueba');
Route::any('historialPruebas', 'usuarios@historialPruebas');
Route::any('terminarEvaluacion', 'usuarios@terminarEvaluacion');
Route::any('nuevaEvaluacion', 'usuarios@nuevaEvaluacion');
Route::any('modificarCasoprueba','usuarios@modificarCasoprueba');

//reportes
Route::any('reporte_generalEva/{tipo}','reporteController@reporte_generalEva');
Route::any('reporte_generalEva_graficos/{tipo}','usuarios@reporte_generalEva_graficos');
Route::any('reporte_generalEva_ejemplo','usuarios@reporte_generalEva_ejemplo');
Route::any('reporte_final','reporteController@reporte_final');
Route::any('reporte_generalEst/{tipo}','reporteController@reporte_generalEst');
Route::any('reporte_gestionEva/{tipo}','reporteController@reporte_gestionEva');
Route::any('reporte_gestionEst/{tipo}','reporteController@reporte_gestionEst');
Route::any('reporte_modeladoEva/{tipo}','reporteController@reporte_modeladoEva');
Route::any('reporte_modeladoEst/{tipo}','reporteController@reporte_modeladoEst');

//escenario caso de prueba
Route::any('escenarioCasoprueba', 'usuarios@escenarioCasoprueba');
Route::resource('createPrueba','usuarios@createPrueba');
Route::resource('createPruebaCarga','usuarios@createPruebaCarga');
Route::resource('deletePrueba1', 'usuarios@deletePrueba1');
Route::resource('deletePrueba2', 'usuarios@deletePrueba2');
Route::resource('deletePruebaCarga1', 'usuarios@deletePruebaCarga1');
Route::resource('deletePruebaCarga2', 'usuarios@deletePruebaCarga2');
Route::resource('calificarPrueba', 'usuarios@calificarPrueba');
Route::any('ver', 'usuarios@verPrueba');
Route::any('verCarga', 'usuarios@verPruebaCarga');
Route::resource('guardarPrueba', 'usuarios@guardarPrueba');
Route::resource('calificarPruebaCarga','usuarios@calificarPruebaCarga');
Route::resource('cambiarFecha','usuarios@cambiarFecha');


//ver proyecto
Route::post('verEvaluador','usuarios@verEvaluador');
Route::any('evaluacionPlataforma','usuarios@leerCasoPrueba');
Route::any('detailsCasoprueba','usuarios@detailsCasoprueba');
Route::any('resultadoCasoPrueba','usuarios@resultadoCasoPrueba');

//recuperarContrasena
Route::any('recuperarPassword','usuarios@recuperarPassword');
//ejemplo sesiones
Route::any('paginauno','indexController@actionPaginauno');
Route::any('paginados','indexController@actionPaginados');
Route::any('paginatres','indexController@actionPaginatres');
Route::any('paginacuatro','indexController@actionPaginacuatro');

//pdf
Route::get('reportes', 'PdfController@index');
Route::any('reporte_por_pais','PdfController@reporte_por_pais');
Route::get('crear_reporte_porpais/{tipo}', 'PdfController@crear_reporte_porpais');
//graficas
Route::get('listado_graficas', 'GraficasController@index');
Route::get('listado_graficas1', 'GraficasController@crear_reporte_usuario');
Route::get('grafica_registros/{anio}/{mes}', 'GraficasController@registros_mes');
Route::get('grafica_publicaciones', 'GraficasController@total_publicaciones');

Route::resource('reportepruebas','PdfController@reportepruebas');

Route::resource('login', 'LogController@validate');
Route::resource('log', 'LogController@login');

///Yeison
Route::resource('tipodocumento','TipoDocumentoController@index');
Route::resource('tipodocumentostore','TipoDocumentoController@store');
Route::resource('tipodocumentoupdate','TipoDocumentoController@update');
Route::resource('tipodocumentodestroy','TipoDocumentoController@destroy');

Route::resource('componentedoc','DocumentoComponenteController@index');
Route::resource('componentedocstore','DocumentoComponenteController@store');
Route::resource('componentedocupdate','DocumentoComponenteController@update');
Route::resource('componentedocdestroy','DocumentoComponenteController@destroy');

Route::resource('documentosproyecto','DocumentosProyectoController@index');
Route::resource('subirdocumentos','DocumentosProyectoController@create');
Route::resource('subirdocumentosupdate','DocumentosProyectoController@update');

Route::resource('evaluardocumentos','EvaluarDocumentosController@index');
Route::resource('evaluardocumento','EvaluarDocumentosController@create');
Route::resource('evaluardocumentocreate','EvaluarDocumentosController@edit');
Route::resource('resultadosevaluaciondoc','EvaluarDocumentosController@resultados');
Route::resource('resultadosevaluaciondetalle','EvaluarDocumentosController@detalles');


Route::group(['middleware' => ['web']], function () {
    //
});
