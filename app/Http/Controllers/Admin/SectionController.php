<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    public function section()
    {
        Session::put('page', 'sections');
        $sections = Section::get()->toArray();
        // dd($section);
        return view('admin.sections.sections')->with(compact('sections'));
    }
    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            section::where('id', $data['Section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'Section_id' => $data['Section_id']]);
        }
    }
    public function deleteSection($id)
    {
        $catagory = Section::where('id', $id)->delete();
        $message = "Section has been deleted successfully !";
        return redirect()->back()->with("success_message", $message);
    }

    public function editSection(Request $request, $id = null)
    {
        Session::put('page', 'sections');

        if ($id == null) {
            $section = new Section;
            $title = "Add new section ";
            $message = "Section added successfully!";
        } else {
            $section = Section::find($id);
            $title = "Edit section ";
            $message = "Section updated successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                "section-name" => "required|regex:/^[\pL\s\-]+$/u",
            ];
            $customMessage = [
                'section-name.required' => 'Section name is required',
                'section-name.regex' => 'Valid section name is required',
            ];
            $this->validate($request, $rules, $customMessage);
            $section->name = $data['section-name'];
            $section->status = 1;
            $section->save();
            return redirect('admin/sections')->with('success_message',$message);
        }
        return view('admin.sections.add_edit_section')->with(compact('title', 'message', 'section'));
    }
}
