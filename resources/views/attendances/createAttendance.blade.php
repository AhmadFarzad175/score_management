    <x-newLayout page="3">
        {{-- @dd($students) --}}
        <div class="d-flex justify-content-between mb-2" style="margin-top: 30px;direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
            <div class="align-self-end">
                <h4>@lang('message.Create Attendance')</h4>
            </div>
        </div>

        <x-attendance-header page="create" />


        <!-- /.card -->
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div class="input-group col-6 col-sm-4 col-lg-3 col-xl-2 mb-3">
                <button type="button" class="btn btn-primary best-shadow">@lang('message.Total Year')</button>
                <input id="total_year" type="number"
                    value="{{ isset($students[0]->total_year) ? $students[0]->total_year : '' }}" name="total_year"
                    class="attendanceYear best-shadow form-control">
            </div>

            <div class="card">
                <div class="card-body" style="overflow: auto">
                    <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('message.Image')</th>
                                <th>@lang('message.Firstname')</th>
                                <th>@lang('message.Fathername')</th>
                                <th>@lang('message.Present')</th>
                                <th>@lang('message.Absent')</th>
                                <th>@lang('message.Sick')</th>
                                <th>@lang('message.Leave')</th>
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
                                            class="attendanceInput best-shadow attendance-field"
                                            value="{{ $student->present }}">
                                    </td>
                                    <td>
                                        <input type="number" name="attendances[{{ $student->student_id }}][absent]"
                                            class="attendanceInput best-shadow attendance-field"
                                            value="{{ $student->absent }}">
                                    </td>
                                    <td>
                                        <input type="number" name="attendances[{{ $student->student_id }}][sick]"
                                            class="attendanceInput best-shadow attendance-field"
                                            value="{{ $student->sick }}">
                                    </td>
                                    <td>
                                        <input type="number" name="attendances[{{ $student->student_id }}][leave]"
                                            class="attendanceInput best-shadow attendance-field"
                                            value="{{ $student->leave }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                    <div class="mt-3 d-flex justify-content-between" style="direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
                        <a href="{{ route('students.index') }}" class="btn btn-primary">@lang('message.Back')</a>
                        <button type="submit" class="btn btn-primary best-shadow next-btn" style="{{session('locale') != 'en' ? 'left:20px' : 'right:20px'}}">@lang('message.Submit')</button>
                    </div>
                    
                </div>
            </div>
        </form>
    </x-newLayout>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalYearInput = document.getElementById('total_year');
            const attendanceFields = document.querySelectorAll('.attendance-field');

            attendanceFields.forEach(field => {
                field.addEventListener('input', function() {
                    validateAttendanceSum();
                });
            });

            function validateAttendanceSum() {
                const totalYear = parseInt(totalYearInput.value, 10);
                let isValid = true;

                attendanceFields.forEach(field => {
                    const row = field.closest('tr');
                    const present = parseInt(row.querySelector('[name^="attendances"][name$="[present]"]')
                        .value, 10) || 0;
                    const absent = parseInt(row.querySelector('[name^="attendances"][name$="[absent]"]')
                        .value, 10) || 0;
                    const sick = parseInt(row.querySelector('[name^="attendances"][name$="[sick]"]').value,
                        10) || 0;
                    const leave = parseInt(row.querySelector('[name^="attendances"][name$="[leave]"]')
                        .value, 10) || 0;

                    const sum = present + absent + sick + leave;
                    if (sum !== totalYear) {
                        isValid = false;
                        row.classList.add('table-danger');
                    } else {
                        row.classList.remove('table-danger');
                    }
                });

                document.querySelector('.next-btn').disabled = !isValid;
            }
        });
    </script>
