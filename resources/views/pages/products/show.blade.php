@extends('layouts.app')

@section('title', $module->seo['title'] ?? $module->name)
@section('meta_description', $module->seo['description'] ?? $module->tagline)

@section('content')

    @foreach($module->sections as $section)

        @includeIf(
            "pages.products.sections.{$section->section_type}",
            ['section' => $section, 'module' => $module]
        )

    @endforeach

@endsection
