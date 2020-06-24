<tr data-index="{{ $index }}">
<td>{!! Form::text('job_card_items['.$index.'][part]', old('job_card_items['.$index.'][part]', isset($field) ? $field->part: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('job_card_items['.$index.'][price]', old('job_card_items['.$index.'][price]', isset($field) ? $field->price: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('job_card_items['.$index.'][qty]', old('job_card_items['.$index.'][qty]', isset($field) ? $field->qty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('job_card_items['.$index.'][total]', old('job_card_items['.$index.'][total]', isset($field) ? $field->total: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>