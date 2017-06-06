<?php

return [

    /*
     | ------------------------------------------------- -------------------------
     | Valores predeterminados de autenticación
     | ------------------------------------------------- -------------------------
     |
     | Esta opción controla la autenticación por defecto "guardia" y la contraseña
     | restablecer opciones para su aplicación. Puede cambiar estos valores predeterminados
     | según sea necesario, pero son un comienzo perfecto para la mayoría de aplicaciones.
     |
     */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuario',
    ],

    /*
     | ------------------------------------------------- -------------------------
     | Los guardias de autenticación
     | ------------------------------------------------- -------------------------
     |
     | A continuación, se puede definir todos los guardias de autentificación para su aplicación.
     | Por supuesto, una gran configuración por defecto se ha definido para usted
     | aquí que utiliza almacenamiento de sesión de usuario y el proveedor eloquent.
     |
     | Todos los conductores tienen un proveedor de autenticación de usuario. Esto define cómo el
     | los usuarios están realmente recuperados de la base de datos u otro almacenamiento
     | mecanismos utilizados por esta aplicación para guardar los datos de sus usuarios.
     |
     | Apoyado: "sesión", "token"
     |
     */
     
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuario',
        ],
    ],
    
    
/*
     | ------------------------------------------------- -------------------------
     | Los proveedores de los usuarios
     | ------------------------------------------------- -------------------------
     |
     | Todos los conductores tienen un proveedor de autenticación de usuario. Esto define cómo el
     | los usuarios están realmente recuperados de la base de datos u otro almacenamiento
     | mecanismos utilizados por esta aplicación para guardar los datos de sus usuarios.
     |
     | Si tiene varias tablas de usuario o modelos es posible configurar múltiples
     | fuentes que representan cada modelo / tabla. Estas fuentes pueden entonces
     | ser asignado a cualquier guardia de autenticación adicionales que haya definido.
     |
     | Apoyado: "base de datos", "elocuente"
     |
     */
    'providers' => [
        'usuario' => [
            'driver' => 'eloquent',
            'model' => calidad\usuario::class,
            'table' => 'usuario',
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
     | ------------------------------------------------- -------------------------
     | Restablecimiento de contraseñas
     | ------------------------------------------------- -------------------------
     |
     | Aquí puede configurar las opciones para restablecer contraseñas, incluyendo la vista
     | ese es su restablecimiento de contraseña por correo electrónico. También puede establecer el nombre de la
     | tabla que mantiene todas las fichas de reposición para su aplicación.
     |
     | Puede especificar varias configuraciones de restablecimiento de contraseña si tiene más
     | de una tabla de usuario o modelo en la aplicación y que desea tener
     | configuración de restablecimiento de contraseña independientes en función de los tipos específicos de usuarios.
     |
     | El tiempo expira es el número de minutos que el contador de reposición debe ser
     | considerados válidos. Esta función de seguridad mantiene fichas de corta duración por lo
     | tienen menos tiempo para ser adivinado. Puede cambiar esto como sea necesario.
     |
     */
    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
