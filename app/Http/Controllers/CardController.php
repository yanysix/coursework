<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::where('fk_user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('site.cards', compact('cards'));
    }

    public function createPdf(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color'   => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'title.required' => 'Укажите заголовок открытки.',
            'title.string' => 'Заголовок должен быть текстом.',
            'title.max' => 'Заголовок не должен превышать 255 символов.',

            'message.required' => 'Введите сообщение для открытки.',
            'message.string' => 'Сообщение должно быть текстом.',
            'message.max' => 'Сообщение слишком длинное (максимум 2000 символов).',

            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы изображения: jpeg, png, jpg, gif.',
            'image.max' => 'Изображение не должно превышать 2 МБ.',

            'color.regex' => 'Цвет должен быть в формате HEX, например #ffffff.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards_images', 'public');
        }

        $publicToken = \Illuminate\Support\Str::uuid();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('site.pdf_template', [
            'title' => $request->title,
            'message' => $request->message,
            'image' => $imagePath ? public_path('storage/' . $imagePath) : null,
            'color' => $request->color ?? '#ffffff'
        ]);

        $pdfPath = 'cards_pdfs/' . \Illuminate\Support\Str::slug($request->title) . '-' . time() . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        $card = \App\Models\Card::create([
            'title' => $request->title,
            'message' => $request->message,
            'fk_user_id' => Auth::id(),
            'path' => $pdfPath,
            'public_token' => $publicToken,
        ]);

        return redirect()->back()->with([
            'success' => 'Открытка успешно создана!',
            'download' => asset('storage/' . $pdfPath)
        ]);
    }


    public function download($token)
    {
        $card = Card::where('public_token', $token)->firstOrFail();

        $filePath = storage_path('app/public/' . $card->path);

        if (!file_exists($filePath)) {
            abort(404, 'Файл не найден');
        }

        return response()->download($filePath, Str::slug($card->title) . '.pdf');
    }

}
