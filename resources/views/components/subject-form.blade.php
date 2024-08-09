<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.Update Subject')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form action="" method="POST" id="updateBtn">
                    @method('PUT')
                    @csrf
                    {{-- SUBJECT NAME --}}
                    <div class="form-group">
                        <input type="hidden" name="classs_id">
                        <label for="name">@lang('message.Subject') <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <div class="student-submit text-left">
                            <button type="submit"
                                class="btn btn-primary">@lang('message.Update')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
