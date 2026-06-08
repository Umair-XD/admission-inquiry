
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
