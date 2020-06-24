<tr data-index="{{ $index }}">
    <td>{!! Form::text('load_descriptions['.$index.'][description]', old('load_descriptions['.$index.'][description]', isset($field) ? $field->description: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('load_descriptions['.$index.'][qty]', old('load_descriptions['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('load_descriptions['.$index.'][weight_volume]', old('load_descriptions['.$index.'][weight_volume]', isset($field) ? $field->weight_volume: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>