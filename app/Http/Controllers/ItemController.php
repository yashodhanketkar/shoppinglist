<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'nos' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('items.index')->withErrors($validator);
        }

        Item::create([
            'item' => $request->get('item'),
            'nos' => $request->get('nos'),
        ]);

        return redirect()->route('items.index')->with('success', 'Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::where('id', $id)->first();
        return view('edit-items', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'nos' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('items.edit', ['item' => $id])->withErrors($validator);
        }

        $item = Item::where('id', $id)->first();
        $item->item = $request->get('item');
        $item->nos = $request->get('nos');
        $item->is_purchased = $request->get('is_purchased');
        $item->save();

        return redirect()->route('items.index')->with('success', 'Updated item');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Item::where('id', $id)->delete();
        return redirect()->route('items.index')->with('success', 'Deleted item');
    }
}