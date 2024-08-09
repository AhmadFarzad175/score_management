{{-- TO SHOW THE UPADTE MODAL --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.Update Score')</h4>
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

                    </div>

                    <div class="modal-footer ">
                        <div class="student-submit text-left">
                            <button type="submit" class="btn btn-primary">@lang('message.Update')</button>
                        </div>
                    </div>


                    {{-- </form> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
