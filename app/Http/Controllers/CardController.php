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
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards_images', 'public');
        }

        $publicToken = Str::uuid();

        $pdf = PDF::loadView('site.pdf_template', [
            'title' => $request->title,
            'message' => $request->message,
            'image' => $imagePath ? public_path('storage/' . $imagePath) : null,
            'color' => $request->color ?? '#ffffff'
        ]);

        $pdfPath = 'cards_pdfs/' . Str::slug($request->title) . '-' . time() . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        $card = Card::create([
            'title' => $request->title,
            'message' => $request->message,
            'fk_user_id' => Auth::user()->id,
            'path' => $pdfPath,
            'public_token' => $publicToken,
        ]);

        // сохраняем путь для скачивания через сессию
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
