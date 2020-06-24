<tr data-index="{{ $index }}">
    <td>{!! Form::text('received_items['.$index.'][item]', old('received_items['.$index.'][item]', isset($field) ? $field->item: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('received_items['.$index.'][qty]', old('received_items['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('received_items['.$index.'][area]', old('received_items['.$index.'][area]', isset($field) ? $field->area: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>