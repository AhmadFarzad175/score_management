<x-newLayout header="All Classes">
    <div class="col-12 my-3 text-right">
        <button type="button" class="btn btn-primary createBtn" data-toggle="modal" data-target="#modal-default">
            Create
        </button>

        <!-- /.modal -->
        <x-subjectForm :classs="$subjects[0]->classs"/>
        <!-- /.modal -->
    </div>



    {{-- @dd($subjects[0]->classs) --}}

    <!-- /.card -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-hover text-left">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->classs }}</td>
                            <td class="text-right py-0 align-middle">
                                {{-- EDIT BTTON --}}
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-subject-id="{{ $subject->id }}" data-toggle="modal" data-target="#modal-defaultUpdate">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>

                                    {{-- DELETE BUTTON --}}
                                    <form action="{{ route('subjects.destroy', ['subject' => $subject->id]) }}"
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

            </table>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('attendances.index') }}" class="btn btn-info">Back</a>
                <a href="{{ route('scores.index') }}" class="btn btn-info">Next</a>
            </div>        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>

<!-- /.modal -->
<x-subjectForm classs="$subjects[0]->classs" method="Update"/>
<!-- /.modal -->


<script>
    $(function() {
        $("#example2").DataTable({
            paging: false,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
        });
    });
</script>



{{-- FETCHING DATA FOR UPDATING MODAL --}}
<script>
    // Function to fetch and populate class data
    function populateSubjectData(subjectId) {
        // Fetch class data from the server
        fetch(`/subjects/${subjectId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(subjectData => {
                // Populate form fields with the received class data
                document.getElementById('subjectName').value = subjectData.name;
                document.querySelector('#modal-defaultUpdate form').action = `/subjects/${subjectData.id}`;

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
            // If the clicked element has the class 'editBtn'
            const subjectId = element.dataset.subjectId; // Get the student ID from the data attribute
            populateSubjectData(subjectId); // Fetch and populate student data
        }
    });
</script>
