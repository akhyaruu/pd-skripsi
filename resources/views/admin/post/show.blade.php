@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Detail </h3>                
                    @include('component.input',['input'=> Form::text('title',$post->title,['class' => 'form-control']),'label'=> Form::label('title', 'title')])
                    @include('component.input',['input'=> Form::textarea('content',$post->content,['class' => 'form-control']),'label'=> Form::label('content', 'content')])
                    @include('component.input',['input'=> Form::integer('user_id',$post->user_id,['class' => 'form-control']),'label'=> Form::label('user_id', 'user_id')])
               
            </div>
        </div>
    </div>
</div>
@endsection