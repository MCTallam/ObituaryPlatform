<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Obituary;

class ObituaryController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'date_of_birth' => 'required|date',
            'date_of_death' => 'required|date',
            'content' => 'required',
            'author' => 'required|max:100',
        ]);
    
        $obituary = new Obituary();
        $obituary->fill($request->all());
        $obituary->slug = Str::slug($request->name . '-' . now()->timestamp);
        $obituary->save();
    

        // Redirect to the obituary list page with a success message
        return redirect()->route('view_obituaries')->with('success', 'Obituary submitted successfully.');        
    }
    public function index()
    {
        $obituaries = Obituary::paginate(10); // or Obituary::all() for all records
        return view('view_obituaries', compact('obituaries'));
    }
    public function destroy($id)
{
    $obituary = Obituary::findOrFail($id);
    $obituary->delete();

    return redirect()->route('view_obituaries')->with('success', 'Obituary deleted successfully.');
}


}
