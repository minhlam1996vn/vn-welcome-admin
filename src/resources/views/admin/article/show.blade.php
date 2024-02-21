@extends('layouts.admin')

@section('page-title', 'Chi tiết bài viết')

@section('page-button')
    <a href="{{ route('admin.article.edit', $article->id) }}" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="edit"></i>
        Biên tập
    </a>
@endsection

@push('styles')
    @vite(['resources/css/content-styles.css'])
@endpush

@section('content')
    <div class="row">
        @if ($article->tags)
            @foreach ($article->tags as $tag)
                <p>{{ $tag->tag_name }}</p>
            @endforeach
        @endif
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
            </div>
        </div>
    </div>
@endsection
