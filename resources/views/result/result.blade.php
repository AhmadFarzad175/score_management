<x-newLayout page="6">
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px;  direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
        <h4>@lang('message.Result')</h4>
        <div>
            <button type="button" class="btn btn-primary createBtn" data-toggle="modal"
                data-target="#modal-default-promote">
                @lang('message.Promote')
            </button>

            <a href="{{ '/parcha?classs_id=' . request('classs_id') . '&exam_type=' . request('exam_type') . '&year=' . request('year')}}" type="button"
                class="btn btn-primary createBtn">
                @lang('message.Result Sheet')
            </a>

            <a href="{{ '/jadwal?classs_id=' . request('classs_id') . '&exam_type=' . request('exam_type') . '&year=' . request('year')}}" type="button"
                class="btn btn-primary createBtn">
                @lang('message.Jadwal')
            </a>


        </div>
    </div>
    <x-student-search menu="results" />
    <x-promote />




    <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="overflow:auto">
            <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('message.Image')</th>
                        <th>@lang('message.Firstname')</th>
                        <th>@lang('message.Fathername')</th>
                        <th>@lang('message.Marks" Sum')</th>
                        <th>@lang('message.Marks" average')</th>
                        <th>@lang('message.Grade')</th>
                        <th>@lang('message.Result')</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                    {{-- @dump($student) --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $student->image) }}"
                                    class="img-circle best-shadow w-40">
                            </td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ $student->total_marks }}</td>
                            <td>{{ $student->average_marks}}</td>
                            <td>{{ $student->grade}}</td>
                            @if ($student->status == null)
                                <td
                                    class="badge badge-{{ $student->result == 'ارتقا صنف' || $student->result == 'موفق' ? 'success' : 'danger' }} mt-3">
                                    <span
                                        class="badge badge-warning">{{ $student->marks_under_16 > 0 ? $student->marks_under_16 : '' }}</span>
                                    {{ $student->result }}
                                </td>
                            @else
                                <td class="badge badge-warning mt-3">{{ $student->status }}</td>
                            @endif


                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <a href="scores" class="btn btn-primary">Back</a>

            </div>
        </div>
        <!-- /.card-body -->
    </div>



</x-newLayout>


<script>
    $(function() {
        $("#example2").DataTable({
            paging: false,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: false,
            autoWidth: true,
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 10; // Adjust as necessary
        const endYear = currentYear + 10; // Adjust as necessary
        let select = document.getElementById('year-picker-promote');

        // Assuming this value is set by your server-side logic
        let selectedYear = "{{ request('year') }}";

        for (let year = startYear; year <= endYear; year++) {
            let isSelected = year == selectedYear ? 'selected' : '';
            select.innerHTML += `<option ${isSelected} value="${year}">${year}</option>`;
        }

        // Select the current year by default if no year is selected
        if (!selectedYear) {
            select.value = currentYear;
        }
    });
</script>
