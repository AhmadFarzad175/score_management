<x-newLayout page="2">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Students</h4>
        </div>
        <button type="button" class="btn btn-primary createBtn" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus"></i>
            Create
        </button>
    </div>
    <form action="{{ route('students.index') }}">
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn-primary input_radious_left" style="">Class</button>
                        <select class="form-control select2 input_radious_none" name="classs_id" id="classs"
                            style="width: 250px;">
                            @foreach ($classes as $class)
                                <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                    value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-4 col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn-primary input_radious_left ">Year</button>
                        <select class="form-control select2 input_radious_none w-200 " name="year" id="year-picker">
                        </select>
                    </div>
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




    <!-- /.modal -->

    <x-student-form />
    <x-student-form method='update' />
    <!-- /.modal -->
    <!-- /.card -->
    <div class="card">
        <!-- /.card-header -->

        <div class="card-body">
            <table id="example2" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Fathername</th>
                        <th>Age</th>
                        {{-- class in the top --}}
                        <th>Main Residence</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $student->image) }}"
                                    class="img-circle best-shadow w-40">

                            </td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->dob)->age }}</td>
                            <td>{{ $student->mainResidence->name }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-student-id="{{ $student->id }}" data-toggle="modal"
                                        data-target="#modal-lg">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>


                                    <form action="{{ route('students.destroy', $student->id) }}" method="post">
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
                <a href="{{ route('classes.index') }}" class="btn btn-primary">Back</a>
                <a href="{{ route('attendances.create', ['classs_id' => Request('classs_id')]) }}"
                    class="btn btn-primary">Next</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>


{{-- <script>
    $(function() {
        $("#example2").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
        });
    });
</script> --}}

{{-- IMAGE SELECT IMPLEMENTATION --}}
<script src="{{ asset('dist/js/myjs.js') }}"></script>

{{-- FETCHING DATA TO SHOW IN CLASS AND MAIN_RESIDANCE AND CURRENT_RECIDANCE --}}
{{-- <script>
    document.querySelector('.createBtn').addEventListener('click', function() {
        // Fetch data from getData route
        fetch('/classsProvince')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Populate select options with the received data for classes
                const classSelect = document.querySelector('.classSelect');
                classSelect.innerHTML = ''; // Clear existing options
                data.classes.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    classSelect.appendChild(option);
                });

                // Populate select options with the received data for provinces
                const mainSelect = document.querySelector('.mainSelect');
                mainSelect.innerHTML = ''; // Clear existing options
                data.provinces.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    mainSelect.appendChild(option);
                });

                // Populate select options with the received data for provinces
                const currentSelect = document.querySelector('.currentSelect');
                currentSelect.innerHTML = ''; // Clear existing options
                data.provinces.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    currentSelect.appendChild(option);
                });

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error if necessary
            });
    });
</script> --}}








{{-- FETCHING DATA FOR UPDATING MODAL --}}
<script>
    // Function to fetch and populate student data
    function populateStudentData(studentId) {
        // Fetch student data from the server
        fetch(`/students/${studentId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(studentData => {
                console.log(studentData);
                // Populate form fields with the received student data
                document.getElementById('firstname').value = studentData.first_name;
                document.getElementById('lastname').value = studentData.last_name;
                document.getElementById('fathername').value = studentData.father_name;
                document.getElementById('dob').value = studentData.dob;
                document.getElementById('class').value = studentData.class_id;
                document.getElementById('base').value = studentData.base_number;
                document.getElementById('tazkira').value = studentData.tazkira_number;
                document.getElementById('current').value = studentData.current_residence_id;
                document.getElementById('main').value = studentData.main_residence_id;

                // Set the image src
                let imagePath = studentData.image ? `/storage/${studentData.image}` :
                    '{{ asset('imge/default_image.jpeg') }}';
                document.querySelector('.img-fluid1').src = imagePath;
                console.log(document.querySelector('.img-fluid1').src);
            })

            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error if necessary
            });
    }



    // Function to handle the click event for all edit buttons
    document.addEventListener('click', function(event) {

        if (event.target.classList.contains('editBtn')) {
            // If the clicked element has the class 'editBtn'
            const studentId = event.target.dataset.studentId; // Get the student ID from the data attribute
            populateStudentData(studentId); // Fetch and populate student data
        }
    });
</script>
