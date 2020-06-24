<tr data-index="{{ $index }}">
    <td>{!! Form::text('beneficiary_details['.$index.'][beneficiary_name]', old('beneficiary_details['.$index.'][beneficiary_name]', isset($field) ? $field->beneficiary_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('beneficiary_details['.$index.'][id_number]', old('beneficiary_details['.$index.'][id_number]', isset($field) ? $field->id_number: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('beneficiary_details['.$index.'][address]', old('beneficiary_details['.$index.'][address]', isset($field) ? $field->address: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('beneficiary_details['.$index.'][phone1]', old('beneficiary_details['.$index.'][phone1]', isset($field) ? $field->phone1: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('beneficiary_details['.$index.'][phone]', old('beneficiary_details['.$index.'][phone]', isset($field) ? $field->phone: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('beneficiary_details['.$index.'][allocation_percentage]', old('beneficiary_details['.$index.'][allocation_percentage]', isset($field) ? $field->allocation_percentage: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>