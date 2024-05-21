{{-- TO SHOW THE UPADTE MODAL --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Attendance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form action="" method="POST" style="display: flex; flex-wrap: wrap;" class="updateBtn">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-wrap form_div">

                        {{-- <div class="form-group col-md-6">
                            <div class="name mb-3">
                                <label for="first_name">student <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control" disabled>

                            </div>
                        </div> --}}

                        {{-- <div class="form-group col-12 col-md-6">
                            <label for="present">Present <span class="text-danger">*</span></label>
                            <input name="present" type="text" id="present" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="absent">Absent <span class="text-danger">*</span></label>
                            <input name="absent" type="text" id="absent" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="sick">Sick <span class="text-danger">*</span></label>
                            <input name="sick" type="text" id="sick" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="leave">Leave <span class="text-danger">*</span></label>
                            <input name="leave" type="text" id="leave" class="form-control">
                        </div> --}}
                    </div>

                    <div class="modal-footer ">
                        <div class="student-submit text-left">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>


                    {{-- </form> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
