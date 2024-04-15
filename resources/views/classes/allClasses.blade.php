<x-newLayout header="All Classes">
    <div class="col-12 my-3 text-right">
        <button type="button" class="btn btn-primary createBtn" data-toggle="modal" data-target="#modal-lg">
            Create
        </button>
    </div>

    <!-- /.modal -->


    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Class</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <!-- form start -->
                    <form
                        action="{{ isset($method) ? route('classes.update', $students->id) : route('classes.store') }}"
                        method="POST" style="display: flex; flex-wrap: wrap;">
                        @csrf
                        @if (isset($method))
                            @method('PUT')
                        @endif

                        <div class="form-group col-12">
                            <input type="hidden" name="method">
                            {{-- FIRSTNAME --}}
                            <div class="name mb-3">
                                <label for="name">Class Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="12B1">

                            </div>

                            {{-- LASTNAME --}}
                            <div class="negaran">
                                <label for="negaran">Negaran Name <span class="text-danger">*</span></label>
                                <input type="text" name="negaran" id="negaran" class="form-control"
                                    placeholder="Abdul Rahman">

                            </div>
                        </div>


                </div>
                <div class="modal-footer ">
                    <div class="student-submit text-left">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($method) ? 'Update' : 'Create' }}</button>
                    </div>
                </div>

                </form>






            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
                        <th>Negaran</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->negaran }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-class-id="{{ $class->id }}" data-toggle="modal"
                                        data-target="#modal-lg">
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
                <a href="{{route('students.index')}}" class="btn btn-info">Next</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>

{{-- FORM SPECIFIC OPTIONS --}}
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
            // If the clicked element has the class 'editBtn'
            const classId = element.dataset.classId; // Get the student ID from the data attribute
            populateClassData(classId); // Fetch and populate student data
        }
    });
</script>
