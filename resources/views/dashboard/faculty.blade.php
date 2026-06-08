
      @extends('dashboard.layouts.app')

@section('content')
      <!--======================================= Content Area Start =================================================-->
      <div class="container-fluid">
        <div class="row py-4">
            <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-between">
              <h3 class="h3 text-primary"><i class="fa-solid fa-user"></i> Faculty Info </h3>
              <a href="{{route('facultyform')}}" class="btn btn-outline-primary">Add Faculty </a>
            </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="card">
              <h5 class="card-header">Last List</h5>
              <div class="card-body">

                <table id="example" class="table table-striped" style="width:100%">
                  <thead>
                       <tr>
                           <th>Profile</th>
                           <th>FirstName</th>
                           <th>LastName</th>
                           <th>Personal Email</th>
                           <th>Official Email</th>
                           <th>Phone No</th>
                           <th>Designation</th>
                           <th>Last Degree</th>
                           <th>Experience</th>
                           <th>Specialization</th>
                        </tr>
                  </thead>
                  <tbody>
                    @foreach ($faculties as $faculty)
                        <tr>
                            <!-- Profile Picture -->
                            <td>
                                @if ($faculty->profile_picture)
                                    <img src="{{ asset('faculty_pictures/' . $faculty->profile_picture) }}" width="40" height="40">
                                @else
                                    <img src="https://randomuser.me/api/portraits/men/1.jpg" width="40" style="border-radius:50%;">
                                @endif
                            </td>

                            <!-- Names -->
                            <td>{{ $faculty->first_name }}</td>
                            <td>{{ $faculty->last_name }}</td>

                            <!-- Emails -->
                            <td>{{ $faculty->personal_email }}</td>
                            <td>{{ $faculty->official_email }}</td>

                            <!-- Phone & Designation -->
                            <td>{{ $faculty->phone }}</td>
                            <td>{{ $faculty->designation }}</td>

                            <!-- Degree & Experience -->
                            <td>{{ $faculty->degree }}</td>
                            <td>{{ $faculty->experience }} Years</td>

                            <!-- Specialization -->
                            <td>{{ $faculty->specialization }}</td>
                        </tr>
                    @endforeach



                    </tbody>
                </table>
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

    <script src="js/custom.js"></script>
</body>
</html>
