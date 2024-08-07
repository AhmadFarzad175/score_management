{{-- @dd($classes) --}}
<x-newLayout page="5">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px;  direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
        <div class="align-self-end">
            <h4>@lang('message.Create Score')</h4>
        </div>

    </div>
    <form action="{{ route('scores.create') }}">
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-3">
                <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left">@lang('message.Class')</button>
                    <select class="form-control select2 input_radious_none " name="classs_id" id="classs">
                        @foreach ($classes as $class)
                            <option data-term-id="{{ $class->term_id }}"
                                {{ request('classs_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                {{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-group col-12 col-sm-6 col-lg-3 col-xl-2 mb-3">
                <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left">@lang('message.Year')</button>
                    <select class="form-control select2 input_radious_none " name="year" id="year-picker">
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-3">
                <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left">@lang('message.Subjects')</button>
                    <select class="form-control select2 " name="subject_id" id="subjects">
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-3">
                <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left" style="text-wrap:nowrap">@lang('message.Exam Type')</button>
                    <select class="form-control " name="exam_type" id="exam_type">
                        <option value="0" {{ request('exam_type') == '0' ? 'selected' : '' }}>چهارونیم ماه</option>
                        <option value="1" {{ request('exam_type') == '1' ? 'selected' : '' }}>سالانه
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-xl-1 mb-3 text-right align-self-end">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                    @lang('message.Search')
                </button>
            </div>
        </div>
    </form>



    <form action="{{ route('scores.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- /.card-header -->

            <div class="card-body overflow-auto">
                <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('message.Image')</th>
                            <th>@lang('message.Firstname')</th>
                            <th>@lang('message.Fathername')</th>
                            <th>@lang('message.Subject')</th>
                            <th>@lang('message.Mark')</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            {{-- @dump($student) --}}
                            <tr style="overflow: auto">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $student->image) }}"
                                        class="img-circle best-shadow w-40">
                                </td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <input type="hidden" name="year" value="{{ request('year') }}">
                                    <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                                    <input type="hidden" name="classs_id" value="{{ $student->classs_id }}">
                                    <input type="hidden" name="exam_type" value="{{ request('exam_type') }}">
                                    <input type="number" name="students[{{ $student->student_id }}][mark]"
                                        min="0" class="scoreInput best-shadow"
                                        {{ request('exam_type') == 1 ? 'max=60' : 'max=40' }}
                                        value="{{ $student->mark }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
 
                <div class="mt-3 d-flex justify-content-between" style="direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
                    <a href="attendances" class="btn btn-primary">@lang('message.Back')</a>
                    <button type="submit" class="btn btn-primary best-shadow next-btn" style="{{session('locale') != 'en' ? 'left:20px' : 'right:20px'}}">@lang('message.Submit')</button>
                </div>

            </div>
            <!-- /.card-body -->
    </form>
    </div>
</x-newLayout>




<script>
    // Function to fetch subjects based on the selected term ID
    function fetchSubjects(termId) {
        fetch('/allSubjects?classs_id=' + termId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                var subjectsSelect = document.getElementById('subjects');
                subjectsSelect.innerHTML = ''; // Clear previous options

                data.forEach(function(subject) {
                    var isSelected = "{{ request('subject_id') }}" == subject.id ? 'selected' : '';
                    var option = `<option value="${subject.id}" ${isSelected}>${subject.name}</option>`;
                    subjectsSelect.insertAdjacentHTML('beforeend', option);
                });
            })
            .catch(error => console.error('Error fetching subjects:', error));
    }

    // Function to get term ID of the selected class
    function getSelectedTermId() {
        var selectedClass = document.getElementById('classs').selectedOptions[0];
        return selectedClass.getAttribute('data-term-id');
    }

    // Wait for the DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get the selected term ID when the page loads
        var selectedTermId = getSelectedTermId();
        console.log(selectedTermId);

        // Fetch subjects based on the selected term ID
        fetchSubjects(selectedTermId);
    });

    // Onchange event for the class select input
    document.getElementById('classs').onchange = function() {
        // Get the selected term ID
        var selectedTermId = getSelectedTermId();
        console.log(selectedTermId);

        // Fetch subjects based on the selected term ID
        fetchSubjects(selectedTermId);
    };
</script>
