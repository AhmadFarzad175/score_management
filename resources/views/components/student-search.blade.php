@props(['menu'])
<form action="{{ $menu }}">
    @csrf
    <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="btn-primary input_radious_left" style="">Class</button>
                    <select class="form-control select2 input_radious_none" name="classs_id" id="classs"
                        style="width: 250px;">
                        @foreach ($classes as $class)
                            <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4 col-md-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="btn-primary input_radious_left ">Year</button>
                    <select class="form-control select2 input_radious_none w-200 " name="year" id="year-picker">
                    </select>
                </div>
            </div>
        </div>
        @if($menu == 'results')
        <div class="col-12 col-sm-4 col-md-3">

            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="btn-primary input_radious_left text-nowrap h45px">Exam Type</button>
                    <select class="form-control w-200 h45px input_radious_none" name="exam_type">
                        <option value="0" {{ request('exam_type') == '0' ? 'selected' : '' }}>Midterm
                            Term</option>
                        <option value="1" {{ request('exam_type') == '1' ? 'selected' : '' }}>Final Term
                        </option>
                    </select>
                </div>
            </div>
        </div>
        @endif

        <div class="col-12 col-sm-4 col-md-3 text-right mb-3 align-self-end">
            <button type="sbmit" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
                Search
            </button>
        </div>
    </div>
</form>
