<tr data-index="{{ $index }}">
    <td>{!! Form::text('vendor_contacts['.$index.'][contact_name]', old('vendor_contacts['.$index.'][contact_name]', isset($field) ? $field->contact_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('vendor_contacts['.$index.'][phone_number]', old('vendor_contacts['.$index.'][phone_number]', isset($field) ? $field->phone_number: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('vendor_contacts['.$index.'][email]', old('vendor_contacts['.$index.'][email]', isset($field) ? $field->email: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>