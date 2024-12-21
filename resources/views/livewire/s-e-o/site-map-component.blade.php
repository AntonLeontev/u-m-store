
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        @foreach ($products as $product)
            @if($product->city)
                <item>
                    <id>{{ $product->id }}</id>
                    <title>{!! $product->name !!}</title>

                    <loc>{{ route('product.details', [ 'city_slug'=>$product->city ,'slug'=>$product->id]) }}</loc>

                    <image_link>{{ route('home').'/storage/'.$product->image}}</image_link>
                    <price>{{$product->store_price }} RUB</price>
                    <product_type>{{ $product->type }}</product_type>
                    <lastmod>{{ $product->created_at->tz('UTC')->toAtomString() }}</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.8</priority>
                </item>
            @endif
        @endforeach
</urlset>
