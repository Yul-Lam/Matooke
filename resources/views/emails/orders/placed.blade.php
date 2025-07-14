<x-mail::message>
# Hello {{ $order->user->name }},

Thank you for placing your order with us! ☕  
We've received your order and are processing it.

---

*📦 Order ID:* {{ $order->id }}  
*📍 Delivery Address:* {{ $order->delivery_address }}  
*⏳ Status:* {{ ucfirst($order->status) }}  
*💰 Total:* UGX {{ number_format($order->total) }}

---

<x-mail::button :url="url('/orders')">
View Your Orders
</x-mail::button>

📎 A PDF invoice is attached for your records.

Thanks for supporting local Ugandan coffee!<br>
*Coffee Supply Chain Team*
</x-mail::message>