{!! Form::advancedSearch(\App\Question::class, ['method' => 'GET', 'route' => ['admin.app.questions.index'], 'data-datatable-search'=>'questions-data-table']) !!}
<div class="row">
    <div class="col-md-4">
        {!! Form::textCell('name') !!}
    </div>
    <div class="col-md-4">
        {!! Form::selectCell('line_id', \Illuminate\Support\Facades\Auth::user()->lines, ['placeholder' => '---']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::selectCell('group_id', \App\QuestionGroup::userQuestionGroups()->pluck('name', 'id'), ['placeholder' => '---']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! Form::selectCell('state', \App\Question::states, ['placeholder' => '---']) !!}
    </div>
    <div class='col-md-4 mt-4'>
        {!! Form::button(icon('search').' '.trans('cms::cms.search'), ['class' => 'btn btn-success btn-search', 'type'=>'submit'], false) !!}
    </div>
</div>
{!! Form::close() !!}
