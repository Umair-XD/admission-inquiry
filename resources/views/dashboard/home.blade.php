@extends('dashboard.layouts.app')
@section('content')
      <!--======================================= Content Area Start =================================================-->
      <div class="container-fluid">
        <div class="row py-4">
    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-primary-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-users fa-5x m-2 text-primary"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-primary">Inquires</h5>
                  <p class="card-text flex-grow-1">This is a wider card with supporting text.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-success-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-building-columns fa-5x m-3 text-success"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-success">Departments</h5>
                  <p class="card-text flex-grow-1">Explore all university departments and faculties.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-danger-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-user-graduate fa-5x m-2 text-danger"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-danger">Admissions</h5>
                  <p class="card-text flex-grow-1">Check admission criteria,<br>apply online.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-warning-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-book-reader fa-5x m-3 text-warning"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-warning">Library</h5>
                  <p class="card-text flex-grow-1">Access books, e-resources, and research materials.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
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
                    @foreach ($students as $student)

                      <tr>
                         <td>{{$student->name}}</td>
                         <td>{{$student->department}}</td>
                         <td>{{$student->age}}</td>
                         <td>{{$student->phone_no}}</td>
                         <td>{{$student->id_card}}</td>
                         <td>{{$student->matric_marks}}</td>
                         <td>{{$student->part1_marks}}</td>
                         <td>{{$student->part2_marks}}</td>
                         <td>{{$student->entry_test_marks}}</td>
                       </tr>

                    @endforeach





                     {{-- <tr>
                       <td>Fatima Zahra</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0309-3344556</td>
                       <td>35206-3344556-6</td>
                       <td>925</td>
                       <td>470</td>
                       <td>455</td>
                       <td>90</td>
                     </tr>

                     <tr>
                       <td>Usman Tariq</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0342-7788990</td>
                       <td>35207-7788990-7</td>
                       <td>860</td>
                       <td>430</td>
                       <td>430</td>
                       <td>70</td>
                     </tr>

                     <tr>
                       <td>Maryam Iqbal</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0315-6677889</td>
                       <td>35208-6677889-8</td>
                       <td>845</td>
                       <td>425</td>
                       <td>420</td>
                       <td>69</td>
                     </tr>

                     <tr>
                       <td>Bilal Ahmed</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0336-2211334</td>
                       <td>35209-2211334-9</td>
                       <td>890</td>
                       <td>445</td>
                       <td>445</td>
                       <td>77</td>
                     </tr>

                     <tr>
                       <td>Zain Abbas</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0307-8899001</td>
                       <td>35210-8899001-0</td>
                       <td>865</td>
                       <td>430</td>
                       <td>435</td>
                       <td>71</td>
                     </tr>

                     <tr>
                       <td>Noor Fatima</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0324-5566001</td>
                       <td>35211-5566001-1</td>
                       <td>905</td>
                       <td>455</td>
                       <td>450</td>
                       <td>84</td>
                     </tr>

                     <tr>
                       <td>Hamza Shah</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0319-3344778</td>
                       <td>35212-3344778-2</td>
                       <td>875</td>
                       <td>438</td>
                       <td>437</td>
                       <td>73</td>
                     </tr>

                     <tr>
                       <td>Iqra Nadeem</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0348-1122998</td>
                       <td>35213-1122998-3</td>
                       <td>830</td>
                       <td>415</td>
                       <td>415</td>
                       <td>65</td>
                     </tr>

                     <tr>
                       <td>Saad Ullah</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0305-7788112</td>
                       <td>35214-7788112-4</td>
                       <td>855</td>
                       <td>425</td>
                       <td>430</td>
                       <td>69</td>
                     </tr>

                     <tr>
                       <td>Hira Salman</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0331-4455667</td>
                       <td>35215-4455667-5</td>
                       <td>920</td>
                       <td>465</td>
                       <td>455</td>
                       <td>88</td>
                     </tr>

                     <tr>
                       <td>Abdullah Noor</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0320-6677009</td>
                       <td>35216-6677009-6</td>
                       <td>885</td>
                       <td>440</td>
                       <td>445</td>
                       <td>76</td>
                     </tr>

                     <tr>
                       <td>Laiba Ahmed</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0341-9988775</td>
                       <td>35217-9988775-7</td>
                       <td>835</td>
                       <td>418</td>
                       <td>417</td>
                       <td>66</td>
                     </tr>

                     <tr>
                       <td>Shayan Malik</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0308-2233449</td>
                       <td>35218-2233449-8</td>
                       <td>868</td>
                       <td>434</td>
                       <td>434</td>
                       <td>72</td>
                     </tr>

                     <tr>
                       <td>Anaya Rizvi</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0339-5566889</td>
                       <td>35219-5566889-9</td>
                       <td>915</td>
                       <td>460</td>
                       <td>455</td>
                       <td>86</td>
                     </tr>

                     <tr>
                       <td>Rehan Siddiq</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0316-8899443</td>
                       <td>35220-8899443-0</td>
                       <td>878</td>
                       <td>439</td>
                       <td>439</td>
                       <td>74</td>
                     </tr> --}}

                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection

