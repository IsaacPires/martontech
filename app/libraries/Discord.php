<?php

namespace App\libraries;

class Discord
{

    protected $payload;

    public function sendMensagem(int $ownerId, string $content, int $pendingId)
    {

        $channelOwner = match ($ownerId) {
            1 => 'https://discord.com/api/webhooks/1284666594290569236/kNkrPwF9ECFYAtlHWYekVnt_ZzZRThQE4cZblvl2A6gA46N7Xlhn_SaW_Fz6WycOyuTq',
            2 => 'https://discord.com/api/webhooks/1284938854331056128/17PW3RJtB7Ff_G8Nl920o3iHRPWqJaYisQbJkcP6JHUpye1S85qur4-SNQlPK1Oi3E4x',
        };

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
                            'name' => 'Campo 1',
                            'value' => "[Aceitar](http://127.0.0.1:8000/api/pending/{$pendingId}/accept)",
                            'inline' => true
                        ],
                        [
                            'name' => 'Campo 2',
                            'value' => "[Negar](http://127.0.0.1:8000/api/pending/{$pendingId}/deny)",
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