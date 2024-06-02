<x-newLayout page="3">
    {{-- @dd($students) --}}
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Create Attendance</h4>
        </div>
    </div>

    <x-attendance-header route='create' page="attendance" />

    <!-- /.card -->
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <div class="text-right d-flex col-12 text-left justify-content-around" style="width: 100%">
            {{-- <div class="input-group col-3 mb-3">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-primary best-shadow">Year %</button>
                </div>
                <input type="number" value="{{ isset($students[0]->year) ? $students[0]->year : '' }}" name="percent"
                    class="attendanceYear col-12 best-shadow form-control ">
            </div> --}}
            <div class="input-group col-3 mb-3">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-primary h45px best-shadow">Total Year</button>
                </div>
                <input type="number" value="{{ isset($students[0]->total_year) ? $students[0]->total_year : '' }}"
                    name="total_year" class="attendanceYear col-12 best-shadow form-control h45px">
            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <table id="example2" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Firstname</th>
                            <th>Fathername</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Sick</th>
                            <th>Leave</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($students) --}}
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $student->image) }}"
                                        class="img-circle best-shadow w-40">
                                </td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>
                                    {{-- @dump($student) --}}
                                    <input type="hidden" name="classs_id" value="{{ $student->classs_id }}">
                                    <input type="hidden" name="exam_type"
                                        value="{{ request('exam_type') }}">
                                    <input type="hidden" name="year" value="{{ request('year') }}">

                                    <input type="number" name="attendances[{{ $student->student_id }}][present]"
                                        class="attendanceInput best-shadow" value="{{ $student->present }}">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->student_id }}][absent]"
                                        class="attendanceInput best-shadow" value="{{ $student->absent }}">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->student_id }}][sick]"
                                        class="attendanceInput best-shadow" value="{{ $student->sick }}">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->student_id }}][leave]"
                                        class="attendanceInput best-shadow" value="{{ $student->leave }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('classes.index') }}" class="btn btn-primary best-shadow">Back</a>
                    <button type="submit" class="btn btn-primary best-shadow">Submit</button>
                </div>
            </div>
        </div>
    </form>






</x-newLayout>
