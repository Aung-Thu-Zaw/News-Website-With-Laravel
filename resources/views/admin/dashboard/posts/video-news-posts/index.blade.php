<x-dashboard-layout>
    @section("title", "Video News Posts")
    <div class="row">
        <div class="col-12 px-5 pt-5 pb-3">
            <div class="mb-3 d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.video-news-posts.create') }}" class="btn btn-primary">Create
                    <i class="fa-solid fa-plus"></i></a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Video</th>
                        <th scope="col">Title</th>
                        <th scope="col">slug</th>
                        <th scope="col">Visitors</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($videoNewsPosts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>
                            <div class="card text-bg-dark" style="width: 200px;">
                                <img src="http://img.youtube.com/vi/{{ $post->video_id }}/mqdefault.jpg"
                                    class="card-img img-fluid" alt="..."
                                    style="width: 100%; height: 100%; object-fit: cover">
                                <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                    <span class="fs-1" style="cursor: pointer">
                                        <a class="popup-youtube text-white"
                                            href="http://www.youtube.com/watch?v={{ $post->video_id }}">
                                            <i class="fa-regular fa-circle-play"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            {{ $post->slug }}
                        </td>
                        <td>
                            {{ $post->visitors }}
                        </td>
                        <td>
                            {{ $post->author->name }}
                        </td>
                        <td>
                            <div class=" d-flex align-items-center">
                                <form action="{{ route('admin.video-news-posts.edit',$post->slug) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="page" value="{{ $videoNewsPosts->currentPage() }}">
                                    <button type="submit" class="btn btn-info me-3">
                                        Edit
                                    </button>
                                </form>

                                <form action="{{ route('admin.video-news-posts.destroy',$post->slug) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="page" value="{{ $videoNewsPosts->currentPage() }}">
                                    <button type="submit" class="btn btn-danger me-3"
                                        onClick="return confirm('Are you sure want to delete?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $videoNewsPosts->links() }}
    </div>
</x-dashboard-layout>
