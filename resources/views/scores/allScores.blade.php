<x-newLayout page="5">
    {{-- @dd($students) --}}
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <h4>Students' Score</h4>
        <div>
            <a href="{{ route('scores.create') }}" type="button" class="btn btn-primary createBtn">
                <i class="fas fa-plus"></i>
                Create
            </a>

        </div>
    </div>
    <x-attendance-header page="scores" />



    <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="overflow: auto">
            <table id="example2" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Firstname</th>
                        <th>Fathername</th>
                        @if (isset($students[0]['subjects']))
                            @foreach ($students[0]['subjects'] as $subject)
                                <th>{{ $subject['subject_name'] }}</th>
                            @endforeach
                        @endif

                        <td class="text-right">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $student['image']) }}"
                                    class="img-circle best-shadow w-40">
                            </td>
                            <td>{{ $student['first_name'] }}</td>
                            <td>{{ $student['father_name'] }}</td>


                            @foreach ($student['subjects'] as $subject)
                                <td><span
                                        class="bg-{{ $subject['mark'] < 16 ? 'danger' : '' }} p-2 round-2">{{ !empty($subject['mark']) ? $subject['mark'] : '-' }}</span>
                                </td>
                            @endforeach


                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-toggle="modal"
                                        data-score-id="{{ isset($subject['score_id']) ? $subject['score_id'] : '' }}"
                                        data-target="#modal-default">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>

                                    {{-- <form action="{{ route('scores.destroy', $student['student_id']) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                        class="btn del best-shadow btn-outline-danger border-transparent"
                                        title="Delete"><i class="fas fa-trash"></i></button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('students.index') }}" class="btn btn-primary">Back</a>
                <a href="results" class="btn btn-primary">Next</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


    <x-score-form />

</x-newLayout>


<script>
    $(function() {
        $("#example2").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: false,
            autoWidth: true,
        });
    });
</script>

{{-- FETCHING DATA FOR UPDATING MODAL --}}
<script>
    // Function to fetch and populate class data
    function populateClassData(scoreId) {
        // Fetch class data from the server
        fetch(`/scores/${scoreId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(scoreData => {
                // Assuming the scoreData is an array of objects
                if (scoreData.length > 0) {
                    const studentData = scoreData[0]; // Taking the first entry to get the student info

                    // Get the container element where the form elements will be appended
                    let container = document.querySelector('.form_div');
                    console.log(scoreData);
                    // Clear the container before adding new content
                    container.innerHTML = '';

                    // Populate the student name
                    container.innerHTML += `
                    <div class="form-group col-md-6">
                        <div class="name mb-3">
                            <label for="first_name">Student <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="${scoreData[0].first_name}" disabled>
                            </div>
                            </div>
                            `;

                    // Populate the subject marks
                    scoreData.forEach(score => {
                        container.innerHTML += `
                            <div class="form-group col-md-6">
                                <label>${score.subject_name}</label>
                                <input type="number" max="${ examType == 1 ? 60 : 40}" class="form-control" name="subjects[${score.score_id}]" value="${score.mark}">
                            </div>
                        `;
                    });
                }
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
            const scoreId = element.dataset.scoreId;
            document.querySelector('.updateBtn').action = "scores/" + scoreId;

            // Populate the modal with score data
            populateClassData(scoreId);

            // Show the modal (assuming you are using Bootstrap)
            $('#modal-default').modal('show');
        }
    });
</script>
