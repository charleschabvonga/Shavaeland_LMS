<tr data-index="{{ $index }}">
    <td>{!! Form::text('emergency_contacts['.$index.'][name]', old('emergency_contacts['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('emergency_contacts['.$index.'][phone1]', old('emergency_contacts['.$index.'][phone1]', isset($field) ? $field->phone1: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('emergency_contacts['.$index.'][phone]', old('emergency_contacts['.$index.'][phone]', isset($field) ? $field->phone: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>