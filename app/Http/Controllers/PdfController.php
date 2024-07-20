<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\PdfTextChunk;

class PdfController extends Controller
{
    public function create()
    {
        return view('upload-pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $pdfFile = $request->file('pdf');
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFile->getPathname());
        $text = $pdf->getText();

        // Split text into chunks
        $chunks = explode("\n\n", $text);

        // Save chunks to database
        foreach ($chunks as $chunk) {
            PdfTextChunk::create(['content' => $chunk]);
        }

        return redirect()->back()->with('success', 'PDF uploaded and processed successfully.');
    }
}