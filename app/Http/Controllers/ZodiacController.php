<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;
use App\Models\Packaging;
use Carbon\Carbon;

class ZodiacController extends Controller
{
    public function index()
    {
        return view('site.zodiac'); // страница с вводом даты
    }

    public function select(Request $request)
    {
        $request->validate([
            'birthday' => 'required|date',
        ]);

        $birthday = Carbon::parse($request->birthday);
        $sign = $this->getZodiacSign($birthday);

        // Ищем подходящие упаковку и цветок
        $flower = Flower::where('zodiac_sign', $sign)->first();
        $packaging = Packaging::where('zodiac_sign', $sign)->first();

        // Если не нашли — берём первые
        if (!$flower) $flower = Flower::first();
        if (!$packaging) $packaging = Packaging::first();

        return view('site.zodiac_result', compact('sign', 'flower', 'packaging'));
    }

    private function getZodiacSign($date)
    {
        $day = (int)$date->format('d');
        $month = (int)$date->format('m');

        if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) return 'Овен';
        if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) return 'Телец';
        if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) return 'Близнецы';
        if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) return 'Рак';
        if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) return 'Лев';
        if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) return 'Дева';
        if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) return 'Весы';
        if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) return 'Скорпион';
        if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) return 'Стрелец';
        if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) return 'Козерог';
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) return 'Водолей';
        if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) return 'Рыбы';

        return 'Неизвестно';
    }
}
