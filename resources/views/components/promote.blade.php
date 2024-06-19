@props(['classes'])
<div class="modal fade" id="modal-default-promote">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <label for="from">From Class <span class="text-danger">*</span></label>
                            <input type="text" name="from" id="from" class="form-control" >
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="base">Year <span class="text-danger">*</span></label>
                            <select class="form-control" name="year" id="year-picker-promote">
                            </select>
                        </div>

                        {{-- Negaran --}}
                        <div class="negaran col-md-12">
                            <label for="negaran">Negaran Name <span class="text-danger">*</span></label>
                            <input type="text" name="negaran" id="negaran" class="form-control">
                        </div>
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
