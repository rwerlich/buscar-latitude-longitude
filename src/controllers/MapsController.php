<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\helpers\RequireValidator;
use App\Models\MapsModel;
use App\Services\MapsService;

class MapsController
{

    public static function create(Request $request, Response $response): Response
    {
        try {
            $data = (array)$request->getParams();
            $validator = new RequireValidator([
                'rua' => 'Rua',
                'cidade' => 'Cidade',
                'bairro' => 'Bairro',
            ]);
            $validator->validate($data);
            $address = implode(',', $data);
            $mapsService = new MapsService('AIzaSyDi7z4VSBnkGMIAcHE3mwLutJoaCBBnivQ');
            $coordinates = $mapsService->getLatLng($address);
            $mapsModel = new MapsModel();
            $mapsModel->insert($data['bairro'], $data['cidade']);

            return $response->withJson(
                json_decode(json_encode($coordinates), True)
            );
        } catch (Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }
    }

    //http://localhost/api-maps/api/list?export=true
    public static function list(Request $request, Response $response): Response
    {
        try {
            $mapsModel = new MapsModel();
            $list = $mapsModel->list();
            //export to csv
            if ($request->getQueryParam('export')) {
                $filename = "Buscas API Maps - " . date('d/m/Y') . ".csv";
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Content-Type: text/csv; charset=UTF-8");
                $out = fopen("php://output", 'w');
                $header = ['id', 'dt_hr_consulta', 'cidade', 'bairro'];
                fputs( $out, "\xEF\xBB\xBF" ); // UTF-8 BOM !!!!!
                fputcsv($out, array_values($header), ',', '"');
                foreach ($list as $row) {
                    fputcsv($out, array_values($row), ',', '"');
                }
                fclose($out);
                exit;
            }
            return $response->withJson($list);
        } catch (Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => 'Não foi possível buscar as Contas',
            ])->withStatus(500);
        }
    }

}


