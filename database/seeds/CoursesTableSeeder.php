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
            'certificate'   => 'Análisis de Redes | con ArcGIS',
            'code'          => '001adra',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/09/network.png',
        ]);

        App\Course::create([
            'name'          => 'Sistemas de Información Geográfica con ArcGIS',
            'certificate'   => 'Sistemas de Información Geográfica | con ArcGIS',
            'code'          => '002siga',
            'level_id'      => 3,            
            'duration'      => 'Con una duración de 180 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/post-website-01.png',
        ]);

        App\Course::create([
            'name'          => 'ArcGIS aplicado al Catastro',
            'certificate'   => 'ArcGIS aplicado al Catastro',
            'code'          => '003aaac',
            'level_id'      => 3,            
            'duration'      => 'Con una duración de 180 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/ArcGIS-aplicado-al-catastro.png',
        ]);

        App\Course::create([
            'name'          => 'Gestión de Cuencas Hidrográficas con ArcGIS',
            'certificate'   => 'Gestión de Cuencas Hidrográficas | con ArcGIS',
            'code'          => '004gcha',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2019/04/MINIATURA_WEB.png',
        ]);

        App\Course::create([
            'name'          => 'Global Mapper y LIDAR 3D',
            'certificate'   => 'Global Mapper y LIDAR 3D',
            'code'          => '005gml3',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/12/post-website-05.png',
        ]);

        App\Course::create([
            'name'          => 'Programación con Python en ArcGIS',
            'certificate'   => 'Programación con Python | en ArcGIS',
            'code'          => '006pacp',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/post-website-04.png',
        ]);

        App\Course::create([
            'name'          => 'Sistemas de Información Geográfica con QGIS',
            'certificate'   => 'Sistemas de Información Geográfica | con QGIS',
            'code'          => '007sigq',
            'level_id'      => 3,            
            'duration'      => 'Con una duración de 180 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/post-website-11.png',
        ]);

        App\Course::create([
            'name'          => 'Visores y mapas web con ArcGIS Online',
            'certificate'   => 'Visores y mapas web | con ArcGIS Online',
            'code'          => '008vwao',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/post-website-06.png',
        ]);

        App\Course::create([
            'name'          => 'Procesamiento Digital de Imágenes Satelitales con QGIS',
            'certificate'   => 'Procesamiento Digital de Imágenes | Satelitales con QGIS',
            'code'          => '009pisq',
            'level_id'      => 1,            
            'duration'      => 'Con una duración de 60 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/01/PDI_QGIS-02.png',
        ]);

        App\Course::create([
            'name'          => 'Procesamiento Digital de Imágenes Satelitales con ENVI',
            'certificate'   => 'Procesamiento Digital de Imágenes Satelitales | con ENVI',
            'code'          => '010pise',
            'level_id'      => 3,            
            'duration'      => 'Con una duración de 180 horas lectivas',            
            'image_url'     => 'https://www.mastergis.com/wp-content/uploads/2018/08/envi.png',
        ]);

    }
}
