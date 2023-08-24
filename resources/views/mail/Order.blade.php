<x-mail::message>
    # New Order

    The Details Of Your Order.



    <x-mail::table>
        | product_name | quantity | price |
        | ------------- |:-------------:| --------:|
        @foreach ($products as $product)
            | {{ $product['product_name'] }} | {{ $product['quantity'] }} | {{ $product['price'] }} |
        @endforeach
    </x-mail::table>


    Total Price ={{ $total_price }} EG

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
