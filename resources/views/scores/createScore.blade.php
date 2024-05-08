<x-newLayout page="5">
    <!-- /.card -->

    <form action="{{ route('scores.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- /.card-header -->

            <div class="card-body overflow-auto">
                <table id="example2" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Firstname</th>
                            <th>Fathername</th>
                            @foreach ($subjects as $subject)
                                <th>{{ $subject->name }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr style="overflow: auto">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                @foreach ($subjects as $subject)
                                    <td>
                                        <input type="number" name="{{ $student->id }}[{{ $subject->id }}]"
                                            class="scoreInput best-shadow"
                                            value="{{ old($student->id . '.' . $subject->id) }}">
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('attendances.index') }}" class="btn btn-info">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
            <!-- /.card-body -->
    </form>
    </div>
</x-newLayout>
