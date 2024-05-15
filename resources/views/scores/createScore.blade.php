<x-newLayout page="5">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Create Score</h4>
        </div>

    </div>
    <form action="{{ route('scores.create') }}">
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-4 col-md-2">
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
            <div class="col-12 col-sm-4 col-md-2">
                <div class="form-group">
                    <label for="terms">Terms</label>
                    <select class="form-control select2" name="term_id" id="terms" style="width: 100%;">
                        @foreach ($ordinaries as $ordinary)
                            <option value="{{ $loop->iteration }}"
                                {{ request('term_id') == $loop->iteration ? 'selected' : '' }}>{{ $ordinary }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-2">
                <div class="form-group">
                    <label for="subjects">Subjects</label>
                    <select class="form-control select2" name="subject_id" id="subjects" style="width: 100%;">

                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-4 col-md-2">
                <div class="form-group">
                    <label for="exam_type">Exam Type</label>
                    <select class="form-control" name="exam_type" id="exam_type" style="width: 100%;">
                        <option value="0" {{ request('exam_type') == '0' ? 'selected' : '' }}>Midterm Term</option>
                        <option value="1" {{ request('exam_type') == '1' ? 'selected' : '' }}>Final Term</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-4 col-md-3 text-right mb-3 align-self-end">
                <button type="sbmit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                    Search
                </button>
            </div>
        </div>
    </form>


    <form action="{{ route('scores.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- /.card-header -->

            <div class="card-body overflow-auto">
                <table id="example2" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Firstname</th>
                            <th>Fathername</th>
                            <th>Subject</th>
                            <th>Mark</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        @dump($student)
                            <tr style="overflow: auto">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $student->image) }}" class="img-circle best-shadow w-40">
                                </td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                                    <input type="hidden" name="classs_id" value="{{ $student->classs_id }}">
                                    <input type="hidden" name="exam_type" value="{{ request('exam_type') }}">
                                    <input type="number" name="students[{{ $student->id }}][mark]" min="0"
                                        class="scoreInput best-shadow"
                                        {{ request('exam_type') == 1 ? 'max=100' : 'max=40' }}
                                        value="{{ $student->mark }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('attendances.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
            <!-- /.card-body -->
    </form>
    </div>
</x-newLayout>




<script>
    // Function to fetch subjects based on the selected class ID
    function fetchSubjects(termId) {
        // Make an AJAX request to the server to fetch subjects
        // Replace 'subjects-route' with the actual route that returns subjects based on class ID
        fetch('/allSubjects?classs_id=' + termId)
            .then(response => response.json())
            .then(data => {
                // Populate the subjects dropdown with the fetched subjects
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


    // Wait for the DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get the selected class ID when the page loads
        var selectedTermId = document.getElementById('terms').value;

        // Call a function to fetch subjects based on the selected class ID
        fetchSubjects(selectedTermId);
    });


    //onchange event for selected input
    document.getElementById('terms').onchange = function() {
        // Get the selected class ID
        var selectedTermId = this.value;

        // Call the function to fetch subjects based on the selected class ID
        fetchSubjects(selectedTermId);
    };
</script>
