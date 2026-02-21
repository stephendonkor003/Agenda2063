@extends('layouts.admin')

@section('title', 'View Item')
@section('page-title', 'View Item')

@section('content')
<div class="page-header-banner">
    <div class="page-header-text">
        <h1><i class="fa-solid fa-eye"></i> {{ $item->title }}</h1>
        <p>{{ ucfirst($item->type) }} • {{ $item->category?->name ?? $item->category ?? 'General' }}</p>
    </div>
    <div class="page-header-actions">
        <a class="btn-outline-admin" href="{{ route('admin.news') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <a class="btn-primary-admin" href="{{ route('admin.news.edit', $item) }}"><i class="fa-solid fa-pen"></i> Edit</a>
    </div>
</div>

<div class="settings-card" style="max-width:1000px;">
    <div class="settings-card-body">
        <div class="settings-row" style="margin-bottom:12px;">
            <span class="tag status {{ $item->status }}">{{ ucfirst($item->status) }}</span>
            <span class="tag">{{ ucfirst($item->type) }}</span>
            <span class="tag">{{ $item->published_at?->format('M d, Y H:i') ?? 'Unpublished' }}</span>
            @if($item->type === 'event')
            <span class="tag">{{ $item->location ?? 'Location TBD' }}</span>
            @endif
        </div>
        @if($item->banner_path)
            <img src="{{ Storage::url($item->banner_path) }}" alt="banner" style="width:100%; max-height:360px; object-fit:cover; border-radius:12px; margin-bottom:12px;">
        @endif
        <div class="muted" style="margin-bottom:10px;">{{ $item->summary }}</div>
        <div>{!! $item->body !!}</div>

        @if($item->attachments->count())
            <h4 style="margin-top:18px;">Attachments</h4>
            <ul>
                @foreach($item->attachments as $att)
                    <li>
                        @if($att->file_path)
                            <a href="{{ Storage::url($att->file_path) }}" target="_blank">{{ $att->label ?? basename($att->file_path) }}</a>
                        @elseif($att->file_url)
                            <a href="{{ $att->file_url }}" target="_blank">{{ $att->label ?? $att->file_url }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
