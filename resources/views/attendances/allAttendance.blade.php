<x-newLayout page="3">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Class Attendance</h4>
        </div>
    </div>
    <form action="{{ route('attendances.index') }}">
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="form-group">
                    <label for="classs">Class</label>
                    <select class="form-control select2" name="classs_id" id="classs" style="width: 100%;">
                        @foreach ($classes as $class)
                        <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                            value="{{ $class->id }}">{{ $class->name . ' ' . $class->year }}</option>
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
    </form><br>


    <!-- /.card -->
    @if (isset($attendances[0]))
    {{-- <div class="text-right d-flex col-12 text-left" style="width: 100%">
        <div class="col-6 text-left">
            <b>Year</b><input type="number" value="{{isset($students['0']->year) ? $students['0']->year : ''}}" name="year" class="attendanceYear col-12 best-shadow"><br><br>
        </div>
        <div class="col-6 text-left">
            <b>Total Educational year</b><input type="number" value="{{isset($students['0']->total_educational_year) ? $students['0']->total_educational_year : ''}}" name="total_year"
                class="attendanceYear col-12 best-shadow">
        </div>
    </div> --}}
    @endif
    <div class="card">
        <!-- /.card-header -->

        <div class="card-body">
            <table id="example2" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Fathername</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Sick</th>
                        <th>Leave</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            {{-- @dd($student->attendances) --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->student->first_name }}</td>
                            <td>{{ $attendance->student->father_name }}</td>

                            <td>{{ $attendance->present }}</td>
                            <td>{{ $attendance->absent }}</td>
                            <td>{{ $attendance->sick }}</td>
                            <td>{{ $attendance->leave }}</td>
                            <td><span
                                    class="badge badge-{{ $attendance->student->status ? 'danger' : 'success' }}">{{ $attendance->student->status ?? 'Include' }}</span>
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-toggle="modal" data-target="#modal-lg">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>


                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="btn del best-shadow btn-outline-danger border-transparent"
                                            title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('students.index') }}" class="btn btn-info">Back</a>
                <a href="{{ route('subjects.index', ['classs_id' => Request('classs_id')]) }}" class="btn btn-info">Next</a>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>
<script>
    $(function() {
        $("#example2").DataTable({
            paging: true,
            lengthChange: true,
            searching: false,
            ordering: true,
            info: false,
            autoWidth: true,
        });
    });
</script>




{{-- TO SHOW THE UPADTE MODAL --}}
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Attendance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                {{-- <form action="{{ route('attendances.update', $attendances->id) }}" method="POST"
                    style="display: flex; flex-wrap: wrap;">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-wrap">

                        <div class="form-group col-md-6">
                            {{-- FIRSTNAME --}}
                            {{-- <div class="name mb-3">
                                <label for="name">Class Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="12B1">

                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="present">Present <span class="text-danger">*</span></label>
                            <input name="present" type="text" id="present" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="absent">Absent <span class="text-danger">*</span></label>
                            <input name="absent" type="text" id="absent" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="sick">Sick <span class="text-danger">*</span></label>
                            <input name="sick" type="text" id="sick" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="leave">Leave <span class="text-danger">*</span></label>
                            <input name="leave" type="text" id="leave" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <div class="student-submit text-left">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div> --}}


                {{-- </form> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
