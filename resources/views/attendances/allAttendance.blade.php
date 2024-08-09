<x-newLayout page="3">
    {{-- @dd($students) --}}
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px;  direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
        <div class="align-self-end">
            <h4>@lang('message.Class Attendance')</h4>
        </div>
        <a href="{{ route('attendances.create') }}" type="button" class="btn btn-primary createBtn">
            <i class="fas fa-plus"></i>
            @lang('message.Create')
        </a>
    </div>
    <x-attendance-header page="attendances" />


    <!-- /.card -->
    @if (isset($students[0]))
        <div class="input-group col-6 col-sm-4 col-lg-2 mb-3">
            <button type="button" class="btn btn-primary best-shadow">@lang('message.Total Year')</button>
            <div class="attendanceDisabled col-12 best-shadow form-control">
                {{ $students[0]->total_year }}
            </div>
        </div>
    @endif
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="overflow: auto">
            <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('message.First name')</th>
                        <th>@lang('message.Father name')</th>
                        <th>@lang('message.Present')</th>
                        <th>@lang('message.Absent')</th>
                        <th>@lang('message.Sick')</th>
                        <th>@lang('message.Leave')</th>
                        <th>@lang('message.Status')</th>
                        <th class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}}">@lang('message.Action')</th>
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
                                    class="badge badge-{{ $student->status ? 'danger' : 'success' }}">{{ $student->status ?? 'شامل' }}</span>
                            </td>
                            <td class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}} py-0 align-middle">
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

            <div class="mt-3 d-flex justify-content-between" style="direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
                <a href="{{ route('students.index') }}" class="btn btn-primary">@lang('message.Back')</a>
                <a href="{{ route('subjects.index') }}" class="btn btn-primary next-btn" style="{{session('locale') != 'en' ? 'left:20px' : 'right:20px'}}">@lang('message.Next')</a>
            </div>

        </div>
        <!-- /.card-body -->
    </div>

    <x-attendance-form />
</x-newLayout>
<script>
    $(function() {
        $("#example2").DataTable({
            paging: false,
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
                // Populate form fields with the received class data
                document.getElementById('first_name').value = attendanceData.student.first_name;
                document.getElementById('present').value = attendanceData.present;
                document.getElementById('absent').value = attendanceData.absent;
                document.getElementById('sick').value = attendanceData.sick;
                document.getElementById('leave').value = attendanceData.leave;

                // Call validateAttendanceSum initially to check the current state
                validateAttendanceSum();
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
            document.querySelector('.updateBtn').action = "attendances/" + attendanceId;

            populateClassData(attendanceId);

            // Add event listeners after populating data
            setTimeout(() => {
                const attendanceFields = document.querySelectorAll('.attendance-field');
                attendanceFields.forEach(field => {
                    field.addEventListener('input', validateAttendanceSum);
                });
            }, 1000);  // Adjust the delay if necessary
        }
    });

    // Function to validate attendance sum
    function validateAttendanceSum() {
        const totalYear = {{ isset($students[0]) ? $students[0]->total_year : '' }};
        const updateBtn = document.querySelector('.update-btn');

        let present = parseInt(document.getElementById('present').value) || 0;
        let absent = parseInt(document.getElementById('absent').value) || 0;
        let sick = parseInt(document.getElementById('sick').value) || 0;
        let leave = parseInt(document.getElementById('leave').value) || 0;

        let sum = present + absent + sick + leave;

        if (sum === totalYear) {
            updateBtn.disabled = false;
        } else {
            updateBtn.disabled = true;
        }
    }
</script>

