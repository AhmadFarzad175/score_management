@props(['method', 'ordinaries'])
<div class="modal fade" id="modal-default{{ isset($method) ? 'Update' : '' }}">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ isset($method) ? 'Update Class' : 'Add New Class' }}</h4>
                <button type="button" class="close" data-dismiss="modal" style="direction: ltr">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form action="{{ route('classes.store') }}" method="POST" style="display: flex; flex-wrap: wrap;"
                    class="updateBtn">
                    @csrf
                    @if (isset($method))
                        @method('PUT')
                    @endif

                    <div class="form-group" style="display:flex; flex-wrap:wrap">
                        {{-- <input type="hidden" name="method"> --}}
                        {{-- FIRSTNAME --}}
                        <div class="name mb-3 col-md-6">
                            <label for="name">َ@lang('message.Class Name') <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" >
                        </div>

                        {{-- term --}}
                        <div class="mb-3 col-md-6">
                            <label for="terms">@lang('message.Term') <span class="text-danger">*</span></label>
                            <select class="form-control" name="term_id" id="terms">
                                @foreach ($ordinaries as $ordinary)
                                    <option value="{{ $loop->iteration }}"
                                        {{ request('term_id') == $loop->iteration ? 'selected' : '' }}>
                                        {{ $ordinary }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Negaran --}}
                        <div class="negaran col-md-12">
                            <label for="negaran">@lang('message.Negaran Name') <span class="text-danger">*</span></label>
                            <input type="text" name="negaran" id="negaran" class="form-control"
                                >

                        </div>
                    </div>


            </div>
            <div class="modal-footer ">
                <div class="student-submit text-left">
                    <button type="submit" class="btn btn-primary">{{ isset($method) ? 'Update' : 'Create' }}</button>
                </div>
            </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
