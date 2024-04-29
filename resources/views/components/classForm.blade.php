@props(['method'])
<div class="modal fade" id="modal-lg{{isset($method) ? 'Update' : ''}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{isset($method) ? 'Update' : 'Add New'}} Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form
                    action="{{ route('classes.store') }}"
                    method="POST" style="display: flex; flex-wrap: wrap;" class="updateBtn">
                    @csrf
                    @if (isset($method))
                        @method('PUT')
                    @endif

                    <div class="form-group col-12">
                        <input type="hidden" name="method">
                        {{-- FIRSTNAME --}}
                        <div class="name mb-3">
                            <label for="name">Class Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="12B1">

                        </div>

                        {{-- LASTNAME --}}
                        <div class="negaran">
                            <label for="negaran">Negaran Name <span class="text-danger">*</span></label>
                            <input type="text" name="negaran" id="negaran" class="form-control"
                                placeholder="Abdul Rahman">

                        </div>
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