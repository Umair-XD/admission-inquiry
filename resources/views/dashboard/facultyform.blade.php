
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
              <h3 class="h3 text-primary"><i class="fa-solid fa-solid fa-chalkboard-user"></i> Faculty Information Form </h3>
              <a href="{{route("faculty")}}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="card">

              <div class="card-body">

                <form class="row g-4 p-4 bg-light" method="POST" action="{{ route('facultyform.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Clickable Picture Upload Square -->
                    <div class="col-12 text-center mb-4">
                        <input type="file" name="profile_picture" id="picture" accept="image/*" required style="display:none;" onchange="previewImage(event)">
                        <div onclick="document.getElementById('picture').click();"
                            style="width:150px; height:150px; border:2px dashed #0d6efd; display:flex; align-items:center; justify-content:center; overflow:hidden; border-radius:8px; cursor:pointer; margin:auto;">
                        <img id="preview" src="" alt="Preview" style="width:100%; height:100%; object-fit:cover; display:none;">
                        <span id="placeholderText" style="color:#0d6efd; font-weight:bold;">Click to upload</span>
                        </div>
                        <!-- Profile text under picture -->
                        <div style="margin-top:8px; font-weight:bold; color:#0d6efd;">Profile</div>
                    </div>

                    <!-- First & Last Name -->
                    <div class="col-md-6">
                        <label for="firstName" class="form-label fw-semibold"><i class="fa-solid fa-user me-1"></i>First Name</label>
                        <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter First Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label fw-semibold"><i class="fa-solid fa-user me-1"></i>Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Enter Last Name" required>
                    </div>

                    <!-- Personal & Official Email -->
                    <div class="col-md-6">
                        <label for="personalEmail" class="form-label fw-semibold"><i class="fa-solid fa-envelope me-1"></i>Personal Email</label>
                        <input type="email" class="form-control" name="personal_email" id="personalEmail" placeholder="example@gmail.com" required>
                    </div>
                    <div class="col-md-6">
                        <label for="officialEmail" class="form-label fw-semibold"><i class="fa-solid fa-envelope me-1"></i>Official Email</label>
                        <input type="email" class="form-control" name="official_email" id="officialEmail" placeholder="example@university.com" required>
                    </div>

                    <!-- Phone & Designation -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold"><i class="fa-solid fa-phone me-1"></i>Phone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone No" required>
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label fw-semibold"><i class="fa-solid fa-briefcase me-1"></i>Designation</label>
                        <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" required>
                    </div>

                    <!-- Degree, Experience & Specialization -->
                    <div class="col-md-6">
                        <label for="degree" class="form-label fw-semibold"><i class="fa-solid fa-graduation-cap me-1"></i>Last Degree</label>
                        <input type="text" class="form-control" name="degree" id="degree" placeholder="Enter Last Degree" required>
                    </div>
                    <div class="col-md-3">
                        <label for="experience" class="form-label fw-semibold"><i class="fa-solid fa-hourglass-half me-1"></i>Experience (Years)</label>
                        <input type="number" class="form-control" name="experience" id="experience" placeholder="Enter Experience" required>
                    </div>
                    <div class="col-md-3">
                        <label for="specialization" class="form-label fw-semibold"><i class="fa-solid fa-star me-1"></i>Specialization</label>
                        <input type="text" class="form-control" name="specialization" id="specialization" placeholder="Enter Specialization" required>
                    </div>

                    <!-- Confirm Checkbox -->
                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirmInfo">
                        <label class="form-check-label fw-semibold" for="confirmInfo">
                            Confirm information
                        </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fa-solid fa-paper-plane me-2"></i>Submit
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
function previewImage(event) {
  const preview = document.getElementById('preview');
  const placeholder = document.getElementById('placeholderText');
  const file = event.target.files[0];

  if(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
      placeholder.style.display = 'none';
    }
    reader.readAsDataURL(file);
  }
}
</script>

<script>
document.querySelector("form").addEventListener("submit", function(e) {

    let confirmBox = document.getElementById("confirmInfo");

    if (!confirmBox.checked) {
        e.preventDefault(); // stop form submit
        alert("Please confirm the information before submitting.");
    }

});
</script>


    <script src="js/custom.js"></script>
</body>
</html>
