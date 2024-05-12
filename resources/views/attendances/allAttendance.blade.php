<x-newLayout page="3">
    {{-- @dd($students) --}}
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
    @if (isset($students[0]))
        <div class="text-right d-flex col-12 text-left" style="width: 100%">
            <div class="col-6 text-left">
                <b>Year</b>
                <div type="number" name="year"
                    class="attendanceDisabled col-12 best-shadow">{{ $students[0]->year }}</div>
            </div>
            <div class="col-6 text-left">
                <b>Total Educational year</b><div type="number"
                    name="total_year" class="attendanceDisabled col-12 best-shadow">{{$students['0']->total_educational_year}}</div>
            </div>
        </div><br>
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
                    @foreach ($students as $student)
                        <tr>
                            {{-- @dd($student->students) --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->father_name }}</td>

                            <td>{{ $student->present }}</td>
                            <td>{{ $student->absent }}</td>
                            <td>{{ $student->sick }}</td>
                            <td>{{ $student->leave }}</td>
                            <td><span
                                    class="badge badge-{{ $student->status ? 'danger' : 'success' }}">{{ $student->status ?? 'Include' }}</span>
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-toggle="modal" data-attendance-id="{{ $student->id }}"
                                        data-target="#modal-default">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>


                                    <form action="{{ route('attendances.destroy', $student->student_id) }}"
                                        method="post">
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
                <a href="{{ route('subjects.index', ['classs_id' => Request('classs_id')]) }}"
                    class="btn btn-info">Next</a>
            </div>

        </div>
        <!-- /.card-body -->
    </div>

    <x-attendance-form />
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

{{-- FETCHING DATA FOR UPDATING MODAL --}}
<script>
    // Function to fetch and populate class data
    function populateClassData(attendanceId) {
        // Fetch class data from the server
        fetch(`/attendances/${attendanceId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(attendanceData => {
                console.log(attendanceData);
                // Populate form fields with the received class data
                document.getElementById('first_name').value = attendanceData.student.first_name;
                document.getElementById('present').value = attendanceData.present;
                document.getElementById('absent').value = attendanceData.absent;
                document.getElementById('sick').value = attendanceData.sick;
                document.getElementById('leave').value = attendanceData.leave;

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error if necessary
            });
    }

    // Function to handle the click event for all edit buttons
    document.addEventListener('click', function(event) {
        let element = event.target.closest('.editBtn');
        if (element) {
            // Get the student ID from the data attribute
            const attendanceId = element.dataset.attendanceId;
            console.log(attendanceId);
            document.querySelector('.updateBtn').action = "attendances/" + attendanceId;

            populateClassData(attendanceId);
        }
    });
</script>
