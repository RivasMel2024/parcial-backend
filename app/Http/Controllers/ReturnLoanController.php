<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReturnLoanController extends Controller
{
    public function __invoke(Request $request, Loan $loan)
    {
        

        if(!is_null($loan->return_at)){
            return response()->json([
                'message' => 'Este préstamo ya ha sido devuelto.',
            ], 422);
        }

        $loan->update([
            'return_at' => now()
        ]);
        
        $book = $loan->book;
        $book->update([
            'available_copies' => $book->available_copies + 1,
            'is_available' => true,
        ]);

        return response()->json([
            'message' => 'Libro devuelto exitosamente.',
            'data' => new LoanResource($loan)
        ]);
    }
}
