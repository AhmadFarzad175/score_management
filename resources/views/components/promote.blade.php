{{-- @props(['classes']) --}}
{{-- @dd($classes) --}}
<div class="modal fade" id="modal-default-promote">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Promote Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classes.store') }}" method="POST" style="display: flex; flex-wrap: wrap;"
                    class="updateBtn">
                    @csrf
                    @if (isset($method))
                        @method('PUT')
                    @endif

                        <div class="form-group col-12 col-md-6">
                            <label>From Class <span class="text-danger">*</span></label>
                            <select name="classs_id" class="form-control classSelect" id="class">
                                @foreach ($classes as $class)
                                    <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="base">Year <span class="text-danger">*</span></label>
                            <select class="form-control" name="year" id="year-picker-promote">
                            </select>
                        </div>

                        <div class="form-group col-12 ">
                            <label>To Class <span class="text-danger">*</span></label>
                            <select name="classs_id" class="form-control classSelect" id="class">
                                @foreach ($classes as $class)
                                    <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>


            </div>
            <div class="modal-footer ">
                <div class="student-submit text-left">
                    <button type="submit" class="btn btn-primary">Promote</button>
                </div>
            </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
