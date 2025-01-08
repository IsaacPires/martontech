<?php

namespace App\libraries;

class Discord
{

    protected $payload;

    public function sendMensagem(int $ownerId, string $content, int $pendingId)
    {
        $channelOwner = match ($ownerId) {
            1 => env('MARCIO_DISCORD'),
            2 => env('AIRTON_DISCORD'),
        };
        
        $urlAccept = url("/api/pending/{$pendingId}/accept");
        $urlDeny   = url("/api/pending/{$pendingId}/deny");
        $this->payload = [
            'content' => 'Nova Solicitação de compra realizada!',
            'username' => 'Marton avisos',
            'avatar_url' => 'https://link-para-avatar-opcional.com/avatar.png',
            'embeds' => [
                [
                    'title' => 'Descrição dos produtos',
                    'description' => "{$content}",
                    'color' => 16711680,
                    'fields' => [
                        [
                            'name' => 'Aceitar',
                            'value' => "[Aceitar]($urlAccept)",
                            'inline' => true
                        ],
                        [
                            'name' => 'Negar',
                            'value' => "[Negar]($urlDeny)",
                            'inline' => true
                        ]
                    ]
                ]
            ]
        ];

        $this->dispatch($channelOwner);
    }

    private function dispatch(string $channelOwner): bool
    {
        $ch = curl_init($channelOwner);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->payload, JSON_UNESCAPED_SLASHES));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Erro cURL: ' . curl_error($ch);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }

}