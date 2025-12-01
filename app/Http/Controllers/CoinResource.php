<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Coins;
use Storage;

class CoinResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Coin = Coins::all();        
        return view('admin.coins.index', compact('Coin'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coins.create');
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
            'coin_name' => 'required|max:255',
            'symbol' => 'required|max:255',            
        ]);

        try {            
            $Coin = new Coins;            
            $Coin->coin_name = $request->coin_name;
            $Coin->symbol = strtoupper($request->symbol);            
            $Coin->save(); 


            return back()->with('flash_success','Coin Saved Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CoinType  $CoinType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Coins::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoinType  $CoinType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        try {
            $Coin = Coins::findOrFail($id);
            
            return view('admin.coins.edit',compact('Coin'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoinType  $CoinType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
       $this->validate($request, [
            'coin_name' => 'required|max:255',
            'symbol' => 'required|max:255',
            'sort_order' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png,bmp,ico',
            //'address' => 'required',
        ]);

        try {

            $Coin = Coins::findOrFail($id);
            if($request->hasFile('image')) {
                $Coin->image = $request->image->store('coins');
            }
            $Coin->coin_name = $request->coin_name;
            $Coin->symbol = strtoupper($request->symbol);
            $Coin->sort_order = $request->sort_order;
            if(isset($request->coin_type)){
                $Coin->coin_type=1;
                $Coin->contract_address = $request->contract_address; 
            }
            $Coin->address = $request->address;
            $Coin->save();

            return back()->with('flash_success', 'Coin Updated Successfully');    
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoinType  $CoinType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Coins::find($id)->delete();
            return back()->with('message', 'Coin deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }


    public function disableStatus($id)
    {
        
        try {
            
            $Coin = Coins::findOrFail($id);

            $Coin->status = '0';
            
            $Coin->save();

            return back()->with('message', 'Updated successfully');

        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

    public function enableStatus($id)
    {
        
        try {
            
            $Coin = Coins::findOrFail($id);

            $Coin->status = '1';
            
            $Coin->save();

            return back()->with('message', 'Updated successfully');

        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Coin Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Coin Not Found');
        }
    }

}
