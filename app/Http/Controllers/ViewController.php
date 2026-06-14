<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Inquiry;
use App\Models\InquiryDegree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ViewController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function academics()
    {
        return view('frontend.academics');
    }

    public function admission()
    {
        return view('frontend.admission');
    }

    public function alumni()
    {
        return view('frontend.alumni');
    }

    public function campuslife()
    {
        return view('frontend.campuslife');
    }

    public function download()
    {
        return view('frontend.download');
    }

    public function home2()
    {
        return view('frontend.home2');
    }

    public function institute()
    {
        return view('frontend.institute');
    }

    public function job()
    {
        return view('frontend.job');
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function doLogin(Request $request)
    {
        try {
            $request->validate([
                'cnic'     => 'required',
                'password' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('open_auth_modal', 'login');
        }

        // Normalize CNIC: strip dashes so both "35201-1234567-1" and "3520112345671" work
        $cnicNormalized = preg_replace('/[^0-9]/', '', $request->cnic);

        $student = Student::where(function ($q) use ($request, $cnicNormalized) {
            $q->where('cnic', $request->cnic)
              ->orWhereRaw("REPLACE(cnic, '-', '') = ?", [$cnicNormalized]);
        })->first();

        if (! $student || ! Hash::check($request->password, $student->password)) {
            return redirect()->back()
                ->with('error', 'Invalid CNIC or password.')
                ->with('open_auth_modal', 'login');
        }

        Session::put('student_id', $student->id);
        Session::put('student_name', $student->name);
        Session::put('student_cnic', $student->cnic);

        return redirect('/')->with('success', 'Welcome back, '.$student->name.'!');
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function saveStudent(Request $request)
    {
        try {
            $request->validate([
                'name'                  => 'required|string|max:255',
                'cnic'                  => 'required|string',
                'mobile'                => 'required|string',
                'age'                   => 'required|integer|min:1|max:120',
                'address'               => 'required|string',
                'password'              => 'required|min:6|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('open_auth_modal', 'register');
        }

        // Normalize CNIC: store as XXXXX-XXXXXXX-X regardless of how the user typed it
        $digits = preg_replace('/[^0-9]/', '', $request->cnic);
        $cnicNormalized = strlen($digits) === 13
            ? substr($digits, 0, 5).'-'.substr($digits, 5, 7).'-'.substr($digits, 12, 1)
            : $request->cnic;

        // Check duplicate (handle both formatted and raw stored values)
        $exists = Student::where('cnic', $cnicNormalized)
            ->orWhereRaw("REPLACE(cnic, '-', '') = ?", [$digits])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'A student with this CNIC is already registered.')
                ->with('open_auth_modal', 'register');
        }

        Student::create([
            'name'     => $request->name,
            'cnic'     => $cnicNormalized,
            'mobile'   => $request->mobile,
            'age'      => $request->age,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()
            ->with('success', 'Account created! You can now log in.')
            ->with('open_auth_modal', 'login');
    }

    public function officeofrector()
    {
        return view('frontend.officeofrector');
    }

    public function researchinnovation()
    {
        return view('frontend.researchinnovation');
    }

    public function signin()
    {
        return view('frontend.signin');
    }

    public function student()
    {
        return view('frontend.student');
    }

    public function profile()
    {
        if (! session()->has('student_id')) {
            return redirect('/')->with('error', 'Please login to view your profile.');
        }
        $student = Student::findOrFail(session('student_id'));
        return view('frontend.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        if (! session()->has('student_id')) {
            return redirect('/')->with('error', 'Please login first.');
        }

        $student = Student::findOrFail(session('student_id'));

        try {
            $rules = [
                'name'    => 'required|string|max:255',
                'mobile'  => 'required|string',
                'age'     => 'required|integer|min:1|max:120',
                'address' => 'required|string',
            ];
            if ($request->filled('password')) {
                $rules['password'] = 'required|min:6|confirmed';
            }
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $student->name    = $request->name;
        $student->mobile  = $request->mobile;
        $student->age     = $request->age;
        $student->address = $request->address;
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        Session::put('student_name', $student->name);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    // public function studentInquiry(){
    //     return view('dashboard.studentInquiry');
    // }

    public function studentInquiry()
    {

        $degrees = Degree::all();
        $departments = Department::all();
        $student = null;

        if (session()->has('student_id')) {
            $student = Student::find(session('student_id'));
        }

        return view('dashboard.studentInquiry', compact('student', 'degrees', 'departments'));
    }

    public function studentInquiryStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'department' => 'required',
            'phone' => 'required',
            'cnic' => 'required',
        ]);

        $inquiry = new Inquiry;
        $inquiry->name = $request->name;
        $inquiry->age = $request->age;
        $inquiry->department = $request->department;
        $inquiry->phone = $request->phone;
        $inquiry->cnic = $request->cnic;
        $inquiry->matric_obtained = $request->matric_obtained;
        $inquiry->matric_total = $request->matric_total;
        $inquiry->part1_obtained = $request->part1_obtained;
        $inquiry->part1_total = $request->part1_total;
        $inquiry->part2_obtained = $request->part2_obtained;
        $inquiry->part2_total = $request->part2_total;
        $inquiry->entry_obtained = $request->entry_obtained;
        $inquiry->entry_total = $request->entry_total;
        $inquiry->save();

        // return redirect()->back()->with('success', 'Inquiry submitted successfully!');
        return redirect()->route('home')->with('success', 'Inquiry submitted successfully!');
    }

    public function getCourses($id)
    {
        $courses = Course::where('department_id', $id)
            ->get();

        return response()->json($courses);
    }

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

    public function logout()
    {
        // Clear only student session data
        Session::forget('student_id');
        Session::forget('student_name');

        // Optional: clear everything
        // Session::flush();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
