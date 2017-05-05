@foreach ($grid_data as $grid_row)
    <tr>
        <td>{{ $grid_row->name }}</td>
        <td>{{ $grid_row->model }}</td>
        <td>{{ $grid_row->dia }}</td>
        <td>{{ $grid_row->width }}</td>
        <td>{{ $grid_row->section }}</td>
        <td>{{ $grid_row->retail_price }}</td>
    </tr>
@endforeach
<tr><td colspan="6">{{ $grid_data->links() }}</td></tr>
