@extends('layouts.app')

@section('content')

    @foreach($categories as $catKey => $catMeta)

        @if($groupedModules->has($catKey))

            {{-- Category header --}}
            <div class="mt-16 mb-8 reveal">
                <div class="flex items-center gap-4">
                    <div class="h-px flex-1 bg-gray-100 max-w-[60px]"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">
                        {{ $catMeta['label'] }}
                    </span>
                    <div class="h-px flex-1 bg-gray-100"></div>
                </div>
                <p class="text-center font-body text-sm text-gray-400 mt-2">
                    {{ $catMeta['desc'] }}
                </p>
            </div>

            {{-- Module cards --}}
            @foreach($groupedModules[$catKey] as $module)
                @include('products.partials.module-card', ['module' => $module])
            @endforeach

        @endif

    @endforeach

@endsection
