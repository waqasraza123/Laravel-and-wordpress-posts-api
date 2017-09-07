@extends('layouts.app')

@section('content')

@if($errors->has())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>                  
          @foreach ($errors->all() as $error)  
          {{ $error }}</br>                      
          @endforeach
      </div>
    @endif  


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
                        
                      {!! Form::label('category', 'Category') !!}
                      {!! Form::select('category', array('TRY-BUILD' => 'TRY-BUILD','TRY-CORP'=>'TRY-CORP','TRY-CS' => 'TRY-CS','TRY-LEARN' => 'TRY-LEARN','TRY-MENTORING' => 'TRY-MENTORING', 'TRY-PM' => 'TRY-PM'), 'TRY-BUILD', ['class'=>'form-control', 'id'=>'inputItemStatus']) !!}    
                        
                    </div>
                    
                    <div class="form-group">
                        
                      {!! Form::label('status', 'Status') !!}
                      {!! Form::select('status', array('Publish' => 'Publish','Draft'=>'Draft'), 'Publish', ['class'=>'form-control', 'id'=>'status']) !!}    
                        
                    </div>
                      
                    <div class="form-group">
                        
                      {!! Form::label('publish_date', 'Publish Date') !!}
                      {!! Form::text('publish_date', '', array('id' => 'datepicker','class' => 'form-control' )) !!}
                        
                    </div>    
                        
                    
                    
                    <div class="form-group">
                        
                      {!! Form::label('tags', 'Tags') !!}
                      {!! Form::text('tags', '', ['class' => 'form-control']) !!}
                        
                    </div>
                    
                    
                    <div class="form-group">
                        
                      {!! Form::label('content', 'Content') !!}
                      {!! Form::textarea('content', '', ['class' => 'form-control']) !!}
                        
                    </div>
                    
                    

                    <button class="btn btn-success btn-lg btn-block" type="submit">Submit!</button>
                    
                    
                    {!! Form::close() !!}
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
