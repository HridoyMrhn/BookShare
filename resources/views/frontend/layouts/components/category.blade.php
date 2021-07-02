<div class="list-group mt-3">
   @foreach (category() as $data)
   <a href="{{ route('category', $data->category_slug) }}" class="list-group-item list-group-item-action">{{ $data->category_name }}</a>
   @endforeach
</div>
