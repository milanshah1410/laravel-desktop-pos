<!DOCTYPE html>
<html>
<head>
    <title>POS</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Point of Sale</h1>
    <ul id="products">
        @foreach($products as $product)
        <li>
            {{ $product->name }} (${{ $product->price }})
            <button onclick="addToCart({{ $product }})">Add</button>
        </li>
        @endforeach
    </ul>

    <h2>Cart</h2>
    <ul id="cart"></ul>
    <p>Total: $<span id="total">0.00</span></p>
    <button onclick="checkout()">Checkout</button>

    <script>
        const cart = [];

        function addToCart(product) {
            const found = cart.find(p => p.id === product.id);
            if (found) {
                found.qty++;
            } else {
                cart.push({...product, qty: 1});
            }
            renderCart();
        }

        function renderCart() {
            const list = document.getElementById('cart');
            list.innerHTML = '';
            let total = 0;
            cart.forEach(item => {
                list.innerHTML += `<li>${item.name} x ${item.qty}</li>`;
                total += item.qty * item.price;
            });
            document.getElementById('total').innerText = total.toFixed(2);
        }

        function checkout() {
            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({items: cart})
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                cart.length = 0;
                renderCart();
            });
        }
    </script>
</body>
</html>
