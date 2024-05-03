<x-newLayout>
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Subjects</h4>
        </div>
        <button type="button" class="btn btn-dark createBtn" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i>
            Create
        </button>

    </div>
    <form action="{{ route('subjects.index') }}">
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-around flex-wrap">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="form-group">
                    <label for="classs">Class</label>
                    <select class="form-control select2" name="classs_id" id="classs" style="width: 100%;">
                        @foreach ($classes as $class)
                            <option {{ $subjects ?? ([0])->classs_id == $class->id ? 'selected' : '' }}
                                value="{{ $class->id }}">{{ $class->name }}</option>
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
    </form>



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
                            <td>{{ $ordinary[$subject->classs_id] }}</td>
                            <td class="text-right py-0 align-middle">
                                {{-- EDIT BTTON --}}
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-subject-id="{{ $subject->id }}" data-toggle="modal"
                                        data-target="#modal-defaultUpdate">
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
            </div>
        </div>
        <!-- /.card-body -->
    </div>

{{-- @dd($subjects) --}}
    <!-- /.modal -->
    <x-subjectForm :classs="Request('classs_id')" />
        <!-- /.modal -->
</x-newLayout>

<!-- /.modal -->
<x-subjectForm :classs="Request('classs_id')" method="Update" />
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
