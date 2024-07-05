<x-newLayout page="3">
    {{-- @dd($students) --}}
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Create Attendance</h4>
        </div>
    </div>

    <x-attendance-header page="create" />

    <!-- /.card -->
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf

        <div class="input-group col-6 col-sm-4 col-lg-3 col-xl-2 mb-3">
            <button type="button" class="btn btn-primary best-shadow">Total Year</button>
            <input type="number" value="{{ isset($students[0]->total_year) ? $students[0]->total_year : '' }}"
                name="total_year" class="attendanceYear best-shadow form-control">
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
                                    <input type="hidden" name="classs_id" value="{{ $student->classs_id }}">
                                    <input type="hidden" name="exam_type" value="{{ request('exam_type') }}">
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
                    <a href="{{ route('students.index') }}" class="btn btn-primary best-shadow">Back</a>
                    <button type="submit" class="btn btn-primary best-shadow next-btn">Submit</button>
                </div>
            </div>
        </div>
    </form>
</x-newLayout>
