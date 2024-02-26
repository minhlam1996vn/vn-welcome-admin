@extends('layouts.admin')

@section('page-title', 'Chi tiết bài viết')

@section('page-button')
    <a href="{{ route('admin.article.edit', $article->id) }}" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="edit"></i>
        Biên tập
    </a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/css/lib/content-styles.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8 d-none d-sm-block">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Hiển thị trên (PC/Tablet)</h5>
                </div>
                <div class="card-body">
                    <h1 class="h3 fw-bold">{{ $article->article_title }}</h1>
                    <span class="text-muted">{{ $articlePublicationDate }}</span>
                    <hr>
                    <p class="fw-bold">{{ $article->article_description }}</p>
                    <div class="ck-content">
                        {!! $article->article_content !!}
                    </div>
                </div>
                @if ($article->tags->count() > 0)
                    <div class="card-footer">
                        <hr>
                        <div>
                            <span>Tags: </span>
                            @foreach ($article->tags as $tag)
                                <span class="btn btn-sm rounded-4 badge-primary-light mx-1">#{{ $tag->tag_name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Hiển thị trên (Mobile)</h5>
                </div>
                <div class="card-body">
                    <h1 class="h3 fw-bold">{{ $article->article_title }}</h1>
                    <span class="text-muted">{{ $articlePublicationDate }}</span>
                    <hr>
                    <p class="fw-bold">{{ $article->article_description }}</p>
                    <div class="ck-content">
                        {!! $article->article_content !!}
                    </div>
                </div>
                @if ($article->tags->count() > 0)
                    <div class="card-footer">
                        <hr>
                        <div>
                            <span>Tags: </span>
                            @foreach ($article->tags as $tag)
                                <span class="btn btn-sm rounded-4 badge-primary-light m-1 text-nowrap">#{{ $tag->tag_name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
