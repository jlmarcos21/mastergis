<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    public function run()
    {
        //Peru
        $peru = App\Country::where('id', '1')->first();
        $provinces_peru = array('Sin Ciudad','Amazonas','Ancash','Apurimac','Arequipa','Ayacucho','Cajamarca','Callao','Cusco','Huancavelica','Huanuco','Ica','Junin','La Libertad','Lambayeque','Lima','Loreto','Madre de Dios','Moquegua','Pasco','Piura','Puno','San Martin','Tacna','Tumbes','Ucayali');

        foreach ($provinces_peru as $province) {
            App\Province::create([
                'country_id'    => $peru->id,
                'description'   => $province
            ]);
        }

        //Mexico
        $mexico = App\Country::where('id', '2')->first();
        $provinces_mexico = array('Sin Ciudad','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila de Zaragoza','Colima','Distrito Federal','Durango','Guanajuato','Guerrero','Hidalgo','Jalisco','Mexico','Michoacan de Ocampo','Morelos','Nayarit','Nuevo Leon','Oaxaca','Puebla','Queretaro de Arteaga','Quintana Roo','San Luis Potosi','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz-Llave','Yucatan','Zacatecas');

        foreach ($provinces_mexico as $province) {
            App\Province::create([
                'country_id'    => $mexico->id,
                'description'   => $province
            ]);
        }

        //Argentina
        $argentina = App\Country::where('id', '3')->first();
        $provinces_argentina = array('Sin Ciudad','Buenos Aires','Buenos Aires Capital','Catamarca','Chaco','Chubut','Cordoba','Corrientes','Entre Rios','Formosa','Jujuy','La Pampa','La Rioja','Mendoza','Misiones','Neuquen','Rio Negro','Salta','San Juan','San Luis','Santa Cruz','Santa Fe','Santiago del Estero','Tierra del Fuego','Tucuman');

        foreach ($provinces_argentina as $province) {
            App\Province::create([
                'country_id'    => $argentina->id,
                'description'   => $province
            ]);
        }

        //Brasil
        $brazil = App\Country::where('id', '4')->first();
        $provinces_brazil = array('Sin Ciudad','Acre','Alagoas','Amapa','Amazonas','Bahia','Ceara','Distrito Federal','Espirito Santo','Goias','Maranhao','Mato Grosso','Mato Grosso do Sul','Minas Gerais','Para','Paraiba','Parana','Pernambuco','Piaui','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondania', 'Santa Catarina','Sao Paulo','Sergipe','Tocantins');

        foreach ($provinces_brazil as $province) {
            App\Province::create([
                'country_id'    => $brazil->id,
                'description'   => $province
            ]);
        }

        //Chile
        $chile = App\Country::where('id', '5')->first();
        $provinces_chile = array('Sin Ciudad','Aysen', 'Antofagasta','Araucania','Atacama','Bio-Bio','Coquimbo','O \'Higgins','Los Lagos', 'Magallanes y la Antartica Chilena','Maule','Santiago de Region Metropolitana', 'Tarapaca', 'Valparaiso');

        foreach ($provinces_chile as $province) {
            App\Province::create([
                'country_id'    => $chile->id,
                'description'   => $province
            ]);
        }

        //Colombia
        $colombia = App\Country::where('id', '6')->first();
        $provinces_colombia = array('Sin Ciudad','Amazonas', 'Antioquia','Arauca','Atlantico','Bogota District Capital','Bolivar','Boyaca','Caldas','Caqueta','Casanare','Cauca','Cesar','Choco','Cordoba','Cordoba','Cundianamarca','Guinia','Guaviare','Huila','La Guajaira','Magdalena','Meta','Narino','Norte de Santander','Putumayo','Quindio','Risaralda','San Andres & Providemcia','Santander','Sucre','Tolima','Valle del Cauca','Vaupes','Vichada');

        foreach ($provinces_colombia as $province) {
            App\Province::create([
                'country_id'    => $colombia->id,
                'description'   => $province
            ]);
        }

        //España
        $espana = App\Country::where('id', '7')->first();
        $provinces_espana = array('Sin Ciudad','A Coruña','Araba/Álava','Albacete','Alicante','Almería','Asturias','Ávila','Badajoz','Baleares','Barcelona','Burgos', 'Cáceres','Cádiz','Cantabria','Castellón','ceuta','Ciudad Real','Córdoba','Cuenca','Girona','Granada','Guadalajara','Gipuzkoa','Huelva','Huesca','Jaén','La Rioja','Las Palmas','León','Lleida','Lugo','Madrid','Málaga','Melilla','Murcia','Navarra','Ourense','Palencia','Pontevedra','Salamanca','Santa Cruz de Tenerife','Segovia','Sevilla','Soria','Tarrangona','Teruel','Toledo','Valencia','Valladolid','Bizkaia','Zamora','Zaragoza');

        foreach ($provinces_espana as $province) {
            App\Province::create([
                'country_id'    => $espana->id,
                'description'   => $province
            ]);
        }

        //Paraguay
        $paraguay = App\Country::where('id', '8')->first();
        $provinces_paraguay = array('Sin Ciudad','Alto Paraguay','Alto Parana','Amambay','Asuncion','Boqueron','Caazapa','Canindeyu','Central','Concepcion','Cordillera','Guaira','Itapua','Misiones','Neembucu','Paraguari','Presidente Hayes','San Pedro');

        foreach ($provinces_paraguay as $province) {
            App\Province::create([
                'country_id'    => $paraguay->id,
                'description'   => $province
            ]);
        }

        //Ecuador
        $ecuador = App\Country::where('id', '9')->first();
        $provinces_ecuador = array('Sin Ciudad', 'Azuay', 'Bolivar','Canar','Carchi','Chimborazo','Cotopaxi','El Oro','Esmeraldas','Galapagos','Guayas','Imbabura','Loja','Los Rios','Manabi','Morona-Santiago','Napo','Orellana','Pastaza','Pichincha','Sucumbios','Tungurahua','Zamora-Chinchipe');

        foreach ($provinces_ecuador as $province) {
            App\Province::create([
                'country_id'    => $ecuador->id,
                'description'   => $province
            ]);
        }

        //Uruguay
        $uruguay = App\Country::where('id', '10')->first();
        $provinces_uruguay = array('Sin Ciudad', 'artigas','Canelones','Cerro Largo','Colonia','Durazno','Flores','Florida','Lavalleja','Maldonado','Montevideo','Paysandu','Rio Negro','Rivera','Rocha','Salto','San Jose','Soriano','Tucuarembo','Treinta y Tres');

        foreach ($provinces_uruguay as $province) {
            App\Province::create([
                'country_id'    => $uruguay->id,
                'description'   => $province
            ]);
        }

        //Canadá
        $canada = App\Country::where('id', '11')->first();
        $provinces_canada = array('Sin Ciudad','Alberta','British Columbia','Manitoba','New Brunswick','Newfoundland and Labrador','Northwest Territories', 'Nova Scotia','Nunavut','Ontario','Prince Edward Islnad','Quebec','Saskatchewan','Yokon Territory');

        foreach ($provinces_canada as $province) {
            App\Province::create([
                'country_id'    => $canada->id,
                'description'   => $province
            ]);
        }

        //Cuba
        $cuba = App\Country::where('id', '12')->first();
        $provinces_cuba = array('Sin Ciudad','Camaguey', 'Ciego de Avila','Cienfuegos','Ciudad de La Habana','Granma','Guantanamo','Holguin','Isla de la Juventud','La Habana','Las Tunas','Matanzas','Pinar del Rio','Sancti Spiritus','Santiago de Cuba','Villa Clara');

        foreach ($provinces_cuba as $province) {
            App\Province::create([
                'country_id'    => $cuba->id,
                'description'   => $province
            ]);
        }

        //República Dom 
        $repldomi = App\Country::where('id', '13')->first();
        $provinces_repldomi = array('Sin Ciudad','Azua','Baoruco','Barahona','Dajabon','Distrito Nacional','Duarte','Elias Pina','El Seibo','Espaillat','Hato Mayor','Independencia','La Altagracia','La Romana','La Vega','Maria Trinidad Sanchez','Monsenor Nouel','Monte Cristi','Monte Plata','Pedernales','Peravia','Puerto Plata','Salcedo','Samana','Sanchez Ramirez','San Cristobal','San Jose de Ocoa','San Juan','San Pedro de Macoris','Santiago','Santiago Rodriguez','Santo Domingo','Valverde');

        foreach ($provinces_repldomi as $province) {
            App\Province::create([
                'country_id'    => $repldomi->id,
                'description'   => $province
            ]);
        }

        //Honduras
        $honduras = App\Country::where('id', '14')->first();
        $provinces_honduras = array('Sin Ciudad','Atlantida','Choluteca','Colon','Comayagua','Copan','Cortes','El Paraiso','Francisco Morazan','Gracias a Dios','Intibuca','Islas de la Bahia','La Paz','Lempira','Ocotepeque','Olancho','Santa Barbara','Valle','Yoro');

        foreach ($provinces_honduras as $province) {
            App\Province::create([
                'country_id'    => $honduras->id,
                'description'   => $province
            ]);
        }

        //Bolivia
        $bolivia = App\Country::where('id', '15')->first();
        $provinces_bolivia = array('Sin Ciudad','Chuquisaca','Cochabamba','Beni','La Paz','Oruro','Pando','Potosi','Santa Cruz','Tarija');

        foreach ($provinces_bolivia as $province) {
            App\Province::create([
                'country_id'    => $bolivia->id,
                'description'   => $province
            ]);
        }

        //Venezuela
        $venezuela = App\Country::where('id', '16')->first();
        $provinces_venezuela = array('Sin Ciudad','Amazonas','Anzoategui','Apure','Aragua','Barinas','Bolivar','Carabobo','Cojedes','Delta Amacuro','Dependencias Federales','Distrito Federal','Falcon','Guarico','Lara','Merida','Miranda','Monagas','Nueva Esparta','Portuguesa','Sucre','Tachira','Trujillo','Vargas','Yaracuy','Zulia');

        foreach ($provinces_venezuela as $province) {
            App\Province::create([
                'country_id'    => $venezuela->id,
                'description'   => $province
            ]);
        }

        //Panamá
        $panama = App\Country::where('id', '17')->first();
        $provinces_panama = array('Sin Ciudad','Bocas del Toro','Chiriqui','Cocle','Colon','Darien','Herrera','Los Santos','Panama','San Blas','Veraguas');

        foreach ($provinces_panama as $province) {
            App\Province::create([
                'country_id'    => $panama->id,
                'description'   => $province
            ]);
        }

        //Costa Rica
        $costar = App\Country::where('id', '18')->first();
        $provinces_costar = array('Sin Ciudad','Alajuela','Cartago','Guanacaste','Heredia','Limon','Puntarenas','San Jose');

        foreach ($provinces_costar as $province) {
            App\Province::create([
                'country_id'    => $costar->id,
                'description'   => $province
            ]);
        }

        //Guatemala
        $guatemala = App\Country::where('id', '19')->first();
        $provinces_guatemala = array('Sin Ciudad','Alajuela','Cartago','Guanacaste','Heredia','Limon','Puntarenas','San Jose');

        foreach ($provinces_guatemala as $province) {
            App\Province::create([
                'country_id'    => $guatemala->id,
                'description'   => $province
            ]);
        }

        //EEUU
        $eeuu = App\Country::where('id', '20')->first();
        $provinces_eeuu = array('Sin Ciudad','Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin');

        foreach ($provinces_eeuu as $province) {
            App\Province::create([
                'country_id'    => $eeuu->id,
                'description'   => $province
            ]);
        }

        //Portugal
        $portugal = App\Country::where('id', '21')->first();
        $provinces_portugal = array('Sin Ciudad','Aveiro','Acores','Beja','Braga','Braganca','Castelo Branco','Coimbra','Evora','Faro','Guarda','Leiria','Lisboa','Madeira','Portalegre','Porto','Santarem','Setubal','Viana do Castelo','Vila Real','Viseu');

        foreach ($provinces_portugal as $province) {
            App\Province::create([
                'country_id'    => $portugal->id,
                'description'   => $province
            ]);
        }

        //Francia
        $francia = App\Country::where('id', '22')->first();
        $provinces_francia = array('Sin Ciudad','Alsace','Aquitaine','Auvergne','Basse-Normandie','Bourgogne','Bretagne','Centre','Champagne-Ardenne','Corse','Franche-Comte','Haute-Normandie','Ile-de-France','Languedoc-Roussillon','Limousin','Lorraine','Midi-Pyrenees','Nord-Pas-de-Calais','Pays de la Loire','Picardie','Poitou-Charentes','Provence-Alpes-Cote d\'Azur','Rhone-Alpes');

        foreach ($provinces_francia as $province) {
            App\Province::create([
                'country_id'    => $francia->id,
                'description'   => $province
            ]);
        }

        //Andorra
        $andorra = App\Country::where('id', '23')->first();
        $provinces_andorra = array('Sin Ciudad','Andorra la Vella','Canillo','Encamp','Escaldes-Engordany','La Massana','Ordino','Sant Julia de Loria');

        foreach ($provinces_andorra as $province) {
            App\Province::create([
                'country_id'    => $andorra->id,
                'description'   => $province
            ]);
        }

        //Aruba
        $aruba = App\Country::where('id', '24')->first();
        $provinces_aruba = array('Sin Ciudad','Babijn','Oranjestad','Angochi');

        foreach ($provinces_aruba as $province) {
            App\Province::create([
                'country_id'    => $aruba->id,
                'description'   => $province
            ]);
        }

        //El Salvador
        $salvador = App\Country::where('id', '25')->first();
        $provinces_salvador = array('Sin Ciudad','Ahuachapan','Cabanas','Chalatenango','Cuscatlan','La Libertad','La Paz','La Union','Morazan','San Miguel','San Salvador','Santa Ana','San Vicente','Sonsonate','Usulutan');

        foreach ($provinces_salvador as $province) {
            App\Province::create([
                'country_id'    => $salvador->id,
                'description'   => $province
            ]);
        }

        //Indonesia
        $indonesia = App\Country::where('id', '26')->first();
        $provinces_indonesia = array('Sin Ciudad','Aceh','Bali','Banten','Bengkulu','Gorontalo','Irian Jaya Barat','Jakarta Raya','Jambi','Jawa Barat','Jawa Tengah','Jawa Timur','Kalimantan Barat','Kalimantan Selatan','Kalimantan Tengah','Kalimantan Timur','Kepulauan Bangka Belitung','Kepulauan Riau','Lampung','Maluku','Maluku Utara','Nusa Tenggara Barat','Nusa Tenggara Timur','Papua','Riau','Sulawesi Barat','Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Sulawesi Utara','Sumatera Barat','Sumatera Selatan','Sumatera Utara','Yogyakarta');

        foreach ($provinces_indonesia as $province) {
            App\Province::create([
                'country_id'    => $indonesia->id,
                'description'   => $province
            ]);
        }

        //Puerto Rico
        $puertorico = App\Country::where('id', '27')->first();
        $provinces_puertorico = array('Sin Ciudad','Aguadilla','Arecibo','Barceloneta','Bayamón','Caguas','Candelaria','Carolina','Cataño','Cayey','Fajardo','Guayama','Guaynabo','Humacao','Levittown','Manatí','Mayagüez','Ponce','San Juan','Trujillo Alto','Vega Baja','Yauco');

        foreach ($provinces_puertorico as $province) {
            App\Province::create([
                'country_id'    => $puertorico->id,
                'description'   => $province
            ]);
        }

    }
}
