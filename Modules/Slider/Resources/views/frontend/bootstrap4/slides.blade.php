@foreach($slider->slides as $index => $slide)
    <div class="carousel-item @if($index === 0) active @endif ">
            <img class="d-block w-100" src="{!! $slide->getImageUrl() !!}" alt="{{ $slide->title }}">
            @if(!empty($slide->getLinkUrl()))
                <a href="{{ $slide->getLinkUrl() }}" target="{{ $slide->target }}">
            @endif
            <div class="carousel-caption d-none d-md-block">
                <h2>{{ $slide->title }}</h2>
                <span>
                    {{ $slide->caption }}
                </span>
            </div>
            @if(!empty($slide->getLinkUrl()))
                </a>
            @endif
    </div>
@endforeach
