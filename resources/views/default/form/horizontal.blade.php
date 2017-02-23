@include('lego::default.snippets.top-buttons', ['widget' => $form])

@include('lego::default.messages', ['object' => $form])
<form method="post" class="form-horizontal" action="{{ $form->getAction() }}">
    @foreach($form->fields() as $field)
        <?php
        /** @var \Lego\Field\Field $field */
        if ($field->errors()->any()) {
            $field->container('class', 'has-error');
        }
        ?>
        <div {!! \Collective\Html\HtmlFacade::attributes($field->containerAttributes()) !!}>
            <label for="{{ $field->elementId() }}" class="col-sm-2 control-label">
                @if($field->isRequired() && $field->isEditable())
                    <span class="text-danger">*</span>
                @endif
                {{ $field->description() }}
            </label>
            <div class="col-sm-10">
                {!! $field !!}
                @if($field->messages()->any())
                    @foreach($field->messages()->all() as $message)
                        <p class="text-info">{!! $message !!}</p>
                    @endforeach
                @endif
                @if($field->errors()->any())
                    @foreach($field->errors()->all() as $error)
                        <p class="text-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            {!! $error !!}
                        </p>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    @if($form->isEditable())
        {{ csrf_field() }}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    @endif
</form>

@include('lego::default.snippets.bottom-buttons', ['widget' => $form])
