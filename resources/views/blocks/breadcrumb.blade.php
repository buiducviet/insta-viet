<div class="container">
    <ol class="breadcrumb breadcrumb-top" itemscope="itemscope" itemtype="//schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ route('home') }}" itemprop="item"><span itemprop="name">Home</span></a>
            <meta itemprop="position" content="1"/>
        </li>
        @foreach($breadcrumb as $key => $item)
            @if(is_null($item['url']))
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a href="{{ url()->current() }}" itemprop="item"><span itemprop="name">{{ $item['title'] }}</span></a>
                    <meta itemprop="position" content="{{ $key+2 }}"/>
                </li>
            @else
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a href="{{ $item['url'] }}" itemprop="item"><span itemprop="name">{{ $item['title'] }}</span></a>
                    <meta itemprop="position" content="{{ $key+2 }}"/>
                </li>
            @endif
        @endforeach
    </ol>
</div>