<?php

namespace App\Controllers;
// use App\Models

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    } 
    

    public function prueba ()
    {
        echo 'hola esto es una prueba';
    }

    public function api()
    {
        $noticias = array(
            array(
                "tema" => "03 DE NOVIEMBRE: DÍA INTERNACIONAL CONTRA LA VIOLENCIA Y EL ACOSO ESCOLAR DE NIÑAS, NIÑOS Y ADOLESCENTES",
                "argumeto" => "La violencia contra las niñas, niños y adolescentes asume formas y magnitudes cada vez más diversas e intensas. Entre estas nuevas formas se encuentran el acoso escolar y el ciberacoso, que afecta a millones de niños a nivel mundial, y que dejan profundas secuelas psicológicas que pueden perdurar para toda la vida....",
                "fecha" => "2022-11-07",
                "fuente" => "Protección derechos",
                "url" => "https://proteccionderechosquito.gob.ec/2022/11/07/15041173/"
            ),
            array(
                "tema" => "Así capturaron en Colombia al ‘Gordo Luis’: uno de los hombres más buscados del Ecuador",
                "argumeto" => "Migración Colombia confirmó la captura y expulsión del país de un ciudadano ecuatoriano, líder de una poderosa banda delincuencial que destacaba como uno de los hombres más buscados del país vecino....",
                "fecha" => "2023-07-07",
                "fuente" => "infobae",
                "url" => "https://www.infobae.com/colombia/2023/07/07/asi-capturaron-en-colombia-al-gordo-luis-uno-de-los-hombres-mas-buscados-del-ecuador/"
            ),
            array(
                "tema" => "Ecuador negocia con EE.UU. la apertura de un centro de migrantes",
                "argumeto" => "El canciller Gustavo Manrique contó que el Gobierno mantiene conversaciones con Washington para la apertura de un centro de atención de migrantes que quieran viajar a Estados Unidos....",
                "fecha" => "2023-07-07",
                "fuente" => "Primicias",
                "url" => "https://www.primicias.ec/noticias/politica/ecuador-estaoos-unidos-centro-migrantes/"
            )
        );
    
        return $this->response->setJSON($noticias);
    }
    


    public function login(){

return view('login');
    
    }

 
    public function testbd()
    {
       $this->db = \Config\Database::connect();
    
        $query = $this->db->query("SELECT id, tema, argumento, fecha, fuente, url  FROM informacion");
    
        $result = $query->getResult();
        return $this->response->setJSON($result);
    }
    

    public function borrarinfromacion($id)
    {
        $db = \Config\Database::connect();
        $db->table('informacion')->where('id', $id)->delete();   // borrar la noticia segun el ID proporcionado
    $response = [
        'message' => 'Datos borrados correctamente'
        ];
     return $this->response->setJSON($response);
    }
    
    public function agregarInformacion()
{
    $data = $this->request->getJSON(true); // insertar los datos enviados en la solicitud POST en formato JSON

    // comando para agregar o insertar los datos a la base de datos
    $db = \Config\Database::connect();
    $db->table('informacion')->set($data)->insert();

    // Retornar una respuesta apropiada
    $response = [
        'message' => 'La informacion se agrego correctamente'
    ];

    return $this->response->setJSON($response);
}


public function actualizarInformacion($id)
{
    $data = $this->request->getJSON(true); // Insertar los datos enviados en la solicitud POST en formato JSON
    
    // Comando para actualizar los datos en la base de datos
    $db = \Config\Database::connect();
    $db->table('informacion')->set($data)->where('id', $id)->update();
    
    // Retornar una respuesta apropiada
    $response = [
        'message' => 'Datos actualizados correctamente'
    ];
    
    return $this->response->setJSON($response);
}


}

//USANDO POSTMAN PARA HACER EL GRUD.
#//GET
#http://localhost/ci4/testbd                  //Visualizar datos

#//DELETE
#http://localhost/ci4/testbd/1                 //El /1 indica el id que se desea borrar

#//POST
#http://localhost/ci4/testbd/agregarInformacion             //Insertar datos

#//PUT
#http://localhost/ci4/informacion/actualizar/1    //El /1 indica id que se desea actualizar

