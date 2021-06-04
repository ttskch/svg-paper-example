<?php

namespace App\Http\Controllers;

class PrintController extends Controller
{
    public function estimate(string $type)
    {
        // 普通の値の置換

        $replacements = [
            '%顧客名%' => '株式会社' . str_repeat('ほげ', rand(1, 10)),
            '%敬称%' => '御中',
            '%案件名%' => '案件' . str_repeat('ふが', rand(1, 10)),
            '%納品先%' => str_repeat('ぴよ', rand(1, 10)) . '支店オフィス',
            '%予定納期%' => (new \DateTime('last day of next month'))->format('Y/m/d'),
            '%有効期限%' => (new \DateTime('last day of this month'))->format('Y/m/d'),
            '%税区分%' => '税込',
            '%作成日%' => (new \DateTime())->format('Y/m/d'),
            '%見積コード%' => 'EST-' . (new \DateTime())->format('Ymd') . '-001',
            '%小計%' => 0,
            '%値引き%' => rand(1, 10) * 10000,
        ];

        for ($i = 0; $i < 26; $i++) {
            $replacements["%商品名[{$i}]%"] = str_repeat('商品名', rand(1, 10));
            $replacements["%メーカー名[{$i}]%"] = str_repeat('メーカー名', rand(1, 2));
            $replacements["%型番[{$i}]%"] = str_repeat('型番', rand(1, 5));
            $replacements["%数量[{$i}]%"] = rand(1, 10);
            $replacements["%単位[{$i}]%"] = ['個', '台', 'セット'][rand(0, 2)];
            $replacements["%単価[{$i}]%"] = rand(1, 100) * 1000;
            $replacements["%金額[{$i}]%"] = $replacements["%数量[{$i}]%"] * $replacements["%単価[{$i}]%"];
            $replacements["%小計%"] += $replacements["%金額[{$i}]%"];
            $replacements["%単価[{$i}]%"] = number_format($replacements["%単価[{$i}]%"]);
            $replacements["%金額[{$i}]%"] = number_format($replacements["%金額[{$i}]%"]);
        }

        $replacements['%合計%'] = $replacements['%小計%'] - $replacements['%値引き%'];
        $replacements['%消費税%'] = (int) floor($replacements['%合計%'] * 0.1);
        $replacements['%税込合計%'] = $replacements['%合計%'] + $replacements['%消費税%'];
        $replacements['%合計金額%'] = $replacements['%税込合計%'];

        foreach (['%小計%', '%値引き%', '%合計%', '%消費税%', '%税込合計%', '%合計金額%'] as $key) {
            $replacements[$key] = number_format($replacements[$key]);
        }
        $replacements['%値引き%'] = '▲' . $replacements['%値引き%'];
        $replacements['%合計金額%'] = '¥ ' . $replacements['%税込合計%'] . ' ー';

        // 画像の置換

        $search = 'xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWBAAAAADcmsM/AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QADzoyPqMAAAAHdElNRQflBRsOAiomtvkhAAAAQklEQVRo3u3MMQEAAAwCIPt3tIsl9g0CkN6Jy+VyuVwul8vlcrlcLpfL5XK5XC6Xy+VyuVwul8vlcrlcLpfL5XpxDYP98hZXPIDCAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTA1LTI3VDIzOjAyOjQyKzA5OjAwOnfPPQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0wNS0yN1QyMzowMjo0MiswOTowMEsqd4EAAAAASUVORK5CYII="';
        $replacement = 'xlink:href="/images/sato.jpg"';
        $replacements[$search] = $replacement;

        $search = 'xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWBAAAAADcmsM/AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QADzoyPqMAAAAHdElNRQflBRsMCSgoyJWoAAAAQklEQVRo3u3MMQEAAAwCIPtnM5Ql9g0CkN6Jy+VyuVwul8vlcrlcLpfL5XK5XC6Xy+VyuVwul8vlcrlcLpfL5XpxDbhTBuYaC+lwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTA1LTI3VDIxOjA5OjQwKzA5OjAwNVSQqAAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0wNS0yN1QyMTowOTo0MCswOTowMEQJKBQAAAAASUVORK5CYII="';
        $replacement = 'xlink:href="/images/suzuki.jpg"';
        $replacements[$search] = $replacement;

        // テキストエリアの置換

        $replacements['%支店住所%'] = "〒460-8508\n愛知県名古屋市中区三の丸3-1-1\nTEL: 052-961-1111";
        $replacements['%備考%'] = str_repeat('これは備考です', rand(1, 10) * 10);
        $replacements['%コメント%'] = str_repeat('これはコメントです', rand(1, 10) * 10);

        // XDファイルではIPAexフォントを使っているが、これをserif/sans-serifに丸める

        $replacements['font-family="IPAexMincho"'] = 'font-family="serif"';
        $replacements['font-family="IPAexGothic"'] = 'font-family="sans-serif"';

        return view(sprintf('print.estimate.%s', $type), [
            'replacements' => $replacements,
        ]);
    }
}
