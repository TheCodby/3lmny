<?php
    namespace App\Discord;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;

    class DiscordWebhook
    {
        # SendNotification("We Added New Material!", "We Added Introduction to Data Structure")
        public function SendNotification(String $title, String $message, String $url, String $type, String $level, String $image_url)
        {
            return Http::post('https://discord.com/api/webhooks/905565334789038091/cHlVzdzKWSZAlygu3yqbYaAOy2WRmGKFYZPReGI3MHI_EhgVSlrzL-DIamg3T75z37gk', [
                'embeds' => [
                    [
                        'title' => $title,
                        'description' => $message,
                        'url' => $url,
                        'color' => '7506394',
                        'fields' => [
                            [
                                
                                "name" => "Type",
                                "value" => $type,
                                "inline" => true
                            ],
                            [
                                "name" => "Level",
                                "value" => $level,
                                "inline" => true
                            ],
                        ],
                        "thumbnail" => [
                            "url" => $image_url
                        ],
                    ],
                ],
            ]);
        }
    }
?>