<?php


namespace App\PowerbiHelper;

class PowerbiHelper
{
    public static function processPowerbiHttpRequest($url, $header, $data , $method = 'POST')
    {
        $header[] = 'Content-Length:' . strlen($data);
        $context = [
            'http' => [
                'method'  => $method,
                'header'  => implode("\r\n", $header),
                'content' => $data
            ]
        ];

        $createdContext = stream_context_create($context);
        $content = file_get_contents($url, false, $createdContext);
        if ($content != false) {
            $content = json_decode($content);
        }
        return [
            'content'=> $content,
            'headers'=> $http_response_header,
        ];
    }


    public static function getOffice360AccessToken()
    {
        $data = http_build_query([
            'grant_type'    => 'password',
            'resource'      => 'https://analysis.windows.net/powerbi/api',
            'client_id'     => '3ac89367-36f4-400e-8569-faec52b7aa08',
            'client_secret' => '',
            'username'      => 'a.ragab@it-gates.com',
            'password'      => 'W@123xyz',
        ], '', '&');
        $header = [
            "Content-Type:application/x-www-form-urlencoded",
            "return-client-request-id:true",
        ];
        $result = self::processPowerbiHttpRequest('https://login.microsoftonline.com/common/oauth2/token', $header, $data);
        if ($result) {
            return $result['content'];
        }else{
            return null;
        }
    }


    public static function debugPrint($param)
    {
        print '<pre>';
        print_r($param);
        print '</pre>';
    }
}