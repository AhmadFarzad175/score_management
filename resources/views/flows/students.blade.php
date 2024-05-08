<x-newLayout page="2">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px">
        <div class="align-self-end">
            <h4>Home | Students</h4>
        </div>
        <button type="button" class="btn btn-dark createBtn" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus"></i> 
            Create
        </button>
    </div>
    <form action="{{route('students.index')}}" >
        @csrf
        <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="form-group">
                    <label for="classs">Class</label>
                    <select class="form-control select2" name="classs_id" id="classs" style="width: 100%;">
                        @foreach($classes as $class)
                            <option {{request('classs_id') == $class->id ? 'selected' : ''}} value="{{$class->id}}">{{$class->name . ' ' . $class->year}}</option>
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




    <!-- /.modal -->

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <!-- form start -->

                    <form
                        action="{{ isset($method) ? route('students.update', $students->id) : route('students.store') }}"
                        enctype="multipart/form-data" method="POST" style="display: flex; flex-wrap: wrap;">
                        @csrf
                        @if (isset($method))
                            @method('PUT')
                        @endif

                        <div class="form-group col-8">
                            {{-- FIRSTNAME --}}
                            <div class="firstname mb-3">
                                <label for="firstname">First name <span class="text-danger">*</span></label>
                                <input value="{{ old('first_name', optional($student ?? null)->first_name) }}"
                                    type="text" name="first_name" id="firstname" class="form-control"
                                    placeholder="Ahmad Farzad">

                            </div>

                            {{-- LASTNAME --}}
                            <div class="lastname">
                                <label for="lastname">Last name <span class="text-danger">*</span></label>
                                <input value="{{ old('last_name', optional($student ?? null)->last_name) }}"
                                    type="text" name="last_name" id="lastname" class="form-control"
                                    placeholder="Hakimi">

                            </div>
                        </div>

                        <div class="d-none d-lg-block col-lg-1">
                        </div>

                        <div class="form-group col-3" style="position: relative">
                            <i class="fas fa-user-edit text-secondary text-sm"></i> 
                            <div class="best-shadow" id="headImageContainer" onclick="showFileInput()">
                                <img id="headImage" class="img-fluid" src="{{ asset('imge/default_image.jpeg') }}"
                                    alt="Default Image">
                            </div>
                            <input type="file" name="image" id="fileInput" style="display: none;"
                                onchange="handleFileSelect()" value="{{ old('image', 'imge/default_image.jpeg') }}">
                        </div>



                        <div class="form-group col-12 col-md-6">
                            <label for="fathername">Father name <span class="text-danger">*</span></label>
                            <input value="{{ old('father_name', optional($student ?? null)->father_name) }}"
                                type="text" name="father_name" id="fathername" class="form-control"
                                placeholder="Abdul Rahman">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <input value="{{ old('dob', optional($student ?? null)->dob) }}" name="dob"
                                type="date" id="dob" class="form-control">
                        </div>




                        <div class="form-group col-12 col-md-6">
                            <label>Class <span class="text-danger">*</span></label>
                            <select name="classs_id" class="form-control classSelect" id="class">
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="base">Base Number <span class="text-danger">*</span></label>
                            <input value="{{ old('base_number', optional($student ?? null)->base_number) }}"
                                name="base_number" type="text" id="base" class="form-control">
                        </div>


                        <div class="form-group col-12 col-md-6">
                            <label for="tazkira">Tazkira Number <span class="text-danger">*</span></label>
                            <input value="{{ old('tazkira', optional($student ?? null)->tazkira_number) }}"
                                name="tazkira_number" type="text" id="tazkira" class="form-control">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="current">Current residence <span class="text-danger">*</span></label>
                            <select name="current_residence" class="form-control currentSelect" id="current">

                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="main">Main residence <span class="text-danger">*</span></label>
                            <select name="main_residence" class="form-control mainSelect" id="main">

                            </select>
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
                <a href="{{ route('classes.index') }}" class="btn btn-info">Back</a>
                <a href="{{ route('attendances.create', ['classs_id' => Request('classs_id')]) }}" class="btn btn-info">Next</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>
<script>
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
</script>

{{-- IMAGE SELECT IMPLEMENTATION --}}
<script src="{{ asset('dist/js/myjs.js') }}"></script>

{{-- FETCHING DATA TO SHOW IN CLASS AND MAIN_RESIDANCE AND CURRENT_RECIDANCE --}}
<script>
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
</script>








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

                // Show the modal after populating data
                $('#modal-lg').modal('show');
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
