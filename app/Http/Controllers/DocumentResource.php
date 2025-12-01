<?php

namespace App\Http\Controllers;

use App\AccreditedKycDocument;
use Illuminate\Http\Request;
use Storage;
use Auth;

use App\Document;
use App\KycDocument;

class DocumentResource extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->user()->role == 1) {
            return view('errors.404');
        }

        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('admin.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->user()->role == 1) {
            return view('errors.404');
        }

        return view('admin.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required'
        ]);

        try {
            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }


            $document = $request->all();

            if ($request->hasFile('image')) {
                $document['image'] = asset('storage/' . $request->image->store('documents'));
            }

            Document::create($document);
            return redirect()->route('admin.document.index')->with('flash_success', trans('admin.document.add_Document'));
        } catch (Exception $e) {
            return back()->with('flash_error', trans('admin.document.not'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }

            return Document::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }

            $document = Document::findOrFail($id);
            return view('admin.document.edit', compact('document'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        try {

            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }


            $Doc = Document::where('id', $id)->first();

            $Doc->name = $request->name;

            if ($request->hasFile('image')) {
                $Doc->image = asset('storage/' . $request->image->store('documents'));
            }

            $Doc->order = $request->order;
            $Doc->mandatory = $request->mandatory;

            $Doc->save();

            return redirect()->route('admin.document.index')->with('flash_success', trans('admin.document.success'));
        } catch (Exception $e) {
            return back()->with('flash_error', trans('admin.document.not_found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }


            Document::find($id)->delete();

            $docs = AccreditedKycDocument::where('accredited_document_id', $id)->first();
            if ($docs) {
                AccreditedKycDocument::where('accredited_document_id', $id)->delete();
            }


            return back()->with('message', trans('admin.document.deleted_success'));
        } catch (Exception $e) {
            return back()->with('flash_error', trans('admin.document.not_found'));
        }
    }
}
