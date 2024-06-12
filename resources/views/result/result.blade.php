<x-newLayout page="">
    {{-- @dd($students) --}}
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <h4>Home | students' Score</h4>
        <div>
            <a href="{{'/export?classs_id='. request('classs_id') .'&exam_type=' .request('exam_type')}}" type="button" class="btn btn-primary createBtn">
                <i class="fas fa-plus"></i>
                Excel
            </a>

            <a href="{{ route('scores.create') }}" type="button" class="btn btn-primary createBtn">
                <i class="fas fa-plus"></i>
                Create
            </a>

        </div>
    </div>
    <x-student-search  menu="results"/>




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
                        

                        <td class="text-right">Action</td>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $student['image']) }}"
                                    class="img-circle best-shadow w-40">
                            </td>
                            <td>{{ $student['first_name'] }}</td>
                            <td>{{ $student['father_name'] }}</td>


                        </tr>
                    @endforeach --}}
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <a href="scores" class="btn btn-primary">Back</a>
                
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

                    console.log(container);
                    // Populate the subject marks
                    scoreData.forEach(score => {
                        console.log(score.score_id);
                        container.innerHTML += `
                            <div class="form-group col-md-6">
                                <label>${score.subject_name}</label>
                                <input type="number" class="form-control" name="subjects[${score.score_id}]" value="${score.mark}">
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
