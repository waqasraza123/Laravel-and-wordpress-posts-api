@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Post Form</div>

                <div class="panel-body">
                    
                    {!! Form::open(['route' => 'posts.store']) !!}
                    
                    <div class="form-group">
                        
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', '', ['class' => 'form-control']) !!}
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('image', 'Image') !!}
                      {!! Form::file('image'); !!}
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('content', 'Content') !!}
                      {!! Form::text('content', '', ['class' => 'form-control']) !!}
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('category', 'Category') !!}
                      {!! Form::select('category', array('TRY-BUILD' => 'TRY-BUILD','TRY-CORP'=>'TRY-CORP','TRY-CS' => 'TRY-CS','TRY-LEARN' => 'TRY-LEARN','TRY-MENTORING' => 'TRY-MENTORING', 'TRY-PM' => 'TRY-PM'), 'TRY-BUILD', ['class'=>'form-control', 'id'=>'inputItemStatus']) !!}    
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('status', 'Status') !!}
                      {!! Form::select('status', array('Publish' => 'Publish','Draft'=>'Draft'), 'Publish', ['class'=>'form-control', 'id'=>'status']) !!}    
                      
                        
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('tags', 'Tags') !!}
                      {!! Form::text('name', '', ['class' => 'form-control']) !!}
                        
                    </div>
                    

                    <button class="btn btn-success" type="submit">Submit!</button>
                    
                    
                    {!! Form::close() !!}
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
