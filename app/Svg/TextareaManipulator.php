<?php

namespace App\Svg;

class TextareaManipulator
{
    public function getReplacement(string $svgText, ?string $content, int $width, int $height, float $lineHeight = 1.2, float $paddingX = 0.5, float $paddingY = 0.5, bool $nowrap = false): string
    {
        if (!preg_match('#<text [^>]+font-size="\d+"[^>]+><tspan [^>]+>[^<>]+</tspan></text>#', $svgText)) {
            throw new \LogicException();
        }

        preg_match('/.+font-size="(\d+)".+/', $svgText, $m);
        $originalFontSize = $fontSize = (int) $m[1];

        // エリア内に収まるフォントサイズを探す
        while (true) {
            $rows = (int) floor(($height - (2 * $fontSize * $paddingY)) / ($fontSize * $lineHeight));
            $columns = (int) floor(($width - (2 * $fontSize * $paddingX)) / $fontSize); // 等幅フォントでなくても誤差は無視

            $logicalLines = [];
            $physicalLines = explode("\n", $content ?? '');
            if ($nowrap) {
                $logicalLines = $physicalLines;
            } else {
                foreach ($physicalLines as $line) {
                    $logicalLines = array_merge($logicalLines, mb_str_split($line, $columns));
                }
            }

            if (count($logicalLines) > $rows) {
                $fontSize *= 0.95;
            } else {
                break;
            }
        }

        // <text transform="translate(x y)"> のy座標はオブジェクトの上辺ではなく下辺のy座標になっているので、
        // 元のフォントサイズとの差の分だけy方向の起点を上に上げる必要がある
        $adjustY = $fontSize - $originalFontSize;

        $replacementTemplate = str_replace('%', '%%', $svgText);
        $replacementTemplate = preg_replace('#<tspan.+</text>#', '', $replacementTemplate);
        $replacementTemplate = preg_replace('/font-size="\d+"/', 'font-size="%d"', $replacementTemplate);
        $replacementTemplate .= '%s</text>';

        $tspan = '';
        $x = $fontSize * $paddingX;
        foreach ($logicalLines as $i => $line) {
            $y = $adjustY + $fontSize * ($paddingY + ($i * $lineHeight));
            $tspan .= sprintf('<tspan x="%d" y="%d">%s</tspan>', $x, $y, $line);
        }

        $replacement = sprintf($replacementTemplate, $fontSize, $tspan);

        return $replacement;
    }
}
