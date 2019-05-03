<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Course::create([
            'name'          => 'Análisis de Redes con ArcGIS',
            'code'          => 'adrca',
            'level_id'      => 2,
            'certificate'   => 'Especialista en Análisis de Redes con Network Analyst de ArcGIS',
            'duration'      => 'Con una duración de 40 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/09/network.png',
        ]);

        App\Course::create([
            'name'          => 'ArcGIS – Curso Completo',
            'code'          => 'acc',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Sistemas de Información Geográfica con ArcGIS',
            'duration'      => 'Con una duración de 120 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/post-website-01.png',
        ]);

        App\Course::create([
            'name'          => 'ArcGIS aplicado al Catastro',
            'code'          => 'aaac',
            'level_id'      => 3,
            'certificate'   => 'Especialista en ArcGIS aplicado al Catastro Urbano',
            'duration'      => 'Con una duración de 120 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/ArcGIS-aplicado-al-catastro.png',
        ]);

        App\Course::create([
            'name'          => 'Gestión de Cuencas Hidrográficas',
            'code'          => 'gdch',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Hidrología de cuencas con ArcGIS',
            'duration'      => 'Con una duración de 20 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2019/04/MINIATURA_WEB.png',
        ]);

        App\Course::create([
            'name'          => 'Global Mapper LIDAR 3D',
            'code'          => 'gml3',
            'level_id'      => 1,
            'certificate'   => 'Especialista en Sistemas de Información Geográfica con Global Mapper',
            'duration'      => 'Con una duración de 40 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/12/post-website-05.png',
        ]);

        App\Course::create([
            'name'          => 'Programación ArcGIS con Python',
            'code'          => 'pacp',
            'level_id'      => 1,
            'certificate'   => 'Especialista en Programación GIS con Python',
            'duration'      => 'Con una duración de 40 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/post-website-04.png',
        ]);

        App\Course::create([
            'name'          => 'QGIS – Curso Completo',
            'code'          => 'qcc',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Sistemas de Información Geográfica con QGIS',
            'duration'      => 'Con una duración de 120 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/post-website-11.png',
        ]);

        App\Course::create([
            'name'          => 'Visores y mapas web con ArcGIS Online',
            'code'          => 'vymwcao',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Visores y Mapas Web con ArcGIS Online',
            'duration'      => 'Con una duración de 40 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/post-website-06.png',
        ]);

        App\Course::create([
            'name'          => 'Teledetección ambiental con QGIS',
            'code'          => 'tacq',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Procesamiento de Imágenes Satelitales con QGIS',
            'duration'      => 'Con una duración de 40 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/PDI_QGIS-02.png',
        ]);

        App\Course::create([
            'name'          => 'Teledetección ambiental, Lidar y drones',
            'code'          => 'talyd',
            'level_id'      => 3,
            'certificate'   => 'Especialista en Teledetección, Drones y Lidar con ENVI',
            'duration'      => 'Con una duración de 120 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/envi.png',
        ]);

    }
}
