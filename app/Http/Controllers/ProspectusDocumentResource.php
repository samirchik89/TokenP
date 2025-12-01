<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;

use App\ProspectusDocuments;


class ProspectusDocumentResource extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $documents = ProspectusDocuments::orderBy('created_at' , 'desc')->get();
        return view('admin.prospectusdocument.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('admin.prospectusdocument.create');
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
            'title' => 'required|max:255',
            'order' => 'required|numeric',
            'document' => 'required|mimes:pdf,doc,docx'
        ]);

        try{
            
            $document = $request->all();

            if($request->hasFile('document')) {

                $extension = $request->document->getClientOriginalExtension();

                if($request->order==1){
                    $custom_file_name = 'disclaimer.'.$extension;                
                }
                if($request->order==2){
                    $custom_file_name = 'whitepaper.'.$extension;
                }
                if($request->order==3){
                    $custom_file_name = 'investor_prospectus.'.$extension;
                }

                $document['document'] = $request->document->storeAs('prospectusdocuments',$custom_file_name);

            }
            ProspectusDocuments::create($document);

            return redirect()->route('admin.prospectusdocument.index')->with('flash_success',trans('admin.document.add_Document'));

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
            return ProspectusDocuments::findOrFail($id);
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

            $document = ProspectusDocuments::findOrFail($id);
            return view('admin.prospectusdocument.edit',compact('document'));
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

        $this->validate($request, [
            'title' => 'required|max:255',
            'order' => 'required|numeric',
            'document' => 'mimes:pdf,doc,docx'
        ]);

        try {

            $Doc= ProspectusDocuments::where('id',$id)->first();

            $Doc->title = $request->title;

            if($request->hasFile('document')) {
                //$Doc->document = $request->document->store('prospectusdocuments');

                $extension = $request->document->getClientOriginalExtension();

                if($request->order==1){
                    $custom_file_name = 'disclaimer.'.$extension;
                }
                if($request->order==2){
                    $custom_file_name = 'whitepaper.'.$extension;
                }
                if($request->order==3){
                    $custom_file_name = 'investor_prospectus.'.$extension;
                }

                $Doc->document = $request->document->storeAs('prospectusdocuments',$custom_file_name);
            }

            $Doc->order = $request->order; 
            $Doc->save();

            return redirect()->route('admin.prospectusdocument.index')->with('flash_success', trans('admin.document.success'));
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
            
            ProspectusDocuments::find($id)->delete(); 
            return back()->with('message', trans('admin.document.deleted_success'));
        }
        catch (Exception $e) {
            return back()->with('flash_error', trans('admin.document.not_found'));
        }
    }
}
