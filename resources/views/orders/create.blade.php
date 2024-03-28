<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($title) ? $title : '' }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid py-2">
                        <form class="max-w " method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="mb-5">
                                <label for="users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select User name</label>
                                <select id="users" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user">
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div >
                                <button type="button" class="w-48 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" id="add-products">Add Products</button>
                            </div>
                            
                            <div class="select-products">

                            </div>
                            
                            <div class="mb-5">
                                <button type="submit" class="w-48 hidden text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" id="add-order" >Add Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function(){
        i = 0
        $('#add-products').on('click', function(){
            var inputGroup = '<div class="product-container flex items-start mb-5" data-product_index="'+i+'">'+
                    '<div class="mb-5 pe-2">'+
                        '<label for="products'+i+'" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Product</label>'+
                        '<select id="products'+i+'" class="product_name bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product['+i+']" data-product_index="'+i+'">'+
                            '<option value="">Select Product</option>'+
                            '@foreach($products as $product)'+
                                '<option value="{{ $product['id'] }}">{{ $product['name'] }}</option>'+
                            '@endforeach'+
                        '</select>'+
                    '</div>'+
                    '<div class="mb-5 pe-2">'+
                        '<label for="products_qty'+i+'" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>'+
                        '<input type="text" id="products_qty'+i+'" name="product_qty[]" class="product_qty bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required data-product_index="'+i+'"/>'+
                    '</div>'+
                    '<div class="mb-5 pe-2">'+
                        '<label for="product_price'+i+'" class="product_price block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Price</label>'+
                        '<input type="text" id="product_price'+i+'" name="product_price[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  readonly/>'+
                    '</div>'+
                    '<div class="mb-5 pe-2">'+
                        '<label for="product_total'+i+'" class="product_total block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Total</label>'+
                        '<input type="text" id="product_total'+i+'" name="product_total[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   readonly   />'+
                    '</div>'+
                    '<div class="mb-5 pe-2">'+
                        '<button type="button" class="remove-product focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" data-product_index="'+i+'">Remove Product</button>'

                    '</div>'+
                '</div>'
                i++;
                $('.select-products').append(inputGroup)

                if(i > 0){
                    $('#add-order').removeClass('hidden').removeClass('bg-blue-400').addClass('bg-blue-800')
                }
        })

        
    })

    $(document).on('change', '.product_name', function(){
        selected_product = $(this).val()
        product_index = $(this).data('product_index')

        //get product price
        $.ajax({
            url: '/products/get_price',
            type: 'POST',
            
            data: {"_token": "{{ csrf_token() }}", id: selected_product, index: product_index},
            success: function(data){
                $('#product_price'+product_index).prop('value', data)
            }
        })

    })

    $(document).on('input', '.product_qty', function(){
        product_index = $(this).data('product_index')
        //calculate product total
        product_price = parseInt($('#product_price'+product_index).prop('value'))
        product_qty = parseInt($(this).val())
        product_total = parseInt(product_price * product_qty)
        

        //set product total value
        $('#product_total'+product_index).prop('value', product_total)
    })

    $(document).on('click', '.remove-product', function(){
        $(this).parent().parent().remove()
    })

    $(document).ready(function(){
        count = $('.product-container').length
    })
</script>