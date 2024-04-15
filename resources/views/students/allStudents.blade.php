{{-- <div class="text-right mb-3">
    <a href="{{ route('students.create') }}" class="btn btn-light" style=""><i class="mt-2 fas fa-plus"></i>
        Add</a>
</div> --}}
<x-layout :header="'All Students'">
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
                            <img src="{{ asset('storage/' . $student->image) }}" class="img-circle best-shadow w-40">

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
                                    title="Edit"><i class="mt-2 fa fa-thermometer" style="font-size: 16px"></i></a>
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
    <!-- /.card-body -->
</x-layout>
<script>
    $(function() {
        $("#example2").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
        });
    });
</script>


