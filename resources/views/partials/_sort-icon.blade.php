@if ($sortColumn !== $field)
<i></i>
@elseif ($sortDirection == 'asc')
<i style="color:rgb(85, 85, 85)" class="fa fa-sort-up"></i>
@else
<i style="color:rgb(85, 85, 85)" class="fa fa-sort-down"></i>
@endif
