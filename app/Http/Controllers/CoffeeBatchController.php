<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoffeeBatch;

use Illuminate\Support\Facades\Auth;


class CoffeeBatchController extends Controller
{
    // Show all batches uploaded by current cooperative
    public function index()
    {
        $batches = CoffeeBatch::where('uploaded_by', Auth::id())->latest()->get();
        return view('cooperative.batches.index', compact('batches'));

    }
      // Show form to upload new batch
      public function create(){
        return view('cooperative.batches.create');

      }
      // Handle form submission to store new batch in DB
      public function store(Request $request){
        $request->validate([
            'batch_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'quality_grade' => 'required|string',
        ]);
        CoffeeBatch::create([
            'batch_name' => $request->batch_name,
            'quantity' => $request->quantity,
            'quality_grade' => $request->quality_grade,
            'uploaded_by' => Auth::id(),
        ]);
        return redirect()->route('cooperative.batches.index')->with('success', 'Coffee batch uploaded successfully.');


      }



}
