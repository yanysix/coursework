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
        return view('site.zodiac');
    }

    public function select(Request $request)
    {
        // Валидация даты
        $validated = $request->validate([
            'birthday' => 'required|date|before_or_equal:today|after_or_equal:1900-01-01',
        ], [
            'birthday.required' => 'Введите вашу дату рождения.',
            'birthday.date' => 'Введите корректную дату.',
            'birthday.before_or_equal' => 'Дата рождения не может быть в будущем.',
            'birthday.after_or_equal' => 'Дата рождения слишком старая.',
        ]);

        $birthday = $validated['birthday'];

        $sign = $this->getZodiacSign($birthday);

        return redirect()->route('zodiac.result', [
            'sign' => $sign,
        ]);
    }


    public function result(Request $request)
    {
        $sign = $request->sign;

        $flower = Flower::where('zodiac_sign', $sign)->first();
        $packaging = Packaging::where('zodiac_sign', $sign)->first();

        return view('site.zodiac_result', compact('sign', 'flower', 'packaging'));
    }


    private function getZodiacSign($date)
    {
        // 🟢 Исправление — превращаем строку даты в Carbon
        $date = Carbon::parse($date);

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
