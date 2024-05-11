<x-newLayout page="1">
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Classes</h4>
        </div>
        <button type="button" class="btn btn-success createBtn" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"> </i>
            Create
        </button>

    </div>
    

    <!-- /.modal -->
    <x-class-form method='Update' />
    
    <x-class-form />
    <!-- /.modal -->
    
    <!-- /.card -->
    <div class="card">
        <!-- /.card-header -->

        <div class="card-body">
            <table id="example2" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Year</th>
                        <th>Negaran</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->year }}</td>
                            <td>{{ $class->negaran }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-class-id="{{ $class->id }}" data-toggle="modal"
                                        data-target="#modal-defaultUpdate">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>


                                    <form action="{{ route('classes.destroy', ['class' => $class->id]) }}"
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
                <a href=""></a>
                <a href="{{route('students.index')}}" class="btn btn-primary">Next</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>

{{-- FORM SPECIFIC OPTIONS --}}
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
    function populateClassData(classId) {
        // Fetch class data from the server
        fetch(`/classes/${classId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(classData => {
                // Populate form fields with the received class data
                document.getElementById('name').value = classData.name;
                document.getElementById('year').value = classData.year;
                document.getElementById('negaran').value = classData.negaran;

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
            const classId = element.dataset.classId; 
            document.querySelector('.updateBtn').action = "classes/" + classId;

            populateClassData(classId);
        }
    });
</script>
