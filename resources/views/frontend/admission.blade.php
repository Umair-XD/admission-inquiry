@extends('frontend.layouts.app')
@section('title', 'Admissions 2026')

@section('content')
<!-- MAIN CONTENT -->
<div class="container py-5">

    <h2 class="text-center text-primary mb-4">Admissions 2026</h2>

    <!-- Image -->
    <div class="d-flex justify-content-center mb-4">
        <img src="https://i.ytimg.com/vi/OhlWOOwUCUs/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDDwS8X48Gws-93F_9lmdw-bHE1XQ"
             class="img-fluid rounded animate-img shadow"
             style="max-width: 450px;">
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Online Application Start</td>
                    <td>01 Jan 2026</td>
                    <td><a href="#">Apply Now</a></td>
                </tr>
                <tr>
                    <td>Application Deadline</td>
                    <td>31 Mar 2026</td>
                    <td><a href="#">Deadline Info</a></td>
                </tr>
                <tr>
                    <td>Entry Test</td>
                    <td>15 Apr 2026</td>
                    <td><a href="#">Test Schedule</a></td>
                </tr>
                <tr>
                    <td>Merit List Announcement</td>
                    <td>01 May 2026</td>
                    <td><a href="#">View List</a></td>
                </tr>
                <tr>
                    <td>Admission Confirmation</td>
                    <td>10 May 2026</td>
                    <td><a href="#">Confirm Admission</a></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

