<h4>Поиск</h4>
<div class="well well-sm">
    <form action="/search" method="get">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Что вы ищете?">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>
        </div>
    </form>
</div>
<h4>Категории</h4>
<div class="well well-sm hidden-lg">
    <div class="mobile-categories"></div>
</div>
<div class="categories list-group hidden-xs hidden-sm hidden-md">
    <?php
        if(empty($appends['category_id'])){
            $appends['category_id'] = 0;
        }
        if(!isset($cat_parent)){
            $cat_id = false;
            $cat_parent = false;
        }
    ?>
    @foreach($catGSidebar as $catGitem)
        <a href="#data-cat{{ $catGitem->id }}" class="list-group-item">{{ $catGitem->name }} <span class="glyphicon glyphicon-chevron-right"></span></a>
        <div data-cat="{{ $catGitem->id }}" class="list-subgroups" style="display: {{ $catGitem->id == $cat_parent ? 'block' : 'none' }}">
            @foreach($catSidebar as $catItem)
                @if ($catGitem->id == $catItem->category_group_id)
                    <a href="/offers/category/{{ $catItem->getSlug() }}/{{ $catItem->id }}" class="list-subgroup-item {{ $catItem->id == $cat_id ? 'active' : ''}}">
                        {{ $catItem->name }}
                        <span class="label label-success">{{ $catItem->offers()->count() }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
<div class="hidden-xs hidden-sm hidden-md {{ Request::is('/') ? 'hidden' : '' }}">
    <h4>Новые объявления</h4>
    <div class="newest-classifieds">
        @foreach($offersSidebar as $item)
            <div class="media">
                <a class="pull-left" href="/offers/category/{{ $item->category->getSlug() }}/{{ $item->category->id }}/offer/{{ $item->getSlug() }}/{{ $item->id }}">
                    <img class="media-object" style="width: 64px; height: 64px;" src="/uploads/offers/small/{{ $item->getImage($item->id) }}" alt="{{ $item->title }}" />
                </a>
                <div class="media-body">
                    <p><a href="/offers/category/{{ $item->category->getSlug() }}/{{ $item->category->id }}/offer/{{ $item->getSlug() }}/{{ $item->id }}"><strong>{{ str_limit($item->title, 20) }}</strong></a></p>
                    <p>{{ str_limit($item->description, 40) }}</p>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>