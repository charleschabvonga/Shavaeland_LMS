<tr data-index="{{ $index }}">
    <td>{!! Form::text('overtime_and_bonus_items['.$index.'][item_description]', old('overtime_and_bonus_items['.$index.'][item_description]', isset($field) ? $field->item_description: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('overtime_and_bonus_items['.$index.'][unit_price]', old('overtime_and_bonus_items['.$index.'][unit_price]', isset($field) ? $field->unit_price: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('overtime_and_bonus_items['.$index.'][qty]', old('overtime_and_bonus_items['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('overtime_and_bonus_items['.$index.'][total]', old('overtime_and_bonus_items['.$index.'][total]', isset($field) ? $field->total: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>