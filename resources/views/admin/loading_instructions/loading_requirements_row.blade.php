<tr data-index="{{ $index }}">
    <td>{!! Form::text('loading_requirements['.$index.'][item_description]', old('loading_requirements['.$index.'][item_description]', isset($field) ? $field->item_description: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('loading_requirements['.$index.'][qty]', old('loading_requirements['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>