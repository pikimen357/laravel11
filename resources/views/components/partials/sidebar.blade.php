<div>
    <h2 class="font-bold text-xl mb-4">Menu</h2>
    <ul class="space-y-4">
        @foreach($menus as $menu)
            <li><a href="{{ $menu['link'] }}" class="text-white hover:text-gray-300">{{ $menu['name'] }}</a></li>
        @endforeach
    </ul>
</div>
