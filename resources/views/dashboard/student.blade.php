
@extends('dashboard.layouts.app')

@section('content')

        @if(session('success'))
            <div class="container-fluid mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
      <!--======================================= Content Area Start =================================================-->
      <div class="container-fluid">
        <div class="row py-4">
            <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-between">
              <h3 class="h3 text-primary"><i class="fa-solid fa-user"></i> Student Form </h3>
              <a href="{{route('admin.dashboard')}}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="card">
              <h5 class="card-header">Add Inquiry</h5>
              <div class="card-body">
                <form class="row g-4 p-4 bg-light" method="POST" action="{{ route('inquiryform.store') }}" enctype="multipart/form-data">

                    @csrf
                     <!-- Name & Age -->
                    <div class="col-md-6">
                       <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                     </div>


                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Age</label>
                       <input type="number" name="age" class="form-control" placeholder="Enter age">
                     </div>

                     <!-- Department -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Department</label>
                       <select name="department" class="form-select">
                         <option selected disabled>Select Department</option>
                         <option value="cs">Computer Science</option>
                         <option>Electrical Department</option>
                         <option>Mechanical Department</option>
                         <option>Civil Department</option>
                         <option>BBA Department</option>
                       </select>
                     </div>

                     <!-- CS Field -->
                     <div class="col-md-6 d-none" id="csDropdown">
                       <label class="form-label fw-semibold">Dicipline</label>
                       <select class="form-select">
                         <option selected disabled>Select Field</option>
                         <option>Artificial Intelligence</option>
                         <option>Data Science</option>
                         <option>Cyber Security</option>
                       </select>
                     </div>

                     <!-- Phone & CNIC -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Phone No</label>
                       <input type="text" name="phone" class="form-control" placeholder="03xx-xxxxxxx">
                        <small id="phoneError" class="text-danger"></small>
                     </div>

                     <div class="col-md-6">
                       <label class="form-label fw-semibold">ID Card</label>
                       <input type="text" name="cnic" class="form-control" placeholder="3303-xxxxxxx-x">
                       <small id="errorBox" class="text-danger"></small>
                     </div>

                     <!-- Matric -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Matric Marks</label>
                       <div class="row g-2">
                         <div class="col-6">
                           <input type="number" name="matric_obtained" class="form-control" placeholder="Obtained">
                         </div>
                         <div class="col-6">
                           <input type="number" name="matric_total" class="form-control" placeholder="Total">
                         </div>
                       </div>
                     </div>

                     <!-- Part 1 -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Part 1 Marks</label>
                       <div class="row g-2">
                         <div class="col-6">
                           <input type="number" name="part1_obtained" class="form-control" placeholder="Obtained">
                         </div>
                         <div class="col-6">
                           <input type="number" name="part1_total" class="form-control" placeholder="Total">
                         </div>
                       </div>
                     </div>

                     <!-- Part 2 -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Part 2 Marks</label>
                       <div class="row g-2">
                         <div class="col-6">
                           <input type="number" name="part2_obtained" class="form-control" placeholder="Obtained">
                         </div>
                         <div class="col-6">
                           <input type="number" name="part2_total" class="form-control" placeholder="Total">
                         </div>
                       </div>
                     </div>

                     <!-- Entry Test -->
                     <div class="col-md-6">
                       <label class="form-label fw-semibold">Entry Test</label>

                       <div class="form-check mb-2">
                         <input class="form-check-input"  type="checkbox" id="entryCheck" onchange="toggleEntryTest()">
                         <label class="form-check-label">
                           Appeared in Entry Test
                         </label>
                       </div>

                       <div class="row g-2">
                         <div class="col-6">
                           <input type="number" name="entry_obtained" id="entryObt" class="form-control" placeholder="Obtained" disabled>
                         </div>
                         <div class="col-6">
                           <input type="number" name="entry_total" id="entryTotal" class="form-control" placeholder="Total" disabled>
                         </div>
                       </div>
                     </div>

                     <!-- Confirm -->
                     <div class="col-12">
                       <div class="form-check">
                         <input class="form-check-input" type="checkbox">
                         <label class="form-check-label fw-semibold">
                           Confirm information
                         </label>
                       </div>
                     </div>

                     <!-- Submit -->
                     <div class="col-12 text-center">
                       <button type="submit" class="btn btn-primary px-5">
                         Submit
                       </button>
                     </div>

                </form>

             </div>
            </div>
          </div>
        </div>
      </div>
      @endsection

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="js/datatable.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.colVis.min.js"></script>


<script>
    function showCS() {
        const dept = document.getElementById("department").value;
        const csBox = document.getElementById("csDropdown");

        if (dept === "cs") {
            csBox.classList.remove("d-none");
        } else {
            csBox.classList.add("d-none");
        }
        }

        function toggleEntryTest() {
        const checked = document.getElementById("entryCheck").checked;
        document.getElementById("entryObt").disabled = !checked;
        document.getElementById("entryTotal").disabled = !checked;
    }
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const cnicInput = document.querySelector('input[name="cnic"]');
    const errorBox = document.getElementById("cnicError");

    if (!cnicInput) return;

    cnicInput.addEventListener("input", function (e) {

        let raw = e.target.value.replace(/\D/g, '').slice(0, 13);
        let formatted = raw;

        // FORMAT
        if (raw.length > 5 && raw.length <= 12) {
            formatted = raw.slice(0, 5) + '-' + raw.slice(5);
        } else if (raw.length > 12) {
            formatted = raw.slice(0, 5) + '-' + raw.slice(5, 12) + '-' + raw.slice(12);
        }

        e.target.value = formatted;

        // VALIDATION (LIKE PHONE)
        if (raw.length > 0 && raw.length < 13) {
            errorBox.innerText = "CNIC must be 13 digits (xxxxx-xxxxxxx-x)";
        } else if (raw.length === 13 && !/^[0-9]{13}$/.test(raw)) {
            errorBox.innerText = "CNIC must contain only numbers";
        } else {
            errorBox.innerText = "";
        }
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const phoneInput = document.querySelector('input[name="phone"]');
    const phoneError = document.getElementById("phoneError");

    if (!phoneInput) return;

    phoneInput.addEventListener("input", function (e) {

        let raw = e.target.value.replace(/\D/g, '').slice(0, 11); // only digits, max 11
        let formatted = raw;

        // Add dash after 4 digits
        if (raw.length > 4) {
            formatted = raw.slice(0, 4) + '-' + raw.slice(4);
        }

        e.target.value = formatted;

        // VALIDATION
        if (raw.length > 0 && raw.length < 11) {
            phoneError.innerText = "Phone must be 11 digits (03xx-xxxxxxx)";
        } else if (raw.length === 11 && !raw.startsWith('03')) {
            phoneError.innerText = "Phone must start with 03";
        } else {
            phoneError.innerText = "";
        }
    });

});
</script>

</body>
</html>
