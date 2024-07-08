<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleCloudServices
{

    public static function evaluateAssessment($token)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $response = Http::asForm()->post($verifyUrl, [
            'secret' => $secretKey,
            'response' => $token,
        ]);
        // Si false spam, si true, la requête est légitime
        return $response->successful();
        if ($response->successful()) {
            $result = $response->json();

            // 'success': true|false indique si la vérification CAPTCHA a réussi.
            return $result['success'] && isset($result['score']) && $result['score'] > env('RECAPTCHA_SPAM_TOLERANCE'); // Adaptez 0.5 selon votre seuil de tolérance au spam
        }

        // Gérer l'échec de la demande HTTP ici
        return false;
    }
}
