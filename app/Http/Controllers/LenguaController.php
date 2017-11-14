<?php

namespace Referentes\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Auth;
use File;

use Referentes\Lengua;

class LenguaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $lenguas = Lengua::all();
        return View::make('lengua.index')->with('lenguas', $lenguas);
    }

    public function create()
	{
       return view('lengua.create');
	}

	public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' =>	'required',
            'imagen'	 => 'required|mimes:png'
        ]);

        $input = $request->all();
        $lengua = Lengua::create($input);
        $lengua->save();

        $imageName = $lengua->id . '.' . $request->file('imagen')->getClientOriginalExtension();
		$request->file('imagen')->move( base_path() . '/public/images/banderas/', $imageName);
        
        $lenguas = Lengua::all();
        return redirect('lenguas')->withSuccess('Lengua ' . $lengua->nombre . ' añadida.');
    }

    public function edit($id)
    {
        $lengua = Lengua::findOrFail($id);
        return View::make('lengua.edit')->with('lengua', $lengua);
    }

    public function update($id, Request $request){
        $input = $request->all();
        $lengua = Lengua::findOrFail($id);
        $this->validate($request, [
            'nombre' => 'required'
        ]);
        if($request->file('imagen')){
            $filename = base_path() . '/public/images/banderas/' . $id . '.png';
            if(File::exists($filename)){
                File::delete($filename);
            }
            $imageName = $lengua->id . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move( base_path() . '/public/images/banderas/', $imageName);
        }
        $lengua->update($input);
        return redirect('lenguas')->withSuccess('Lengua ' . $lengua->nombre . ' actualizada.');
    }

    public function destroy($id)
    {
        $lengua = Lengua::findOrFail($id);
        try {
            $lengua->delete();
            return redirect('lenguas')->withSuccess('Lengua ' . $lengua->nombre . ' eliminada.');
        } catch (\Exception $e) {
            return redirect('lenguas')->withError('Esa lengua está asignada como lengua por defecto a un usuario existente.');
        }
        return redirect('lenguas');
    }
}
