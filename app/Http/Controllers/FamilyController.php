<?php

namespace App\Http\Controllers;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required|date|before:-21 years',
            'mobile' => 'required|unique:families,mobile',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'marital_status' => 'required|in:Married,Unmarried',
            'wedding_date' => 'required_if:marital_status,Married|nullable|date',
            'hobbies' => 'nullable|array',
            'photo' => 'nullable|image|max:2048',
    
            'members.*.name' => 'required|string',
            'members.*.birthdate' => 'required|date',
            'members.*.marital_status' => 'required|in:Married,Unmarried',
            'members.*.wedding_date' => 'nullable|date|required_if:members.*.marital_status,Married',
            'members.*.education' => 'nullable|string',
            'members.*.photo' => 'nullable|image|max:2048',
        ]);
    
        $photoPath = $request->file('photo')?->store('family_photos', 'public');

        $family = Family::create($request->only([
            'name', 'surname', 'birthdate', 'mobile', 'address', 'state', 'city', 'pincode', 'marital_status', 'wedding_date'
        ]) + ['photo' => $photoPath, 'hobbies' => json_encode($request->hobbies)]);
    
        foreach ($request->members ?? [] as $member) {
            $memberPhoto = isset($member['photo']) ? $member['photo']->store('member_photos', 'public') : null;
            $family->members()->create([
                'name' => $member['name'],
                'birthdate' => $member['birthdate'],
                'marital_status' => $member['marital_status'],
                'wedding_date' => $member['wedding_date'] ?? null,
                'education' => $member['education'],
                'photo' => $memberPhoto,
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Family added successfully!'
        ]);
    }
    

    public function index()
    {
        $families = Family::withCount('members')->orderBy('created_at', 'desc')->paginate(10);

        return view('families.index', compact('families'));
    }

    public function show($id) {
        $family = Family::with('members')->findOrFail($id);
        return view('families.show', compact('family'));
    }
}
