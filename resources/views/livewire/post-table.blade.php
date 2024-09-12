<div>
    <table class="table table-bordered">
        <input type="search" wire:model.live="search" placeholder="Search...">
        <br>
        <br>
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Category</th>
                <th scope="col" style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-center">
                    <img src="{{ asset('/storage/posts/'.$post->image) }}" class="rounded" style="width: 150px">
                </td>
                <td>{{ $post->title }}</td>
                <td>{!! $post->content !!}</td>
                <td>{!! $post->kategori->name !!}</td>
                <td class="text-center">
                    <button wire:click="$dispatch('postEdit', {post: {{ $post->id }}})" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-sm btn-warning">Update</button>
                    <button @click="$dispatch('delete-alert', {get_id: '{{ $post->id }}' })" class="btn btn-sm btn-danger">DELETE</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    <div class="alert alert-danger">
                        Post Not Found
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div>{{ $posts->links() }}</div>
    <x-delete-alert />
</div>


{{-- <div>
    <table class="table table-bordered">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col" style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td class="text-center">
                    <img src="{{ asset('/storage/posts/'.$post->image) }}" class="rounded" style="width: 150px">
                </td>
                <td>{{ $post->title }}</td>
                <td>{!! $post->content !!}</td>
                <td class="text-center">
                    <a href="/edit/{{ $post->id }}" wire:navigate class="btn btn-sm btn-primary">EDIT</a>
                    <button wire:click="destroy({{ $post->id }})" class="btn btn-sm btn-danger">DELETE</button>
                </td>
            </tr>
            @empty
            <div class="alert alert-danger">
                Data Post belum Tersedia.
            </div>
            @endforelse
        </tbody>
    </table>
    {{ $posts->links('vendor.pagination.bootstrap-5') }}
</div> --}}