<x-newLayout page="2">

    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px;  direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
        <div class="align-self-end">
            <h4>@lang('message.Students')</h4>
        </div>
        <button type="button" class="btn btn-primary createBtn" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus"></i>
            @lang('message.Create')
        </button>
    </div>
    <x-student-search menu="students" />




    <!-- /.modal -->

    <x-student-update-form />
    <x-student-form />
    <!-- /.modal -->
    <!-- /.card -->
    <div class="card">
        <!-- /.card-header -->

        <div class="card-body" style="overflow: auto">
            <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('message.Image')</th>
                        <th>@lang('message.Firstname')</th>
                        <th>@lang('message.Lastname')</th>
                        <th>@lang('message.Fathername')</th>
                        <th>@lang('message.Age')</th>
                        {{-- class in the top --}}
                        <th>@lang('message.Main Residence')</th>
                        <th class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}}">@lang('message.Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $student->image ? asset('storage/' . $student->image) : public_path('imge/default_image.jpeg') }}"
                                    class="img-circle best-shadow w-40">

                            </td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->dob)->age }}</td>
                            <td>{{ $student->mainResidence->name }}</td>
                            <td class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}} py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button class="editBtn best-shadow btn btn-outline-success border-transparent"
                                        title="Edit" data-student-id="{{ $student->id }}" data-toggle="modal"
                                        data-target="#modal-lg-update">
                                        <i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i>
                                    </button>


                                    <form action="students/{{ $student->id . '?year=' . request('year') }}"
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
            <div class="mt-3 d-flex justify-content-between" style="direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
                <a href="{{ route('classes.index') }}" class="btn btn-primary">@lang('message.Back')</a>
                <a href="{{ route('attendances.create') }}" class="btn btn-primary next-btn" style="{{session('locale') != 'en' ? 'left:20px' : 'right:20px'}}">@lang('message.Next')</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-newLayout>


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

{{-- IMAGE SELECT IMPLEMENTATION --}}
<script src="{{ asset('dist/js/myjs.js') }}"></script>








{{-- FETCHING DATA FOR UPDATING MODAL --}}
<script>
    // Function to fetch and populate student data
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
                // Set the image src
                let imagePath = studentData.image ? `/storage/${studentData.image}` :
                    '{{ asset('imge/default_image.jpeg') }}';
                document.getElementById('headImageUpdate').src = imagePath;

                // Populate form fields with the received student data
                document.getElementById('firstname').value = studentData.first_name;
                document.getElementById('firstname_en').value = studentData.first_name_en;
                document.getElementById('lastname').value = studentData.last_name;
                document.getElementById('lastname_en').value = studentData.last_name_en;
                document.getElementById('fathername').value = studentData.father_name;
                document.getElementById('fathername_en').value = studentData.father_name_en;
                document.getElementById('grand_father').value = studentData.grand_father;
                document.getElementById('dob').value = studentData.dob;
                document.getElementById('base').value = studentData.base_number;
                document.getElementById('tazkira').value = studentData.tazkira_number;

                // Get all select elements
                const classSelect = document.getElementById('class');
                const mainSelect = document.getElementById('main');

                // Function to set the selected option
                function setSelectedOption(selectElement, value) {
                    for (let i = 0; i < selectElement.options.length; i++) {
                        if (selectElement.options[i].value == value) {
                            selectElement.options[i].selected = true;
                            break;
                        }
                    }
                }

                // Set the selected options
                setSelectedOption(classSelect, studentData.classs_id);
                setSelectedOption(mainSelect, studentData.main_residence);

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error if necessary
            });
    }


    // Function to handle the click event for all edit buttons
    document.addEventListener('click', function(event) {
        let element = event.target.closest('.editBtn')
        // If the clicked element has the class 'editBtn'
        if (element) {
            const studentId = element.dataset.studentId; // Get the student ID from the data attribute
            document.getElementById('udpateForm').action = "students/" + studentId;

            populateStudentData(studentId); // Fetch and populate student data
            get_year('update');

        }

    });












    //  show the year in create select tag 
    document.querySelector('.createBtn').addEventListener('click', function() {
        get_year('create');
    });

    function get_year(type) {
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 10;
        const endYear = currentYear + 10;
        let select = document.getElementById(`year-picker-${type}`);

        // Assuming this value is set by your server-side logic
        let selectedYear = "{{ request('year') }}";

        let options = '';
        for (let year = startYear; year <= endYear; year++) {
            let isSelected = year == selectedYear ? 'selected' : '';
            options += `<option ${isSelected} value="${year}">${year}</option>`;
        }
        select.innerHTML = options;
        // console.log(select);

        // Select the current year by default if no year is selected
        if (!selectedYear) {
            select.value = currentYear;
        }
    }
</script>
