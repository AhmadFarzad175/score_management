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
                            <a href="{{ route('students.edit', $student->id) }}"
                                class="editBtn best-shadow btn btn-outline-success border-transparent"
                                title="Edit"><i class="mt-2 fa fa-thermometer"
                                    style="font-size: 16px"></i></a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                @csrf
                                <button class="btn del best-shadow btn-outline-danger border-transparent"
                                    title="Delete"><i class="fas fa-trash"></i></button>
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

    </table>
    {{-- <button class="btn btn-danger">next</button> --}}
</div>



@props(['method', 'subject'])
    <!-- /.modal -->
    <div class="modal fade" id="modal-default{{ isset($method) ? 'Update' : '' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ isset($method) ? 'Update' : 'Create' }} Subject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ isset($method) ? route('subjects.update', 1) : route('subjects.store') }}"
                        method="POST">
                        @if (isset($method))
                            @method('PUT')
                        @endif
                        @csrf
                        {{-- SUBJECT NAME --}}
                        <div class="form-group col-12">
                            <label for="Subject">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="Subject" id="Subject" class="form-control" placeholder="Dari"
                                value="{{ isset($method) ? "" : '' }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary">{{ isset($method) ? 'Update' : 'Create' }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
