<?php

declare(strict_types=1);

namespace Support\Testing;

use Faker\Provider\Base;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class FakerImageProvider extends Base
{
    const PLACEHOLDER_HOST = 'https://placehold.co/';

    public string $link = '';

    public function placeholdco(string $dir = '', ...$options): string|int
    {
        $params = [
            'width' => 200,
            'height' => 200,
            'format' => 'webp',
        ];
        $params = array_merge($params, $options);

        $filename = sprintf('%s.%s', Str::random(10), $params['format']);

        $filePath = $dir . DIRECTORY_SEPARATOR . $filename;

        $link = $this->constructLink($params);
        Storage::disk('images')
            ->put($filePath, file_get_contents($link));

        return $filePath;
    }

    private function constructLink(array $params): string
    {
        $this->link = self::PLACEHOLDER_HOST;
        $this->size(Arr::only($params, ['width', 'height']));
        $this->format($params['format'] ?? 'webp');
        if (isset($params['text']) && $params['text'] !== '') {
            $this->text($params['text']);
        }

        return $this->link;
    }

    private function format(string $format): void
    {
        $this->link .= "$format/";
    }

    private function size(array $size): void
    {
        $this->link .= implode('x', $size) . '/';
    }

    private function text(string $text): void
    {
        $text = $this->breakString($text);
        $text = urlencode($text);
        $this->link .= "?text=$text";
    }

    private function breakString($input, int $maxChars = 15): string
    {
        $words = explode(' ', $input);
        $result = '';
        $lineLength = 0;

        foreach ($words as $word) {
            $wordLength = strlen($word);
            if ($lineLength + $wordLength > $maxChars) {
                $result .= PHP_EOL;
                $lineLength = 0;
            }
            $result .= $word . ' ';
            $lineLength += $wordLength + 1; // Учитываем длину слова и пробела
        }

        return trim($result);
    }
}
