<tr data-index="{{ $index }}">
    <td>{!! Form::text('road_freight_sub_contractors['.$index.'][subcontractor_number]', old('road_freight_sub_contractors['.$index.'][subcontractor_number]', isset($field) ? $field->subcontractor_number: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('road_freight_sub_contractors['.$index.'][git_cover_number]', old('road_freight_sub_contractors['.$index.'][git_cover_number]', isset($field) ? $field->git_cover_number: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a>
    </td>
</tr>