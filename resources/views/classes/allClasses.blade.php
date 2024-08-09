<x-newLayout page="1">
    <div class="d-flex justify-content-between mb-2" style="margin-top: 30px; direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
        <div class="align-self-end">
            <h4>@lang('message.Classes')</h4>
        </div>
        <button type="button" class="btn btn-primary createBtn" data-toggle="modal" data-target="#modal-default">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
                <line x1="256" y1="112" x2="256" y2="400"
                    style="fill:none;stroke:#ffffff;stroke-linecap:square;stroke-linejoin:round;stroke-width:32px" />
                <line x1="400" y1="256" x2="112" y2="256"
                    style="fill:none;stroke:#ffffff;stroke-linecap:square;stroke-linejoin:round;stroke-width:32px" />
            </svg> @lang('message.Create')
        </button>

    </div>


    <!-- /.modal -->
    <x-class-form method='Update' :ordinaries="$ordinaries" />

    <x-class-form :ordinaries="$ordinaries"/>
    <!-- /.modal -->
    <!-- /.card -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="overflow: auto">
            <table id="example2" class="table table-hover" style="direction: {{session('locale') != 'en' ? 'rtl; text-align:right' : 'ltr'}}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('message.Class')</th>
                        <th>@lang('message.Negaran')</th>
                        <th>@lang('message.Term')</th>
                        <th class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}}">@lang('message.Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            {{-- @dd($class->term_id) --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->negaran }}</td>
                            <td>{{ $ordinaries[$class->term_id] }}</td>
                            <td class="{{session('locale') != 'en' ? 'text-left' : 'text-right'}} py-0 align-middle">
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
            <div class="d-flex justify-content-between mt-3" style="direction: {{session('locale') != 'en' ? 'rtl' : 'ltr'}}">
                <a href=""></a>
                <a href="{{ route('students.index') }}" class="btn btn-primary">@lang('message.Next')</a>
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
                document.getElementById('terms').value = classData.term_id;

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
