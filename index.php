<?php
require_once "./vendor/autoload.php";

use App\Router;
use App\Controllers\HomeController;
use Kernel\Http\Request;


$router = new Router();

$router->addRouter("GET", "/", [HomeController::class, "index"]);
$router->addRouter("POST", "/", [HomeController::class, "store"]);
$router->addRouter('POST', '/user/{id}/update', ['UserController', 'update']);

$request = Request::createFromGlobals();
$router->dispatch($request->method(), $request->uri());
?>

<h2>Пример формы с одним полем</h2>

<form action="/" method="post">
    <label for="inputField">Введите текст:</label><br>
    <input type="text" id="inputField" name="inputField"><br><br>
    <input type="submit" value="Отправить">
</form>

