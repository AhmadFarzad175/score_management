<x-newLayout header="Create Attendance">
    {{-- @dd($subjects) --}}
    <!-- /.card -->
    <form action="{{ route('scores.store') }}" method="POST">
        @csrf
        {{-- <div class="card d-flex flex-row text-right p-4">
            <div>
                <b>Year </b><input type="number" name="year" class="attendanceInput best-shadow"><br><br>
            </div>
            <div>
                <b>Total Educational Year </b><input type="number" name="total_year" class="attendanceInput best-shadow">
            </div>
        </div><br> --}}
        <div class="card">
            <!-- /.card-header -->

            <div class="card-body overflow-auto">
                <table id="example2" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Firstname</th>
                            <th>Fathername</th>
                            @foreach ($subjects as $subject)
                                <th>{{ $subject->name }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($student) --}}
                        @foreach ($students as $student)
                            <tr style="overflow: auto">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                @foreach ($subjects as $subject)
                                    <td>
                                        <input type="number" name="{{ $student->id }}[{{ $subject->id }}]"
                                            class="scoreInput best-shadow"
                                            value="{{ old($student->id . '.' . $subject->id) }}">
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('scores.index') }}" class="btn btn-info">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
            <!-- /.card-body -->
    </form>
    </div>
</x-newLayout>
