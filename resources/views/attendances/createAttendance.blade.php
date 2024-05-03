<x-newLayout>
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Create Attendance</h4>
        </div>
    </div>
    <form action="{{route('attendances.create')}}" >
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="form-group">
                    <label for="classs">Class</label>
                    <select class="form-control select2" name="classs_id" id="classs" style="width: 100%;">
                        @foreach($classes as $class)
                            <option {{request('classs_id') == $class->id ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-12 col-sm-4 col-md-3 text-right mb-3 align-self-end">
                <button type="sbmit" class="btn btn-outline-info">
                    <i class="fas fa-search"></i>
                     Search
                </button>
            </div>
        </div>
    </form>


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
                        @foreach ($students as $student)
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
                                    <input type="hidden" name="classs_id" value="{{$student->classs_id}}">
                                    <input type="number" name="attendances[{{ $student->id }}][present]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->id }}][absent]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->id }}][sick]"
                                        class="attendanceInput best-shadow">
                                </td>
                                <td>
                                    <input type="number" name="attendances[{{ $student->id }}][leave]"
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
