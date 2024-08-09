<!-- TO SHOW THE UPDATE MODAL -->
@props(['totalYear'])
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.Update Attendance')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="" method="POST" style="display: flex; flex-wrap: wrap;" class="updateBtn">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-wrap">
                        <div class="form-group col-md-6">
                            <!-- FIRSTNAME -->
                            <div class="name mb-3">
                                <label for="first_name">@lang('message.Student') <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control" disabled
                                    placeholder="12B1">
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="present">@lang('message.Present') <span class="text-danger">*</span></label>
                            <input name="present" type="text" id="present" class="form-control attendance-field">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="absent">@lang('message.Absent') <span class="text-danger">*</span></label>
                            <input name="absent" type="text" id="absent" class="form-control attendance-field">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="sick">@lang('message.Sick') <span class="text-danger">*</span></label>
                            <input name="sick" type="text" id="sick" class="form-control attendance-field">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="leave">@lang('message.Leave') <span class="text-danger">*</span></label>
                            <input name="leave" type="text" id="leave" class="form-control attendance-field">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="student-submit text-left">
                            <button type="submit" class="btn btn-primary update-btn" disabled>@lang('message.Update')</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

