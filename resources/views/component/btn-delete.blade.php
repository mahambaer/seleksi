<form action="{{url($table.'/'.$id)}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger btn-sm remove" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>">Delete</button>
</form>