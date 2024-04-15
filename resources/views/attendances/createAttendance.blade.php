<x-newLayout header="Create Attendance">
    <!-- /.card -->
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <div class="text-right">
            <b>Year </b><input type="number" name="year" class="attendanceInput best-shadow"><br><br>
            <b>Total Educational Year </b><input type="number" name="total_year" class="attendanceInput best-shadow">
        </div><br>
        <div class="card">
            <!-- /.card-header -->

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
                        @foreach ($classes->students as $student)
                            {{-- @dd($student) --}}
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $student->image) }}"
                                        class="img-circle best-shadow w-40">
                                </td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>
                                    <input type="number" name="classes[{{ $student->id }}][present]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="classes[{{ $student->id }}][absent]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="classes[{{ $student->id }}][sick]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="classes[{{ $student->id }}][leave]"
                                        class="attendanceInput best-shadow">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('classes.index') }}" class="btn btn-info">back</a>
                    <a href=""></a>
                </div>
                <div class="text-right mt-4 ">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </div>
            <!-- /.card-body -->
    </form>
    </div>
</x-newLayout>
