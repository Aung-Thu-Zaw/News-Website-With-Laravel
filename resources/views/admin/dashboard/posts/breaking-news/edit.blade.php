<x-dashboard-layout>
    @section("title", "Breaking News Edit")
    <div class="row">

        <div class="col-12 p-5">
            <div class="mb-3 d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.post.breaking-news.index') }}" class="btn btn-primary">View <i
                        class="fa-solid fa-eye"></i></a>
            </div>
            <div class="border p-5">
                <form action="{{ route('admin.post.breaking-news.update',$breakingNews->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")

                    <input type="hidden" name="page" value="{{$page}}">

                    <x-form.input type="text" name="title" value="{{ $breakingNews->title }}">
                        <x-form.label name="Title *" />
                    </x-form.input>

                    <x-form.input type="text" name="slug" value="{{ $breakingNews->slug }}">
                        <x-form.label name="Slug *" />
                    </x-form.input>

                    <x-form.textarea name="body" value="{{ $breakingNews->body }}">
                        <x-form.label name="Detail *" />
                    </x-form.textarea>

                    <x-form.select name="sub_category_id" :subcategories="$subCategories"
                        :id="$breakingNews->sub_category_id">
                        <x-form.label name="SubCategory *" />
                    </x-form.select>


                    <x-form.input-wrapper>
                        <x-form.label name="Tags" />
                        <input type="text" name="tags" class="form-control" placeholder="tags" />
                        <x-form.error name="tags" />
                    </x-form.input-wrapper>


                    <x-form.input type="file" name="thumbnail" id="file1">
                        <x-form.label name="Choose Photo" />
                    </x-form.input>

                    <div class="mb-3">
                        <img src="{{ asset('storage/thumbnails/'.$breakingNews->thumbnail) }}" alt="" id="previewPhoto1"
                            style="width: 400px">
                    </div>

                    <x-form.input-button name="Update" />
                </form>

                @if(count($breakingNews->tags))
                <div class="mb-3">
                    <span class="mb-5">Exisiting Tags</span>
                    <div class="d-flex align-items-center">
                        @foreach ($breakingNews->tags as $tag)
                        <form action="{{ route('tag.destroy',$tag->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <span class="header-news-tag text-white my-1 mx-1">
                                {{ $tag->name }}
                                <button type="submit" class="ms-3 fs-5 text-danger border-0"
                                    style="background: transparent"
                                    onclick="return confirm('Are you sure want to delete?');" style="cursor: pointer">
                                    x
                                </button>
                            </span>
                        </form>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-dashboard-layout>
