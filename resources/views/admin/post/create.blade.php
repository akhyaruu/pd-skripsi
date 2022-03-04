@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Create</h3>
                {!! Form::open(['route' => ['post.store'], 'method' => 'post']) !!}
                    @include('component.input',['input'=> Form::text('title',null,['class' => 'form-control']),'label'=> Form::label('title', 'title')])
                    @include('component.input',['input'=> Form::textarea('content',null,['class' => 'form-control']),'label'=> Form::label('content', 'content')])
                    @include('component.input',['input'=> Form::integer('user_id',null,['class' => 'form-control']),'label'=> Form::label('user_id', 'user_id')])
                <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-success mx-1 text-white" title="Create"><i class="fas fa-plus"></i> Create</button>
 {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection