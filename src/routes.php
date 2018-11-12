<?php

use Slim\Http\Request;
use Slim\Http\Response;

use \Fpin\Page;
use \Fpin\Models\User;
use \Fpin\Models\Candidato;

// Routes
/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
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

    $page->setTpl("users",["user"=>$pagination['data']]);
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

    $page->setTpl("candidatos",["candidatos"=>$pagination['data']]);
});

$app->get('/admin/candidatos/create', function(){
    User::verify_login();

    $user = User::getFromSession();

    $page = new Page(["data"=>["user"=> $user->getValues()]]);
    $page->setTpl("candidatos-create");
});

$app->post("/admin/candidatos/create", function($request, $response, $args){

    User::verify_login();

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

    $page->setTpl("candidatos-update", ["candidato"=>$candidato->getValues()]);

});

$app->get("/admin/candidatos/{idcandidato}/delete", function($request, $response, $args){

    User::verify_login();

    $candidato = new Candidato();

    $candidato->get((int)$args['idcandidato']);

    $candidato->delete();

    header("Location: /admin/candidatos");

    exit;
});



