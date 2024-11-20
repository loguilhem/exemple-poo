<?php

namespace Gri\Acme\Validator;

use InvalidArgumentException;

class NewQuestionValidator
{
    public function cleanup(string $params)
    {
        if (empty($params)) {
            throw new InvalidArgumentException("Les données reçues pur la question sont vides");
        }

        $paramsToClean = json_decode($params, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Erreur dans la lecture');
        }

        if (!isset($paramsToClean['text'])) {
            throw new InvalidArgumentException('Erreur dans le contenu');
        }

        $textRaw = $paramsToClean['text'];

        $text = trim($textRaw);
        $text = htmlspecialchars($textRaw, ENT_QUOTES, 'UTF-8');

        return $text;
    }
}
