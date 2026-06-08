<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Inquiry;
use App\Models\Degree;
use App\Models\Department;
use App\Models\InquiryDegree;
use App\Models\Course;


class DashboardController extends Controller
{

    public function __construct()
    {
        if (!session()->get('is_admin')) {
            abort(403);
        }
    }
    public function dashboard(){

        $students=Student::all();
        return view('dashboard.home', compact('students'));
    }
    public function faculty(){
        $faculties=Faculty::all();
        return view('dashboard.faculty',compact('faculties'));
    }
    public function facultyform(){
        return view('dashboard.facultyform');
    }
    public function storeFaculty(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'personal_email' => 'required|email|max:255',
            'official_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'specialization' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $facultyData = $request->only([
            'first_name', 'last_name', 'personal_email', 'official_email',
            'phone', 'designation', 'degree', 'experience', 'specialization'
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('faculty_pictures'), $filename);
            $facultyData['profile_picture'] = $filename;
        }
        Faculty::create($facultyData);

        return redirect()->back()->with('success', 'Faculty record saved successfully!');
    }
    // public function inquires(){
    //     $inquiries=Inquiry::all();
    //     return view('dashboard.inquires',compact('inquiries'));

    // }

    public function inquires()
    {
        $inquiries = Inquiry::with(['department', 'course', 'degrees'])->get();

        return view('dashboard.inquires', compact('inquiries'));
    }


    // public function inquiresform(){
    //     return view('dashboard.inquiryform');
    // }

    public function inquiresform()
    {
        $degrees = Degree::all();
        $departments = Department::all();

        return view('dashboard.inquiryform', compact('degrees', 'departments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $request->status;
        $inquiry->save();

        return back()->with('success','Status updated');
    }

    // public function getCourses($id)
    // {
    //     $courses = Course::where('department_id', $id)
    //         ->get();
    //     return response()->json($courses);
    // }

    // public function inquiresformStore(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => 'required',
    //         'age' => 'required|numeric',
    //         'department' => 'required',
    //         'phone' => 'required',
    //         'cnic' => 'required',
    //     ]);

    //     $inquiry = new Inquiry();
    //     $inquiry->name = $request->name;
    //     $inquiry->age = $request->age;
    //     $inquiry->department = $request->department;
    //     $inquiry->phone = $request->phone;
    //     $inquiry->cnic = $request->cnic;
    //     $inquiry->matric_obtained = $request->matric_obtained;
    //     $inquiry->matric_total = $request->matric_total;
    //     $inquiry->part1_obtained = $request->part1_obtained;
    //     $inquiry->part1_total = $request->part1_total;
    //     $inquiry->part2_obtained = $request->part2_obtained;
    //     $inquiry->part2_total = $request->part2_total;
    //     $inquiry->entry_obtained = $request->entry_obtained;
    //     $inquiry->entry_total = $request->entry_total;
    //     $inquiry->status = 'active';
    //     $inquiry->save();

    //     return redirect()->back()->with('success', 'Inquiry submitted successfully!');
    // }

    public function inquiresformStore(Request $request)
    {
        // dd($request->all());
        // ✅ VALIDATION
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'cnic' => 'required',
            'department_id' => 'required',
            'course_id' => 'required',
        ]);

        // ✅ 1. SAVE MAIN INQUIRY
        $inquiry = Inquiry::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'department_id' => $request->department_id,
            'course_id' => $request->course_id,
            'status' => 'active',
        ]);

        // ✅ 2. SAVE ALL DEGREES (LOOP)
        if ($request->has('degrees')) {

            foreach ($request->degrees as $degree_id => $data) {

                // ❗ skip empty rows (important)
                if (
                    empty($data['obtained']) &&
                    empty($data['total']) &&
                    empty($data['part1_obtained']) &&
                    empty($data['part2_obtained'])
                ) {
                    continue;
                }

                InquiryDegree::create([
                    'inquiry_id' => $inquiry->id,
                    'degree_id' => $degree_id,

                    // Common
                    'obtained' => $data['obtained'] ?? null,
                    'total' => $data['total'] ?? null,

                    // Intermediate
                    'part1_obtained' => $data['part1_obtained'] ?? null,
                    'part1_total' => $data['part1_total'] ?? null,
                    'part2_obtained' => $data['part2_obtained'] ?? null,
                    'part2_total' => $data['part2_total'] ?? null,
                ]);
            }
        }

        // ✅ 3. OPTIONAL ENTRY TEST
        if ($request->entry_obtained) {
            $inquiry->entry_obtained = $request->entry_obtained;
            $inquiry->entry_total = $request->entry_total;
            $inquiry->save();
        }

        return redirect()->back()->with('success', 'Inquiry submitted successfully!');
    }

    public function inquiresformUpdate(Request $request, $id)
    {
        // dd($request->all());

        // ✅ VALIDATION
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'cnic' => 'required',
        ]);

        // ✅ 1. FIND INQUIRY
        $inquiry = Inquiry::findOrFail($id);

        // ✅ 2. UPDATE MAIN INQUIRY (USING SAVE ONLY)
        $inquiry->name = $request->name;
        $inquiry->age = $request->age;
        $inquiry->phone = $request->phone;
        $inquiry->cnic = $request->cnic;
        // $inquiry->department_id = $request->department_id;
        // $inquiry->course_id = $request->course_id;

        // entry test (also save here if you want single save)
        $inquiry->entry_obtained = $request->entry_obtained;
        $inquiry->entry_total = $request->entry_total;

        $inquiry->save(); // ✅ ONE SAVE ONLY

        // ✅ 3. UPDATE / INSERT DEGREES
        if ($request->has('degrees')) {

            foreach ($request->degrees as $degree_id => $data) {

                $degree = InquiryDegree::where('inquiry_id', $inquiry->id)
                                    ->where('degree_id', $degree_id)
                                    ->first();

                if ($degree) {

                    // ✅ update existing
                    $degree->obtained = $data['obtained'] ?? null;
                    $degree->total = $data['total'] ?? null;

                    $degree->part1_obtained = $data['part1_obtained'] ?? null;
                    $degree->part1_total = $data['part1_total'] ?? null;
                    $degree->part2_obtained = $data['part2_obtained'] ?? null;
                    $degree->part2_total = $data['part2_total'] ?? null;

                    $degree->save(); // ✅ SAVE

                } else {

                    // ❗ create new if not exists
                    $degree = new InquiryDegree();

                    $degree->inquiry_id = $inquiry->id;
                    $degree->degree_id = $degree_id;

                    $degree->obtained = $data['obtained'] ?? null;
                    $degree->total = $data['total'] ?? null;

                    $degree->part1_obtained = $data['part1_obtained'] ?? null;
                    $degree->part1_total = $data['part1_total'] ?? null;
                    $degree->part2_obtained = $data['part2_obtained'] ?? null;
                    $degree->part2_total = $data['part2_total'] ?? null;

                    $degree->save(); // ✅ SAVE

                }
            }
        }

        return redirect()->back()->with('success', 'Inquiry updated successfully!');
    }

    public function destroy($id)
    {
        // find inquiry
        $inquiry = Inquiry::findOrFail($id);

        // delete related degrees first (important)
        InquiryDegree::where('inquiry_id', $inquiry->id)->delete();

        // delete main inquiry
        $inquiry->delete();

        return redirect()->back()->with('success', 'Inquiry deleted successfully!');
    }


    public function student(){
        return view('dashboard.student');
    }

}
