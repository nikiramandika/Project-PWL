<div class="w-full py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-white">
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
      <div class="flex flex-col lg:flex-row gap-4 w-full">
        <div class="lg:w-3/4">
          <div class="bg-white overflow-x-auto overflow-scroll rounded-3xl shadow-md p-6 mb-4">
            <table class="w-full table-fixed">
              <thead>
                <tr>
                  <th class="text-left font-semibold w-60">Product</th>
                  <th class="text-left font-semibold w-36">Price</th>
                  <th class="text-left font-semibold w-36">Quantity</th>
                  <th class="text-left font-semibold w-56">Total</th>
                  <th class="text-left font-semibold w-28">Remove</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart_items as $item)
                <tr wire:key='{{ $item['product_id'] }}'>
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="h-16 w-16 mr-4 rounded-lg" src="{{ asset($item['product']->image) }}" alt="{{ $item['product']->name }}">
                      <span class="font-semibold text-wrap mr-3">{{ $item['product']->name }}</span>
                    </div>
                  </td>
                  <td class="py-4">
                    {{ Number::currency($item['unit_amount'], 'IDR') }}
                  </td>
                  <td class="py-4">
                    <div class="flex justify-start">
                      <button wire:click='decreaseQty({{ $item['product_id'] }})' class="py-1 w-10 h-full text-gray-800 bg-gray-200 rounded-l-full outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-300">-</button>
                      <span class="text-md bg-gray-200 py-1 w-8 text-center text-gray-600">{{ $item['quantity'] }}</span>
                      <button wire:click='increaseQty({{ $item['product_id'] }})' class="py-1 w-10 h-full text-gray-600 bg-gray-200 rounded-r-full outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-300">+</button>
                    </div>
                    
                  </td>
                  <td class="py-4">
                    {{ Number::currency($item['total_amount'], 'IDR') }}
                  </td>
                  <td>
                    <button wire:click='removeItem({{ $item['product_id'] }})' class=" bg-red-400 rounded-full px-4 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 text-white"><span wire:loading.remove wire:target='removeItem({{ $item['product_id'] }})'>Remove</span><span wire:loading wire:target='removeItem({{ $item['product_id'] }})'>Removing...</span></button>
                  </td>
                </tr>                    
                @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500 ">No items available in cart!</td>
                </tr>
                @endforelse

                <!-- More product rows -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="w-full">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Summary</h2>
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>{{ Number::currency($grand_total, 'IDR') }}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Taxes</span>
              <span>{{ Number::currency(0, 'IDR') }}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Shipping</span>
              <span>{{ Number::currency(0, 'IDR') }}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Grand Total</span>
              <span class="font-semibold">{{ Number::currency ($grand_total, 'IDR') }}</span>
            </div>
            @if ($cart_items)
              <a href="/checkout" class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full hover:bg-green-500">Checkout</a>  
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>