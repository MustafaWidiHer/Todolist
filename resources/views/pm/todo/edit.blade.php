@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header"> Edit To Do </div>
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" action=" {{ route('todos.update', $job->id) }} " method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="project" class="col-md-4 control-label">Project</label>

                            <div class="col-md-6">
                                <select class="form-control" name="project" required>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}"
                                        {{$project->id == $job->project_id ? 'selected' : '' }}>
                                        {{$project->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="programmer" class="col-md-4 control-label">Programmer</label>
                            <div class="col-md-6">
                                <select class="form-control" name="programmer">
                                    <option value="0">NOT SELECTED</option>
                                    @forelse($programmers as $programmer)
                                    <option value="{{$programmer->id}}"
                                        {{$programmer->id==auth()->user()->id?'selected':''}}>
                                        {{$programmer->name}}
                                    </option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new-todo" class="col-md-4 control-label">Todo</label>
                            <div class="col-md-6">
                                <input id="new-todo" type="text" class="form-control" name="todo" value="{{$job->name}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dateline" class="col-md-4 control-label">Deadline</label>
                            <div class="col-md-6">
                                <div class='input-group date' id='datePicker'>
                                    <input type='text' class="form-control" name="dateline" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    // var tanggal = new Date({!! json_encode($job->dateline, JSON_HEX_TAG) !!});

    // if(tanggal < today){
    //     today = tanggal;
    // }

    var optComponent = {
        startDate: today,
        format: 'dd/mm/yyyy',
        container: '#datePicker',
        orientation: 'auto top',
        todayHighlight: true,
        autoclose: true
    };

    // COMPONENT
    $( '#datePicker' ).datepicker( optComponent );
    $( '#datePicker' ).datepicker( 'setDate', '{{ $job->dateline }}' );
</script>
@endpush
