@extends('frontend.layouts.app')

@section('content')

<style>
/* Compact NUST-style spacing fix */
.page-wrap{
  padding-top: 5px !important;
  padding-bottom: 5px !important;
}

.glass-card{
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}
</style>

<div class="container-fluid page-wrap">

  <div class="row justify-content-center">

    <div class="col-12 col-lg-10">

      <!-- MAIN CARD -->
      <div class="card glass-card shadow-lg rounded-4 p-3">

        <!-- HEADER -->
        <div class="text-center mb-2">

          <img src="https://img.freepik.com/free-photo/close-up-smiley-woman-library_23-2149204737.jpg?semt=ais_hybrid&w=740&q=80"
               class="rounded-circle border-3 border-dark mb-2"
               style="width:100px;height:100px;">

          <h4 class="fw-bold mb-0">Student Profile</h4>

          <!-- STATUS -->
          <span class="badge bg-success mt-1 px-3 py-1">
            Active Student
          </span>

        </div>

        <!-- DASHBOARD STATS -->
        <div class="row g-2 mb-2">

          <div class="col-md-4">
            <div class="card glass-card p-2 text-center">
              <small class="text-muted">Courses</small>
              <h5 class="fw-bold mb-0">5</h5>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card glass-card p-2 text-center">
              <small class="text-muted">Attendance</small>
              <h5 class="fw-bold mb-0">90%</h5>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card glass-card p-2 text-center">
              <small class="text-muted">CGPA</small>
              <h5 class="fw-bold mb-0">3.6</h5>
            </div>
          </div>

        </div>

        <!-- PROFILE FORM -->
        <form>

          <div class="row g-2">

            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text"
                     class="form-control bg-transparent border-dark auto-select"
                     value="Ayesha Khan">
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email"
                     class="form-control bg-transparent border-dark auto-select"
                     value="ayesha@email.com">
            </div>

            <div class="col-md-6">
              <label class="form-label">Department</label>
              <input type="text"
                     class="form-control bg-transparent border-dark auto-select"
                     value="Computer Science">
            </div>

            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text"
                     class="form-control bg-transparent border-dark auto-select"
                     value="0300-1234567">
            </div>

          </div>

          <!-- STATUS -->
          <div class="mt-2">
            <label class="form-label">Student Status</label>
            <select class="form-control bg-transparent border-dark">
              <option selected>Active</option>
              <option>Inactive</option>
              <option>Pending</option>
              <option>Graduated</option>
            </select>
          </div>

          <!-- BUTTON -->
          <button type="submit" class="btn btn-primary w-100 mt-2">
            Update Profile
          </button>

        </form>

      </div>

    </div>
  </div>

</div>

<!-- AUTO SELECT SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".auto-select").forEach(input => {

    input.addEventListener("focus", function () {
      this.select();
    });

    input.addEventListener("click", function () {
      this.select();
    });

  });

});
</script>

@endsection