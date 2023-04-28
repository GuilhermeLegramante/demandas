<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Storage;
use Str;

class PncpClient
{
    public static function setToken()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('pncp-api.base_url') . '/v1/usuarios/login', [
            'login' => config('pncp-api.login'),
            'senha' => config('pncp-api.password'),
        ]);

        if ($response->status() == 200) {
            session()->put('token', $response->header('Authorization'));
        }
    }

    public static function getNoAuth(string $url)
    {
        PncpClient::setToken();

        $response = Http::get(config('pncp-api.base_url') . '/v1/orgaos/' . config('pncp-api.cnpj') . '/' . $url);

        return ErrorHandler::resolveStatusCode($response);
    }

    public static function getBaseUrl(string $url)
    {
        PncpClient::setToken();

        $response = Http::get(config('pncp-api.base_url') . $url);

        return ErrorHandler::resolveStatusCode($response);
    }

    public function getWithToken(string $url)
    {
        PncpClient::setToken();

        $response = Http::get(config('pncp-api.base_url') . $url);

        if ($response->status() == 401) {
            PncpClient::setToken();

            return Http::withHeaders([
                'Accept' => 'application/json',
            ])->withToken(session()->get('token'))->get(config('pncp-api.base_url') . $url);
        }
    }

    public function post(string $url, array $params)
    {
        PncpClient::setToken();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken(session()->get('token'))->post(config('pncp-api.base_url') . $url, $params);

        if ($response->status() == 401) {
            PncpClient::setToken();

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->withToken(session()->get('token'))->post(config('pncp-api.base_url') . $url, $params);

            return ErrorHandler::resolveStatusCode($response);
        } else {
            return ErrorHandler::resolveStatusCode($response);
        }
    }

    public function put(string $url, array $params)
    {
        PncpClient::setToken();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken(session()->get('token'))->put(config('pncp-api.base_url') . $url, $params);

        if ($response->status() == 401) {
            PncpClient::setToken();

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->withToken(session()->get('token'))->put(config('pncp-api.base_url') . $url, $params);

            return ErrorHandler::resolveStatusCode($response);
        } else {
            return ErrorHandler::resolveStatusCode($response);
        }
    }

    public function delete(string $url, array $params)
    {
        PncpClient::setToken();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken(session()->get('token'))->delete(config('pncp-api.base_url') . $url, $params);

        if ($response->status() == 401) {
            PncpClient::setToken();

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->withToken(session()->get('token'))->delete(config('pncp-api.base_url') . $url, $params);

            return ErrorHandler::resolveStatusCode($response);
        } else {
            return ErrorHandler::resolveStatusCode($response);
        }
    }

    public function postWithFile(string $url, array $params, $file, string $filename, array $headers = [])
    {
        PncpClient::setToken();

        $headers['Accept'] = 'application/json';
        // $headers['Content-Type'] = 'multipart/form-data';

        $response = Http::withHeaders($headers)
            ->attach('arquivo', file_get_contents($file), $filename)
            ->withToken(session()->get('token'))
            ->post(config('pncp-api.base_url') . $url, $params);

        if ($response->status() == 401) {
            PncpClient::setToken();

            $response = Http::withHeaders($headers)
                ->attach('arquivo', file_get_contents($file), $filename)
                ->withToken(session()->get('token'))
                ->post(config('pncp-api.base_url') . $url, $params);

            return ErrorHandler::resolveStatusCode($response);
        } else {
            return ErrorHandler::resolveStatusCode($response);
        }
    }

    public function postHiring(string $url, array $params, $file, string $filename, array $headers = [])
    {
        PncpClient::setToken();

        // Salva os parâmetros em um JSON (só funcionou assim)
        $hiringFilename = Str::uuid() . '.json';
        Storage::put('hiring/' . $hiringFilename, json_encode($params));

        $response = Http::withHeaders($headers)
            ->attach('compra', Storage::get('hiring/' . $hiringFilename), 'dados-compra.json')
            ->attach('documento', file_get_contents($file), $filename)
            ->withToken(session()->get('token'))
            ->post(config('pncp-api.base_url') . $url, []);

        if ($response->status() == 401) {
            PncpClient::setToken();

            $response = Http::withHeaders($headers)
                ->attach('compra', Storage::get('hiring/' . $hiringFilename), 'dados-compra.json')
                ->attach('documento', file_get_contents($file), $filename)
                ->withToken(session()->get('token'))
                ->post(config('pncp-api.base_url') . $url, []);

            return ErrorHandler::resolveStatusCode($response);
        } else {
            return ErrorHandler::resolveStatusCode($response);
        }
    }
}
