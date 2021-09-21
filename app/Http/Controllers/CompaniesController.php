<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::latest()->paginate(5);
        return view('companies.index', compact('companies'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|min:100|max:5000',
            'website' => 'required'
        ]);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $request->validate([
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|min:100|max:5000',
            ]);
            $path = $request->file('image')->store('public/images');
            $path = explode('/', $path);
            $path = end($path);
            $input['logo'] = "$path";
        }
        Companies::create($input);
        return redirect()->route('companies.index')->with('success', 'Companies created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies, $id)
    {
		$companies = $companies->find($id);
        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|min:100|max:5000',
            'website' => 'required'
        ]);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $request->validate([
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|min:100|max:5000',
            ]);
            $path = $request->file('image')->store('public/images');
            $path = explode('/', $path);
            $path = end($path);
            $input['logo'] = "$path";
        } else {
            unset($input['logo']);
        }
        // Temporrary Remove
        unset($input['image']);
        unset($input['_token']);
        unset($input['_method']);
        Companies::where('id', $id)->update($input);
        return redirect()->route('companies.index')->with('success','Companies updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Companies $companies)
    {
        $companies->where('id', $id)->delete();
        return redirect()->route('companies.index')->with('success','Companies deleted successfully');
    }
}
