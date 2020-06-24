<tr data-index="{{ $index }}">
    <td>{!! Form::text('identifications['.$index.'][id_type]', old('identifications['.$index.'][id_type]', isset($field) ? $field->id_type: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('identifications['.$index.'][id_number]', old('identifications['.$index.'][id_number]', isset($field) ? $field->id_number: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('identifications['.$index.'][expiry_date]', old('identifications['.$index.'][expiry_date]', isset($field) ? $field->expiry_date: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>