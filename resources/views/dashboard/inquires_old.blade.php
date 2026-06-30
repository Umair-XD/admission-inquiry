
        @extends('dashboard.layouts.app')

@section('content')
      <!--======================================= Content Area Start =================================================-->
      <div class="container-fluid">
        <div class="row py-4">
            <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-between">
              <h3 class="h3 text-primary"><i class="fa-solid fa-user"></i> Inquires </h3>
              <a href="{{route('inquiryform')}}" class="btn btn-outline-primary">Add Inquiry </a>
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
                          <th>Name</th>
                          <th>Department</th>
                          <th>Age</th>
                          <th>Phone no</th>
                          <th>ID Card</th>
                          <th>Matric Marks</th>
                          <th>Part 1 marks</th>
                          <th>Part 2 marks</th>
                          <th>Entry test marks</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($inquiries as $inquiry)
                            <tr>
                                <td>{{$inquiry->name}}</td>
                                <td>{{$inquiry->department}}</td>
                                <td>{{$inquiry->age}}</td>
                                <td>{{$inquiry->phone}}</td>
                                <td>{{$inquiry->cnic}}</td>
                                <td>{{$inquiry->matric_obtained}}</td>
                                <td>{{$inquiry->part1_obtained}}</td>
                                <td>{{$inquiry->part2_obtained}}</td>
                                <td>{{$inquiry->entry_obtained}}</td>
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
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables-1.11.5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap5-1.11.5.min.js') }}"></script>

<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.buttons-2.2.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.bootstrap5-2.2.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.html5-2.2.2.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/buttons.print-2.2.2.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/buttons.colVis-2.2.2.min.js') }}"></script>

    <script src="js/custom.js"></script>
</body>
</html>
