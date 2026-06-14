<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FacultyListRequest;
use App\Http\Requests\Dashboard\InquiryListRequest;
use App\Http\Requests\Dashboard\StudentListRequest;
use App\Models\Course;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Inquiry;
use App\Models\InquiryComment;
use App\Models\InquiryDegree;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // Auth is enforced via the 'admin.auth' middleware on the route group.
    public function dashboard()
    {
        $user = auth()->user();

        $inquiryQuery = Inquiry::query();
        if ($user->role === 'staff' && $user->department_id) {
            $inquiryQuery->where('department_id', $user->department_id);
        }

        $totalInquiries   = (clone $inquiryQuery)->count();
        $totalDepartments = Department::count();
        $totalFaculty     = Faculty::count();
        $totalStudents    = Student::count();
        $recentInquiries  = (clone $inquiryQuery)->with('department')->latest()->take(10)->get();

        return view('dashboard.home', compact(
            'totalInquiries',
            'totalDepartments',
            'totalFaculty',
            'totalStudents',
            'recentInquiries'
        ));
    }

    public function faculty(FacultyListRequest $request)
    {
        if ($request->ajax()) {
            return $request->processRequest();
        }

        $departments = Department::orderBy('name')->get();
        return view('dashboard.faculty', compact('departments'));
    }

    public function facultyform()
    {
        return view('dashboard.facultyform');
    }

    public function storeFaculty(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'personal_email'  => 'required|email|max:255',
            'official_email'  => 'required|email|unique:users,email|max:255',
            'password'        => 'required|string|min:8|confirmed',
            'phone'           => 'required|string|max:20',
            'designation'     => 'required|string|max:255',
            'degree'          => 'required|string|max:255',
            'experience'      => 'required|integer|min:0',
            'specialization'  => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the staff user account
        $user = User::create([
            'name'     => $request->first_name.' '.$request->last_name,
            'email'    => $request->official_email,
            'password' => $request->password, // hashed cast handles this
            'role'     => RoleEnum::STAFF,
        ]);
        try { $user->syncRoles(['staff']); } catch (\Exception $e) { /* Spatie cache issue — role column already set */ }

        // Build faculty data
        $facultyData = $request->only([
            'first_name', 'last_name', 'personal_email', 'official_email',
            'phone', 'designation', 'degree', 'experience', 'specialization',
        ]);
        $facultyData['user_id'] = $user->id;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('faculty_pictures'), $filename);
            $facultyData['profile_picture'] = $filename;
        }

        Faculty::create($facultyData);

        return redirect()->route('faculty')->with('success', 'Faculty added and staff account created successfully!');
    }
    // public function inquires(){
    //     $inquiries=Inquiry::all();
    //     return view('dashboard.inquires',compact('inquiries'));

    // }

    public function inquires(InquiryListRequest $request)
    {
        if ($request->ajax()) {
            return $request->processRequest();
        }

        return view('dashboard.inquires');
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

        return back()->with('success', 'Status updated');
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
            'course_id' => 'nullable|exists:courses,id',
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

    public function edit($id)
    {
        $inquiry     = Inquiry::with('degrees')->findOrFail($id);
        $matric      = $inquiry->degrees->where('degree_id', 1)->first();
        $inter       = $inquiry->degrees->where('degree_id', 2)->first();
        $bs          = $inquiry->degrees->where('degree_id', 3)->first();
        $ms          = $inquiry->degrees->where('degree_id', 4)->first();
        $departments = Department::orderBy('name')->get();
        $degrees     = Degree::all();

        return view('dashboard.inquiry_edit_modal', compact('inquiry', 'matric', 'inter', 'bs', 'ms', 'departments', 'degrees'));
    }

    public function inquiresformUpdate(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'name'          => 'required',
            'age'           => 'required|numeric',
            'phone'         => 'required',
            'cnic'          => 'required',
            'department_id' => 'required|exists:departments,id',
            'course_id'     => 'nullable|exists:courses,id',
        ]);

        $inquiry = Inquiry::findOrFail($id);

        $inquiry->name           = $request->name;
        $inquiry->age            = $request->age;
        $inquiry->phone          = $request->phone;
        $inquiry->cnic           = $request->cnic;
        $inquiry->department_id  = $request->department_id;
        $inquiry->course_id      = $request->course_id ?: null;
        $inquiry->entry_obtained = $request->entry_obtained ?: null;
        $inquiry->entry_total    = $request->entry_total ?: null;

        $inquiry->save();

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
                    $degree = new InquiryDegree;

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

    public function student(StudentListRequest $request)
    {
        if ($request->ajax()) {
            return $request->processRequest();
        }

        return view('dashboard.student');
    }

    public function editStudent(Student $student)
    {
        return view('dashboard.student_edit_modal', compact('student'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'age'               => 'required|numeric|min:1|max:100',
            'mobile'            => 'required|string|max:20',
            'cnic'              => 'required|string|max:20',
            'address'           => 'nullable|string|max:500',
            'matric_marks'      => 'nullable|numeric',
            'part1_marks'       => 'nullable|numeric',
            'part2_marks'       => 'nullable|numeric',
            'entry_test_marks'  => 'nullable|numeric',
        ]);

        $student->update($request->only([
            'name', 'age', 'mobile', 'cnic', 'address',
            'matric_marks', 'part1_marks', 'part2_marks', 'entry_test_marks',
        ]));

        return back()->with('success', 'Student updated successfully.');
    }

    public function destroyStudent(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Student deleted successfully.');
    }

    public function editFaculty(Faculty $faculty)
    {
        return view('dashboard.faculty_edit_modal', compact('faculty'));
    }

    public function updateFaculty(Request $request, Faculty $faculty)
    {
        $rules = [
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'personal_email'  => 'required|email|max:255',
            'official_email'  => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'designation'     => 'required|string|max:255',
            'degree'          => 'required|string|max:255',
            'experience'      => 'required|integer|min:0',
            'specialization'  => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        $request->validate($rules);

        $data = $request->only([
            'first_name', 'last_name', 'personal_email', 'official_email',
            'phone', 'designation', 'degree', 'experience', 'specialization',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('faculty_pictures'), $filename);
            $data['profile_picture'] = $filename;
        }

        $faculty->update($data);

        // Update linked user's name, email and optionally password
        if ($faculty->user_id) {
            $userUpdate = [
                'name'  => $request->first_name.' '.$request->last_name,
                'email' => $request->official_email,
            ];
            if ($request->filled('password')) {
                $userUpdate['password'] = $request->password;
            }
            User::where('id', $faculty->user_id)->update($userUpdate);
        }

        return back()->with('success', 'Faculty updated successfully.');
    }

    public function destroyFaculty(Faculty $faculty)
    {
        $faculty->delete();
        return back()->with('success', 'Faculty member deleted successfully.');
    }

    public function showInquiry(Inquiry $inquiry)
    {
        $inquiry->load(['department', 'course', 'degrees', 'comments.user']);
        return view('dashboard.inquiry_view_modal', compact('inquiry'));
    }

    public function showStudent(Student $student)
    {
        return view('dashboard.student_view_modal', compact('student'));
    }

    public function showFacultyView(Faculty $faculty)
    {
        $faculty->load('user.department');
        return view('dashboard.faculty_view_modal', compact('faculty'));
    }

    public function showComments(Inquiry $inquiry)
    {
        $inquiry->load(['comments.user', 'department', 'course']);
        return view('dashboard.inquiry_comments_modal', compact('inquiry'));
    }

    public function storeComment(Request $request, Inquiry $inquiry)
    {
        $request->validate(['body' => 'required|string|max:1000']);
        $comment = InquiryComment::create([
            'inquiry_id' => $inquiry->id,
            'user_id'    => auth()->id(),
            'body'       => $request->body,
        ]);
        $comment->load('user');

        return response()->json([
            'initial' => strtoupper(substr($comment->user->name, 0, 1)),
            'name'    => $comment->user->name,
            'body'    => e($comment->body),
            'time'    => $comment->created_at->diffForHumans(),
        ]);
    }

    public function assignDepartment(Request $request, Faculty $faculty)
    {
        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
        ]);

        if (! $faculty->user_id) {
            return back()->with('error', 'This faculty member has no linked user account.');
        }

        User::where('id', $faculty->user_id)
            ->update(['department_id' => $request->department_id ?: null]);

        return back()->with('success', 'Department assigned successfully.');
    }
}
