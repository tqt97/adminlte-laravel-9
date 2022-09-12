<li class="w-full relative">
    <span class="{{ count($child_category->categories) ? 'branch' : 'Leaf' }} w-full">
        <i class="fas {{ count($child_category->categories) ? 'fa-folder' : 'fa-file' }}"></i>
        {{ $child_category->name }}
        <div class="float-right">
            {{ $category->created_at->diffForHumans() }}
            <i class="fa {{ $child_category->getFeature() }} pl-3"></i>
            <i class="fa {{ $child_category->getPublish() }} pl-3"></i>
            <a href="{{ route('admin.blogs.categories.edit', $child_category) }}" class="pl-3">
                <i class="fa fa-edit"></i>
            </a>
            <form id="delete-item-{{ $child_category->id }}"
                action="{{ route('admin.blogs.categories.destroy', $child_category) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            <a class="pl-3" href="{{ route('admin.blogs.categories.destroy', $child_category) }}"
                onclick="event.preventDefault();
                if(confirm('Do you want to delete this item {{ $child_category->id }}?')){
                document.getElementById('delete-item-{{ $child_category->id }}').submit();}">
                <i class="fa fa-trash-alt text-red"></i>
            </a>
        </div>
    </span>
    @if ($child_category->categories)
        <ul class="tree">
            @foreach ($child_category->categories as $childCategory)
                @include('admin.pages.category.child_category', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endif
</li>
