@props(['method','classs'])
<div class="modal fade" id="modal-default{{ isset($method) ? 'Update' : '' }}">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ isset($method) ? 'Update' : 'Create' }} Subject</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form action="{{ isset($method) ? "" : route('subjects.store') }}"
                    method="POST">
                    @if (isset($method))
                        @method('PUT')
                    @endif
                    @csrf
                    {{-- SUBJECT NAME --}}
                    <div class="form-group col-12">
                        <input type="hidden" name="classs" value="{{$classs}}">
                        <label for="name">Subject Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="{{isset($method) ? 'subjectName' : ''}}" class="form-control" placeholder="Dari">
                    </div>

                    <div class="modal-footer">
                        <div class="student-submit text-left">
                            <button type="submit"
                                class="btn btn-primary">{{ isset($method) ? 'Update' : 'Create' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>












