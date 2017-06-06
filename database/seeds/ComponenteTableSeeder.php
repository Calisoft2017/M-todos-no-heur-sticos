<?php

use Illuminate\Database\Seeder;

class ComponenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DIAGRAMA DE ACTIVIDADES

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Actividad',
            'opcional_componente' => 'NO',
            'descripcion' => 'Especificación de una secuencia parametrizada de comportamiento',
            'id_tipo_documento' => '4',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Acción',
            'opcional_componente' => 'NO',
            'descripcion' => 'Una acción representa un solo paso dentro de una actividad',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Restricciones de acción',
            'opcional_componente' => 'SI',
            'descripcion' => 'Son adjuntas a una acción se pueden presentar antes de realizar una acción o posteriormente',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Flujo de control',
            'opcional_componente' => 'NO',
            'descripcion' => 'Muestra el flujo de control de una acción sobre otra',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Nodo inicial',
            'opcional_componente' => 'NO',
            'descripcion' => 'Describe el comienzo de cualquier actividad',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Nodo final de actividad',
            'opcional_componente' => 'NO',
            'descripcion' => 'El nodo final de actividad se describe como un círculo con un punto dentro del mismo',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Nodo final de flujo',
            'opcional_componente' => 'NO',
            'descripcion' => 'El nodo final de flujo se describe como un círculo con una cruz dentro del mismo',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Flujo de objetos',
            'opcional_componente' => 'SI',
            'descripcion' => 'Un flujo de objeto es la ruta a lo largo de la cual pueden pasar objetos o datos',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Nodos de decisión y combinación',
            'opcional_componente' => 'SI',
            'descripcion' => 'Los flujos de control que provienen de un nodo de deciNOón tendrán condiciones de guarda que permitirán el control para fluir si la condición de guarda se realiza',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Nodos de bifurcación y unión',
            'opcional_componente' => 'SI',
            'descripcion' => 'Estos indican el comienzo y final de hilos actuales de control',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Región de expansión',
            'opcional_componente' => 'NO',
            'descripcion' => 'Es una región de actividad estructurada que se ejecuta muchas veces',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Gestores de excepción',
            'opcional_componente' => 'SI',
            'descripcion' => 'Son de uso exclusivo cuando para la realización de una actividad se tengan restricciones u observaciones',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Región de actividad interrumpible',
            'opcional_componente' => 'SI',
            'descripcion' => 'Rodea un grupo de acciones que se pueden interrumpir',
            'id_tipo_documento' => '4',
        ]);
        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Partición',
            'opcional_componente' => 'SI',
            'descripcion' => 'Las particiones se usan para separar acciones dentro de una actividad',
            'id_tipo_documento' => '4',
        ]);



        //DIAGRAMA DE CASOS DE USO



        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Actores',
            'opcional_componente' => 'NO',
            'descripcion' => 'Los actores representan los roles que pueden incluir usuarios humanos, un hardware externo u otros sistemas',
            'id_tipo_documento' => '2',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Casos de uso',
            'opcional_componente' => 'NO',
            'descripcion' => ' Notación para usar un caso de uso es una línea de conexión con una punta de flecha opcional mostrando la dirección del control',
            'id_tipo_documento' => '2',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Inclusión de casos de uso',
            'opcional_componente' => 'SI',
            'descripcion' => 'Los casos de uso pueden contener la funcionalidad de otro caso de uso como parte de su proceso normal',
            'id_tipo_documento' => '2',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Casos de uso extendidos',
            'opcional_componente' => 'SI',
            'descripcion' => 'Se pude usar para extender el comportamiento de otro. (En caso de que un usuario necesite permiso de otro para el acceso a ese caso de uso)',
            'id_tipo_documento' => '2',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Puntos de extensión',
            'opcional_componente' => 'SI',
            'descripcion' => 'Se utiliza un punto de extensión en caso de que se cumplan algunas condiciones específicas para ejecutar el caso de uso relacionado',
            'id_tipo_documento' => '2',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Límite del sistema',
            'opcional_componente' => 'SI',
            'descripcion' => 'Usualmente se usa para mostrar casos de uso dentro del sistema y actor,es fuera del sistema',
            'id_tipo_documento' => '2',
        ]);



        //Diagrama de secuencia



        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Línea de vida',
            'opcional_componente' => 'NO',
            'descripcion' => 'Una línea de vida representa un participante individual en un diagrama de secuencia',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Mensajes',
            'opcional_componente' => 'SI',
            'descripcion' => 'Deben ser mostrados como flechas Síncronos: denotados por una flecha con punta oscura, Asíncronos: denotados por una flecha con un punta en línea, Llamadas o señales: denotado por una flecha punteada',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Ocurrencia de ejecución',
            'opcional_componente' => 'SI',
            'descripcion' => 'Denota la ocurrencia de ejecución o activación de un foco de control',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Mensajes self',
            'opcional_componente' => 'SI',
            'descripcion' => 'Puede representar una llamada recursiva de una operación o un método llamando a otro método perteneciente al mismo objeto',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Mensajes perdidos y encontrados',
            'opcional_componente' => 'SI',
            'descripcion' => 'Los mensajes perdidos son aquellos que han sido enviados pero que no han llegado al destino esperado, o que han llegado aún',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Inicio y final de línea de vida',
            'opcional_componente' => 'NO',
            'descripcion' => 'Una línea de vida se puede crear o destruir durante la escala de tiempo representada por un diagrama de secuencia',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Restricciones de tiempo y duración ',
            'opcional_componente' => 'SI',
            'descripcion' => 'Al configurar una restricción de duración para un mensaje, el mensaje se mostrará como una línea inclinada',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Fragmentos combinados',
            'opcional_componente' => 'SI',
            'descripcion' => 'Fragmento combinado es una o más secuencias de procesos incluidas en un marco y ejecutadas bajo circunstancias nombradas específicas',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Puerto',
            'opcional_componente' => 'SI',
            'descripcion' => 'Conexión entre un fragmento y un mensaje.',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Descomposición en parte',
            'opcional_componente' => 'SI',
            'descripcion' => 'Permite mensajes de entre e intra objetos para que se muestren en el mismo diagrama',
            'id_tipo_documento' => '3',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Continuaciones / Invariantes de Estado',
            'opcional_componente' => 'SI',
            'descripcion' => 'Se puede encontrar extendida por una o más líneas de vida en distintos objetos',
            'id_tipo_documento' => '3',
        ]);








        //Diagrama de clase



        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Notacion de clase',
            'opcional_componente' => 'SI',
            'descripcion' => 'Se usan para denotar el nombre de la clase atributos y operaciones',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Interfaces',
            'opcional_componente' => 'NO',
            'descripcion' => 'Si se usa una interfaz se garantiza que las clases soporten un comportamiento requerido que permite que el sistema trate los elementos no relacionados en la misma manera',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Tablas',
            'opcional_componente' => 'SI',
            'descripcion' => 'Una tabla es una clase estereotipada',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Asociaciones',
            'opcional_componente' => 'SI',
            'descripcion' => 'Una asociación implica que dos elementos del modelo tienen una relación, usualmente implementada como una variable de instancia de una clase',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Generalizaciones',
            'opcional_componente' => 'SI',
            'descripcion' => 'Una generalización se usa para indicar herencia',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Agregaciones',
            'opcional_componente' => 'SI',
            'descripcion' => 'Las agregaciones se usan para describir elementos que están compuestos de componentes más pequeños',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Clase asociación',
            'opcional_componente' => 'SI',
            'descripcion' => 'Una clase asociación es una estructura que permite una conexión de asociación para tener conexiones y atributos',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Dependencias',
            'opcional_componente' => 'SI',
            'descripcion' => 'Una dependencia se usa para modelar un alto rango de relaciones dependientes entre elementos del modelo',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Trazado',
            'opcional_componente' => 'SI',
            'descripcion' => 'La relación de trazado es una especialización de una dependencia, vinculando elementos del modelo o conjuntos de elementos que representan la misma idea a través de los modelos',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Relaciones',
            'opcional_componente' => 'NO',
            'descripcion' => 'Se usa para expresar trazabilidad e integridad en el modelo',
            'id_tipo_documento' => '1',
        ]);

        DB::table('documentoComponente')->insert([
            'nom_componente' => 'Anidamientos',
            'opcional_componente' => 'SI',
            'descripcion' => 'Un anidamiento es un conector que muestra que el elemento fuente se anida dentro del elemento destino',
            'id_tipo_documento' => '1',
        ]);


    }
}
