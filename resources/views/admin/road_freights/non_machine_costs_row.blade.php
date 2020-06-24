<tr data-index="{{ $index }}">
    <td>{!! Form::text('non_machine_costs['.$index.'][item_description]', old('non_machine_costs['.$index.'][item_description]', isset($field) ? $field->item_description: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('non_machine_costs['.$index.'][qty]', old('non_machine_costs['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('non_machine_costs['.$index.'][cost]', old('non_machine_costs['.$index.'][cost]', isset($field) ? $field->cost: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('non_machine_costs['.$index.'][total]', old('non_machine_costs['.$index.'][total]', isset($field) ? $field->total: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a> 
    </td>
</tr>