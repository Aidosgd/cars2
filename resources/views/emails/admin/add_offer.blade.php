Пользователь {{ $offer->user->name }} добавил объявления 
<a href="/offers/category/{{ $offer->category->getSlug() }}/{{ $offer->category->id }}/offer/{{ $offer->getSlug() }}/{{ $offer->id }}}">{{ $offer->title }}</a>