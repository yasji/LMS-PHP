<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{

    // Display a listing of the loans with book title and user name
    public function index()
    {
        $loans = Loan::with(['book:id,title', 'user:id,name'])->get();
        return response()->json($loans);
    }

    // Store a newly created loan in storage
    public function store(Request $request)
    {
        $loan = Loan::create($request->all());
        return response()->json($loan, 201);
    }

    // Display the specified loan
    public function show($id)
    {
        $loan = Loan::find($id);
        if (is_null($loan)) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        return response()->json($loan);
    }

    // Update the specified loan in storage
    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        if (is_null($loan)) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        $loan->update($request->all());
        return response()->json($loan);
    }

    // Check overdue loans and update status if yes
    public function checkOverdue()
    {
        $loans = Loan::where('status', 'Borrowed')->get();
        foreach ($loans as $loan) {
            if ($loan->due_date < now()) {
                $loan->status = 'Overdue';
                $loan->save();
            }
        }
        return response()->json(['message' => 'Overdue loans checked successfully']);
    }

    //Check overdue loans by id and update status if yes

    public function checkOverdueById($id)
    {
        $loan = Loan::find($id);
        if (is_null($loan)) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        if ($loan->due_date < now()) {
            $loan->status = 'Overdue';
            $loan->save();
        }
        return response()->json($loan);
    }


    // Remove the specified loan from storage
    public function destroy($id)
    {
        $loan = Loan::find($id);
        if (is_null($loan)) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        $loan->delete();
        return response()->json([
            'message' => 'Loan deleted successfully'
        ], 200);
    }
}