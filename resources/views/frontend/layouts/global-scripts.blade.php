<script>
    /**Show sweet alert**/
    $('body').on('click', '.delete-item', function(e) {
        e.preventDefault() //preventing page reload when clicking delete. (anchor tags(<a>) will reload your page when clicked on)

        //get the dynamic url attribute from the delete anchor tag(<a>) in SLiderDataTable.php
        let url = $(this).attr('href');
        console.log(url);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message)


                            //refresh datatable when delete.
                            window.location.reload()
                        } else if (response.status === 'success') {
                            toastr.error(response.message)
                        }

                    },
                    error: function(error) {
                        console.error(error);
                    }
                })
            }
        });

    })



    /** Show Loader */
    function showLoader() {
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    /** Hide Loader */
    function hideLoader() {
        $('.overlay').removeClass('active');
        $('.overlay-container').addClass('d-none');
    }

    /** Loard product modal**/
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('load-product-modal', ':productId') }}'.replace(':productId', productId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },

            success: function(response) {
                $(".load_product_modal_body").html(response);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                $('.overlay').removeClass('active');
                $('.overlay-container').addClass('d-none');
            }
        })
    }

    /** Update sidebar cart*/
    function updateSidebarCart(callback = null) {
        $.ajax({
            method: 'GET',
            url: '{{ route('get-cart-products') }}',

            success: function(response) {
                $('.cart_contents').html(response);
                let cartTotal = $('#cart_total').val();
                let cartCount = $('#cart_product_count').val();
                $('.cart_subtotal').text("{{ currencyPosition(':cartTotal') }}".replace(":cartTotal",
                    cartTotal));
                $('.cart_count').text(cartCount);

                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    }

    /** Remove Cart product from sidebar */
    function removeProductFromSidebar($rowId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('cart-product-remove', ':rowId') }}'.replace(":rowId", $rowId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },
            success: function(responce) {
                if (responce.status === 'success') {
                    updateSidebarCart(function() {
                        toastr.success(responce.message);
                        // Delay hiding the loader for 500ms
                        setTimeout(function() {
                            $('.overlay').removeClass('active');
                            $('.overlay-container').addClass('d-none');
                        }, 500); // Delay by 500ms
                    })
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
                // Ensure the loader is hidden in case of error
                $('.overlay').removeClass('active');
                $('.overlay-container').addClass('d-none');
            }
        })
    }
</script>
