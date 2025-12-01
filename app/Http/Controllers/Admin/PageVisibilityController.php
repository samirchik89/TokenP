<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PageVisibility;
use Illuminate\Http\Request;

class PageVisibilityController extends Controller
{
    public function index()
    {
        $items = PageVisibility::getItems();
        return view('admin.page-visibility.index', compact('items'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $items = PageVisibility::getItems();

        foreach($items as $item) {
            $isVisible = $request->input($item['key'], 0) == 1;
            // dd($isVisible);
            $dbItem = PageVisibility::where('page_key', $item['key'])->first();
            if($dbItem){
                $dbItem->is_visible = $isVisible;
                $dbItem->save();
            }else{
                PageVisibility::create(['page_key' => $item['key'], 'is_visible' => $isVisible]);
            }
        }

        return redirect()->route('admin.page-visibility.index')->with('success', 'Page visibility updated successfully');
    }
}