<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get("/api-de-dados/auxilio-emergencial-por-municipio/{codigoIbge}/{mesAno}", function(Request $request, Response $response, $args)
{
    $codigoIbge = $request->getAttribute('codigoIbge');
    $mesAno = $request->getAttribute('mesAno');
    $url = "http://api.portaldatransparencia.gov.br/api-de-dadosa/auxilio-emergencial-por-municipio?codigoIbge{$codigoIbge}&mesAno={$mesAno}&pagina=1";

    $client = curl_init($url);


    $headers = ['chave-api-dados: meu-token-secreto'];

    curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);

    $responses = curl_exec($client);
    
    $response->getBody()->write($responses);
    return $response;
});


$app->get("/api-de-dados/bpc-por-municipio/{codigoIbge}/{mesAno}", function(Request $request, Response $response, $args)
{
    $codigoIbge = $request->getAttribute('codigoIbge');
    $mesAno = $request->getAttribute('mesAno');
    $url = "http://api.portaldatransparencia.gov.br/api-de-dados/bpc-por-municipio?codigoIbge={$codigoIbge}&mesAno={$mesAno}&pagina=1";

    $client = curl_init($url);


    $headers = ['chave-api-dados: meu-token-secreto'];

    curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);

    $responses = curl_exec($client);
    
    $response->getBody()->write($responses);
    return $response;
});

$app->get("/api-de-dados/bolsa-familia/{codigoIbge}/{mesAno}", function(Request $request, Response $response, $args)
{
    $codigoIbge = $request->getAttribute('codigoIbge');
    $mesAno = $request->getAttribute('mesAno');
    $url = "http://api.portaldatransparencia.gov.br/api-de-dados/bolsa-familia-por-municipio?codigoIbge={$codigoIbge}&mesAno={$mesAno}&pagina=1";

    $client = curl_init($url);


    $headers = ['chave-api-dados: meu-token-secreto'];


    curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);

    $responses = curl_exec($client);
    
    $response->getBody()->write($responses);
    return $response;
});
 
$app->get('/uf', function (Request $request, Response $response) {
    //$sigla = $request->getAttribute('sigla');
    //$nome =  $request->getAttribute('nome');
    try 
    {        
        $db = $this->get(PDO::class);
        $sth = $db->prepare("select * from uf");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});    
$app->run();
