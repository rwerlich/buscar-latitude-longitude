#Parte 1 (PHP, recebendo requests)
O middleware facilita aos desenvolvedores de software implementarem comunicação e entrada/saída, de forma que eles possam focar no propósito específico de sua aplicação.

Neste middleware, o serviço consumido será: https://developers.google.com/maps/documentation/geocoding/intro
E o serviço disponibilizado será o retorno de um objeto json LatLon[latitude, longitude].
Não é necessário ter controle de acesso / sessão.

O objetivo deste aplicativo é receber um Endereco[rua, numero, cep, cidade, bairro], 
utilizar a API do google para transformar em LatLng[lat, lng],
e retornar um json representando o objeto LatLng, por exemplo:

Request POST:
{
  "rua": "Campus Universitário Reitor João David Ferreira Lima",
  "numero": "",
  "cep": "88040-900",
  "cidade": "Florianópolis",
  "bairro": "Trindade"
}


Response: application/json
HTTP code: 200 
Body:
{
  "lat":    -27.6007034,
  "lng":    -48.5191775 
}


#Parte 2 (PHP e banco de dados)
Iremos especializar este software para gerar os dados da consulta na forma de série temporal.

Para isto, utilize um banco de dados MySQL para armazenar as cidades e bairros pesquisados na requisição desenvolvida na Parte 1.
Utilize apenas uma tabela, com a seguinte estrutura:
nome da tabela: consulta
campos: id (int, pk, not null, autoincrement), dt_hr_consulta (timestamp not null), cidade (string), bairro (string).


#Parte 3 (PHP, formatação de texto, gerência de timeout e stdout)
Agora iremos entregar de alguma forma os dados da série temporal desenvolvida.
Para isto, implemente um método GET que retorne os dados da tabela consulta desenvolvida na Parte 2 em um arquivo CSV no formato:

id;dt_hr_consulta;cidade;bairro

1;2018-09-10 22:39:35;Florianópolis;Trindade
