<?php

use Slim\Http\Request;
use Slim\Http\Response;

use \Fpin\Page;
use \Fpin\Models\User;
use \Fpin\Models\Candidato;
use \Fpin\Models\Proposta;
use \Fpin\Image\Cloudinary;

// Routes
/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
$app->get('/', function (Request $request, Response $response, array $args) {
    $page = new Page(["header"=>false, "footer"=>false], "/templates/public/");

    $page->setTpl("index", ["errorRegister"=>User::getErroRegister(),
'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : ['cpf'=>'', 'email'=>'']]);

});

$app->post("/users/create", function($request, $response, $args){

     $_SESSION['registerValues'] = $_POST;


    if(!isset($_POST['email']) || $_POST['email'] == ''){
        User::setErroRegister("Preencha o email corretamente !");
        header("Location: /");
        exit;
    }

    if(!isset($_POST['senha']) || $_POST['senha'] == ''){
        User::setErroRegister("Preencha a senha corretamente !");
        header("Location: /");
        exit;
    }

    if(!isset($_POST['cpf']) || $_POST['cpf'] == ''){
        User::setErroRegister("Preencha o CPF corretamente !");
        header("Location: /");
        exit;
    }

    if(User::checkLoginExist($_POST['email']) === true){
        User::setErroRegister("Email já é usado por um outro usuario");
        header("Location: /");
        exit;
    }

    if(User::checkCpfExist($_POST['cpf']) === true){
        User::setErroRegister("CPF já cadastrado no sistema");
        header("Location: /");
        exit;
    }

    $user = new User();

    $_POST["admin"] = 0;

    $user->setData($_POST);

    $user->save();

     User::login($_POST['email'], $_POST['senha']);

    header("Location: /home");

    exit;
});

$app->post('/login', function(){
    User::login($_POST["email"], $_POST["password"]);

    header ("Location: /home");
    exit;
});

$app->get('/home', function (Request $request, Response $response, array $args) {

    /*
    ----- USO DE GEOIP-----------
    $ip = $_SERVER['REMOTE_ADDR'];
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
    var_dump($details);
    */
    User::verify_login(false);
    $location = "Alagoas";
    $candidatos = Candidato::getAllLocation($location);
    $user = User::getFromSession();
    $page = new Page(["footer"=>false, "data"=>["user"=> $user->getValues()]], "/templates/public/");

    $page->setTpl("home", ["candidatos"=>$candidatos]);

});

$app->get('/candidatos/{idcandidato}/detalhe', function (Request $request, Response $response, array $args) {

    User::verify_login(false);
    $user = User::getFromSession();
    $candidato = new Candidato();
    $candidato->get((int)$args["idcandidato"]);
    $propostas = $candidato->getPropostas();
    $page = new Page(["footer"=>false, "data"=>["user"=> $user->getValues()]], "/templates/public/");

    $page->setTpl("candidato-detalhe", ["candidato"=>$candidato->getValues(), "propostas"=>$propostas, "tipo"=>Proposta::getAlltipo()]);

});

$app->get('/admin', function (Request $request, Response $response, array $args) {
    User::verify_login();

    $user = User::getFromSession();
    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("index");

});

$app->get('/admin/login', function(){

    $page = new Page(["header"=>false, "footer"=>false]);
    $page->setTpl("login");
});

$app->post('/admin/login', function(){
    User::login($_POST["login"], $_POST["password"]);

    header ("Location: /admin");
    exit;
});

$app-> get('/admin/logout', function(){
    User::logout();

    header("Location: /admin/login");
    exit;
});

$app->get('/admin/users', function(){

    User::verify_login();

    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

    if ($search != ''){
        $pagination = User::getPageSearch($search, $page);
    } else {
        $pagination = User::getPage($page);
    }


     $pages = [];

    for ($i = 0; $i < $pagination['pages']; $i++){
        array_push($pages, [
            'href'=> '/admin/users/'.'?'.http_build_query([
                'page'=> $i+1,
                'search'=> $search]),
            'text'=>$i+1
        ]);
    }

    $user = User::getFromSession();
    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("users",["user"=>$pagination['data'],
                            "search"=>$search]);
});

$app->get('/admin/users/create', function(){
    User::verify_login();

    $user = User::getFromSession();

    $page = new Page(["data"=>["user"=> $user->getValues()]]);
    $page->setTpl("users-create");
});

$app->post("/admin/users/create", function($request, $response, $args){

    User::verify_login();

    $user = new User();

    $_POST["admin"] = (isset($_POST["admin"])) ?1:0;

    $user->setData($_POST);

    $user->save();

    header("Location: /admin/users");

    exit;
});

$app->get("/admin/users/{iduser}/update", function($request, $response, $args){

    User::verify_login();

    $user = new User();

    $user->get((int)$args['iduser']);

    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("users-update", ["user"=>$user->getValues()]);

});

$app->get("/admin/users/{iduser}/delete", function($request, $response, $args){

    User::verify_login();

    $user = new User();

    $user->get((int)$args['iduser']);

    $user->delete();

    header("Location: /admin/users");

    exit;
});

$app->get("/admin/users/{iduser}/password", function ($request, $response, $args){

    User::verify_login();

    $user = User::getFromSession();
    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $user = new User();


    $user->get((int)$args['iduser']);

    $page->setTpl("users-password",[
        'user'=> $user->getValues(),
        'msgError' =>  "",//User::getMsgErro(),
        'msgSuccess' =>  ""]);//User::getSucess()]);

});

$app->post("/admin/users/{iduser}/password", function ($request, $response, $args){

    User::verify_login();

    if(!isset($_POST['despassword']) || $_POST['despassword'] === ''){
       // User::setMsgErro("Digite a nova senha");
        header("Location: /admin/users/".$args['iduser']."/password");
        exit;
    }
    if(!isset($_POST['despassword-confirm']) || $_POST['despassword-confirm'] === ''){
        //User::setMsgErro("Confirme a nova senha");
        header("Location: /admin/users/".$args['iduser']."/password");
        exit;
    }

    if ($_POST['despassword'] !== $_POST['despassword-confirm']){
        //User::setMsgErro("Confirme corretamente as senhas");
        header("Location: /admin/users/".$args['iduser']."/password");
        exit;
    }

    $user = new User();

    $user->get((int)$args['iduser']);

    $newPassword = User::getPasswordHash($_POST['despassword']);

    $user->setPassword($newPassword);

    //User::setSucess("senha alterada com sucesso");
    header("Location: /admin/users");
    exit;

});

$app->get('/admin/candidatos', function(){

    User::verify_login();

    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

    if ($search != ''){
        $pagination = Candidato::getPageSearch($search, $page);
    } else {
        $pagination = Candidato::getPage($page);
    }


     $pages = [];

    for ($i = 0; $i < $pagination['pages']; $i++){
        array_push($pages, [
            'href'=> '/admin/candidatos/'.'?'.http_build_query([
                'page'=> $i+1,
                'search'=> $search]),
            'text'=>$i+1
        ]);
    }

    $user = User::getFromSession();
    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("candidatos",["candidatos"=>$pagination['data'],
                                "search"=>$search]);
});

$app->get('/admin/candidatos/create', function(){
    User::verify_login();

    $user = User::getFromSession();

    $page = new Page(["data"=>["user"=> $user->getValues()]]);
    $page->setTpl("candidatos-create", ["tipo"=>Candidato::getAllTipo(),
                                        "partido"=>Candidato::getAllPartido(),
                                        "localidade"=>Candidato::getAllLocalidade()]);
});

$app->post("/admin/candidatos/create", function($request, $response, $args){

    User::verify_login();

    if ($_FILES['newfile']['name']!=="") {
            $ext = explode('.', $_FILES['newfile']['name']);
            $ext = end($ext);

            $new_name = "cad_".date("YmdHms");

            $dirTemp = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."candidatos".DIRECTORY_SEPARATOR.$new_name.".".$ext;

            move_uploaded_file($_FILES['newfile']['tmp_name'], $dirTemp);

             \Cloudinary :: config ( array (
                                        "cloud_name" => Cloudinary::CLOUD_NAME ,
                                        "api_key" => Cloudinary::API_KEY ,
                                        "api_secret" => Cloudinary::API_SECRET
            ));
            $response = \Cloudinary\Uploader::upload($dirTemp, $options = array ("folder" => "icons/", "public_id" => $new_name));
            unlink($dirTemp);
            $url = $response['url'];
            $_POST['img'] = $url;
        }

    $candidato = new Candidato();

    $candidato->setData($_POST);

    $candidato->save();

    header("Location: /admin/candidatos");

    exit;
});

$app->get("/admin/candidatos/{idcandidato}/update", function($request, $response, $args){

    User::verify_login();

    $user = User::getFromSession();

    $candidato = new Candidato();

    $candidato->get((int)$args['idcandidato']);

    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("candidatos-update", ["candidato"=>$candidato->getValues(),
                                        "tipo"=>Candidato::getAllTipo(),
                                        "partido"=>Candidato::getAllPartido(),
                                        "localidade"=>Candidato::getAllLocalidade()]);

});


//UPDATE POST

$app->get("/admin/candidatos/{idcandidato}/delete", function($request, $response, $args){

    User::verify_login();

    $candidato = new Candidato();

    $candidato->get((int)$args['idcandidato']);

    $candidato->delete();

    header("Location: /admin/candidatos");

    exit;
});

$app->get("/admin/candidatos/{idcandidato}/propostas", function($request, $response, $args){

    User::verify_login();

    $user = User::getFromSession();

    $candidato = new Candidato();

    $candidato->get((int)$args['idcandidato']);

    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("propostas", ["candidato"=>$candidato->getValues(),
                                "tipos"=>Proposta::getAllTipo(),
                                        "propostas"=>$candidato->getPropostas()]);

});

$app->get("/admin/candidatos/{idcandidato}/propostas/create", function($request, $response, $args){

    User::verify_login();

    $user = User::getFromSession();

    $candidato = new Candidato();

    $candidato->get((int)$args['idcandidato']);

    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("propostas-create", ["candidato"=>$candidato->getValues(),
                                        "tipo"=>Proposta::getAllTipo()]);

});

$app->post("/admin/candidatos/{idcandidato}/propostas/create", function($request, $response, $args){

    User::verify_login();

    $proposta = new Proposta();

    $proposta->setData($_POST);

    $proposta->save();

    header("Location: /admin/candidatos/".(int)$args['idcandidato']."/propostas");

    exit;
});

$app->get("/admin/propostas/{idproposta}/update", function($request, $response, $args){

    User::verify_login();

    $user = User::getFromSession();

    $proposta = new Proposta();

    $proposta->get((int)$args['idproposta']);

    $candidato = new Candidato();

    $candidato->get((int)$proposta->getidcandidato());

    $page = new Page(["data"=>["user"=> $user->getValues()]]);

    $page->setTpl("propostas-update", ["proposta"=>$proposta->getValues(),
                                        "tipo"=>Proposta::getAllTipo(),
                                        "candidato"=>$candidato->getValues()]);
});

$app->post("/admin/propostas/{idproposta}/update", function($request, $response, $args){

    User::verify_login();

    $proposta = new Proposta();

    $proposta->get((int)$args['idproposta']);

    $proposta->setData($_POST);

    $proposta->update();

    header("Location: /admin/candidatos/".$proposta->getidcandidato()."/propostas");

    exit;
});

$app->get("/admin/propostas/{idproposta}/delete", function($request, $response, $args){

    User::verify_login();

    $proposta = new Proposta();

    $proposta->get((int)$args['idproposta']);

    $proposta->delete();

    header("Location: /admin/candidatos");

    exit;

});

$app->get('/admin/votos', function(){
    User::verify_login();

    $user = User::getFromSession();

    $localidades = Candidato::getAllLocalidade();
    $tipos = Candidato::getAlltipo();

    if (isset($_GET["idlocalidade"]) && isset($_GET["idtipo"])){
        //Pegar dados de relatório
    }

    $page = new Page(["data"=>["user"=> $user->getValues()]]);
    $page->setTpl("votos", ["tipo"=>$tipos, "localidades"=>$localidades]);
});



