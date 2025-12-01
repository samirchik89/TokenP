<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;

use App\AccreditedDocument;
use App\AccreditedKycDocument;

class AccreditedDocumentResource extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $documents = AccreditedDocument::orderBy('created_at' , 'desc')->get();
        return view('admin.accrediteddocument.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.accrediteddocument.create');
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

        try{
            
            $document = $request->all();

            if($request->hasFile('image')) {
                $document['image'] = asset('storage/'.$request->image->store('accrediteddocuments'));

            }

            AccreditedDocument::create($document);

            return redirect()->route('admin.accrediteddocument.index')->with('flash_success',trans('admin.document.add_Document'));

        }

        catch (Exception $e) {
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

            $document = AccreditedDocument::findOrFail($id);
            return view('admin.accrediteddocument.edit',compact('document'));
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

            $Doc= AccreditedDocument::where('id',$id)->first();

            $Doc->name = $request->name;

            if($request->hasFile('image')) {
                $Doc->image = asset('storage/'.$request->image->store('accrediteddocuments'));
            }

            $Doc->order = $request->order;
            $Doc->required = $request->required;
            $Doc->save();

            return redirect()->route('admin.accrediteddocument.index')->with('flash_success', trans('admin.document.success'));
        }
        catch (Exception $e) {
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
            
            AccreditedDocument::find($id)->delete();
            AccreditedKycDocument::where('accredited_document_id',$id)->delete();

            return back()->with('message', trans('admin.document.deleted_success'));
        }
        catch (Exception $e) {
            return back()->with('flash_error', trans('admin.document.not_found'));
        }
    }
}
