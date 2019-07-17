<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transaction;
use App\TransactionType;

class TransactionController extends Controller
{
    public function show(){
        $types = TransactionType::orderBy('id', 'desc')->paginate(15);
        return view('transactions.financialTypes', compact('types'));
    }

    public function insertFinancialType(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|unique:transactions,title'
        ], [], ['title' => 'عنوان امورمالی']);

        $type = new TransactionType();
        $type->title = $request->title;
        $type->save();
        return redirect('transactions/financialTypes');
    }

    public function deleteType(Request $request)
    {
        $type = TransactionType::find($request->id);
        if(!$type){
            return redirect()->back()->with('fail', "نوع امورمالی موردنظر یافت نشد.");
        }else{
            $type->delete();
            return redirect()->back()->with('success', "نوع امورمالی با موفقیت حذف گردید.");
        }
    }

    public function index(){
        $transactions = Transaction::whereHas('transactionType')->with('transactionType')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function showAddTransactionForm(Request $request){
        $types = TransactionType::get();
        $projects = \App\Project::get();
        return view('transactions.add', compact('types', 'projects'));
    }

    public function insertTransaction(Request $request){
        $request->validate([
            'title' => 'required|max:50|unique:transactions,title',
            'typeId.*' => 'required|exists:transactions,id',
            'amount' => 'required',
            'projectId' =>  'required_if:typeId,13|exists:projects,id'
        ], [], ['title' => 'عنوان تراکنش', 'typeId' => 'نوع تراکنش', 'amount' => 'مبلغ']);

        $transactionId = Transaction::insertGetId($request->except(['_token', 'created_at', 'projectId']));
        if('پروژه' == TransactionType::find($request->typeId)->title){
            \App\TransactionProject::Insert([
                'transactionId' => $transactionId,
                'projectId' => $request->projectId,
            ]);
        }
        return redirect('transactions');
    }

    public function showTransactionDetailForm($id)
    {
        $transaction = Transaction::with('transactionType', 'project')->find($id);
        $types = TransactionType::get();
        $projects = \App\Project::get();
        // dd($transaction->project);
        return view('transactions.detail', compact('transaction', 'types', 'projects'));
    }

    public function updateTransaction(Request $request)
    {
        
        $request->validate([
            'title' => [
                'required',
                'max:50',
                Rule::unique('transactions')->ignore($request->id),
            ],
            'typeId.*' => 'required|exists:transactions,id',
            'amount' => 'required',
            'projectId' =>  'required_if:typeId,13|exists:projects,id'
        ], [], ['title' => 'عنوان تراکنش', 'typeId' => 'نوع تراکنش', 'amount' => 'مبلغ']);

        $transaction = Transaction::whereHas('transactionType')->with( 'project')->find($request->id);
        // dd($transaction);
        if(!$transaction)
        {
            return redirect()->back()->with('fail', 'شناسه تراکنش مورد نظر یافت نشد.');
        }
            if('پروژه' == TransactionType::find($request->typeId)->title){
                $rel = \App\TransactionProject::firstOrNew([
                    'transactionId' => $transaction->id,
                ]);
                $rel->projectId = $request->projectId;
                $rel->save();

                // $transaction_type->where('projectId', $projectId)->where('transactionId', $transactionId)
                // ->update(['transactionId' => $trId, 'projectId' => $prId]);
            }
            $transaction->update($request->except(['_token', 'created_at']));
            return redirect('transactions')->with('success', "اطلاعات تراکنش با موفقیت بروزرسانی شد.");

    }

    public function deleteTransaction(Request $request)
    {
        $transaction = Transaction::with('transactionProject')->find($request->id);
        if(!$transaction){
            return redirect()->back()->with('fail', 'تراکنش مورد نظر یافت نشد.');
        }else{
            if($transaction->transactionProject){
                $transaction->transactionProject()->delete();
            }
            $transaction->delete();
            return redirect()->back()->with('success', " تراکنش مورد نظر حذف گردید.");   
        }
    }
}
