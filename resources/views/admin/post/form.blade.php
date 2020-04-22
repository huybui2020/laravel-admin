<div class="form-group {{ $errors->has('post_cateid') ? 'has-error' : ''}}">
    {!! Form::label('post_cateid', 'Danh mục sản phẩm', ['class' => 'required']) !!}
    {!! Form::select('post_cateid', $cates, null, ['placeholder' => '-Danh mục sản phẩm', 'class' => 'col-md-6 form-control', 'required' => 'required']) !!}
    {!! $errors->first('post_cateid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
    {!! Form::label('post_title', 'Post Title', ['class' => 'control-label']) !!}
    {!! Form::text('post_title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_teaser') ? 'has-error' : ''}}">
    {!! Form::label('post_teaser', 'Post Teaser', ['class' => 'control-label']) !!}
    {!! Form::textarea('post_teaser', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_teaser', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
    {!! Form::label('post_content', 'Post Content', ['class' => 'control-label']) !!}
    {!! Form::textarea('post_content', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">
    {!! Form::label('post_image', 'Post Image', ['class' => 'control-label']) !!}
    {!! Form::file('post_image', old('image'), ['class'=>'btn-white form-control', 'placeholder'=>'Enter image Url']) !!}
    {!! $errors->first('post_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_imgdesc') ? 'has-error' : ''}}">
    {!! Form::label('post_imgdesc', 'Post Imgdesc', ['class' => 'control-label']) !!}
    {!! Form::text('post_imgdesc', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_imgdesc', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
