<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function report()
    {
        return view('dashboard.report.report');
    }

    public function storeReport(Request $request)
    {
        $error = Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'content' => 'required|min:2',
            'seriousness' => 'required',
        ]);

        if($error->fails())
           return redirect()->back()->with(['error' => true, 'messages' => $error->errors()->all()]);

        Report::create([
            'user_id'       => Auth::id(),
            'title'         => $request->title,
            'content'       => $request->input('content'),
            'image'         => ($request->image) ? $this->uploadImage($request)->original : NULL,
            'seriousness'        => $request->seriousness,
        ]);

        return redirect()->back()->with(['error' => false, 'messages' => ['Problema reportado com sucesso.']]);
    }
}
